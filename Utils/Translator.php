<?php

namespace SwarfarmClient\Utils;

use SwarfarmClient\Exception\TranslatorException;

class Translator
{
    /**
     * @var string
     */
    private $language;

    /**
     * Translator constructor.
     * @param string $lang
     */
    public function __construct(string $lang)
    {
        $this->language = $lang;
    }

    /**
     * @param string $type
     * @param string $needle
     * @return string
     * @throws TranslatorException
     */
    public function translate(string $type, string $needle) : string
    {
        if (!extension_loaded('yaml')) {
            throw new TranslatorException("YAML extension must be installed");
        }
        $yamlToGet = $this->language . '/' . $type . '.yaml';
        try {
            $data = yaml_parse_file(__DIR__ . '/../Translations/' . $yamlToGet);
        } catch (\Exception $e) {
            throw new TranslatorException("YAML file not found", 404, [
                'file' => $yamlToGet
            ]);
        }

        return $data[$needle] ?? $needle;
    }
}