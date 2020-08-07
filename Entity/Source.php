<?php


namespace SwarfarmClient\Entity;


use SwarfarmClient\Exception\TranslatorException;
use SwarfarmClient\Utils\Translator;

class Source
{
    /**
     * Source constructor.
     * @param array $initialData
     */
    public function __construct(array $initialData)
    {
        foreach ($initialData as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->name;
    }

    /**
     * @param string $language
     * @return Source
     * @throws TranslatorException
     */
    public function translateTo(string $language) : Source
    {
        $translator = new Translator($language);

        $this->name = $translator->translate('sources', $this->name);
        $this->description = (
        $translator->translate('source_descriptions', $this->name) !== $this->name
            ? $translator->translate('source_descriptions', $this->name)
            : $this->description
        );

        return $this;
    }

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $farmable_source;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Source
     */
    public function setId(int $id): Source
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Source
     */
    public function setUrl(string $url): Source
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Source
     */
    public function setName(string $name): Source
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Source
     */
    public function setDescription(string $description): Source
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFarmableSource(): bool
    {
        return $this->farmable_source;
    }

    /**
     * @param bool $farmable_source
     * @return Source
     */
    public function setFarmableSource(bool $farmable_source): Source
    {
        $this->farmable_source = $farmable_source;
        return $this;
    }


}