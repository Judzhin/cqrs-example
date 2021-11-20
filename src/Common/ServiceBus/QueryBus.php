<?php

namespace App\Common\ServiceBus;

use Verraes\ClassFunctions\ClassFunctions;

/**
 * Class QueryBus
 * @package App\Common\ServiceBus
 */
class QueryBus
{
    /** @var array */
    private $queryHandlers = [];

    /**
     * @param $aQuery
     * @return mixed
     * @throws HandlerNotFoundException
     */
    public function handle($aQuery)
    {
        $anUnderscoredQueryClass = ClassFunctions::underscore($aQuery);

        if (!isset($this->queryHandlers[$anUnderscoredQueryClass])) {
            throw new HandlerNotFoundException(get_class($aQuery));
        }

        $aQueryHandler = $this->queryHandlers[$anUnderscoredQueryClass];
        return $aQueryHandler->handle($aQuery);
    }

    /**
     * @param $aQueryHandler
     * @return $this
     */
    public function register($aQueryHandler): self
    {
        $anUnderscoredQueryHandlerClass = ClassFunctions::underscore($aQueryHandler);
        $aQueryClass = str_replace(
            ['.handler', '_handler'], ['', ''], $anUnderscoredQueryHandlerClass
        );

        $this->queryHandlers[$aQueryClass] = $aQueryHandler;

        return $this;
    }
}