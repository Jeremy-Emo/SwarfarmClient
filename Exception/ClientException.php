<?php


namespace SwarfarmClient\Exception;


class ClientException extends \Exception
{
    public function __toString()
    {
        return parent::getMessage();
    }
}