<?php


namespace App\Common\ServiceBus;

/**
 * Class HandlerNotFoundException
 *
 * @package App\Common\ServiceBus
 */
class HandlerNotFoundException extends \Exception
{
    /**
     * HandlerNotFoundException constructor.
     * @param $aQueryClass
     */
    public function __construct($aQueryClass)
    {
        parent::__construct(sprintf('Unable to find a registered handler for "%s"', $aQueryClass), 0, null);
    }
}