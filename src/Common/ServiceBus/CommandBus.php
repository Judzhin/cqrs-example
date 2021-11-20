<?php

namespace App\Common\ServiceBus;

use Verraes\ClassFunctions\ClassFunctions;

/**
 * Class CommandBus
 *
 * @package App\Common\ServiceBus
 */
class CommandBus
{
    /** @var array */
    private array $commandHandlers = [];

    /**
     * @param $aCommand
     * @return $this
     * @throws HandlerNotFoundException
     */
    public function handle($aCommand): self
    {
        $anUnderscoredCommandClass = ClassFunctions::underscore($aCommand);

        if (!isset($this->commandHandlers[$anUnderscoredCommandClass])) {
            throw new HandlerNotFoundException(get_class($aCommand));
        }

        $aCommandHandler = $this->commandHandlers[$anUnderscoredCommandClass];
        $aCommandHandler->handle($aCommand);

        return $this;
    }

    /**
     * @param $aCommandHandler
     * @return $this
     */
    public function register($aCommandHandler): self
    {
        $aCommandClass = str_replace(['.handler', '_handler'], ['', '_command'],
            ClassFunctions::underscore($aCommandHandler)
        );

        $this->commandHandlers[$aCommandClass] = $aCommandHandler;

        return$this;
    }
}