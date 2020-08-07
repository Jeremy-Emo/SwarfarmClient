<?php

namespace SwarfarmClient\Exception;

class TranslatorException extends \Exception
{
    public function __toString()
    {
        return parent::getMessage();
    }
}