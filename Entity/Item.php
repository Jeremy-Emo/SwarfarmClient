<?php


namespace SwarfarmClient\Entity;


use SwarfarmClient\Exception\TranslatorException;
use SwarfarmClient\Utils\Translator;

class Item
{
    const ICON_BASE_PATH = "https://swarfarm.com/static/herders/images/icons/";

    /**
     * Item constructor.
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
     * @return string
     */
    public function getImagePath() : string
    {
        return self::ICON_BASE_PATH . $this->icon;
    }

    /**
     * @param string $language
     * @return Item
     * @throws TranslatorException
     */
    public function translateTo(string $language) : Item
    {
        $translator = new Translator($language);

        $this->name = $translator->translate('items', $this->name);
        $this->description = (
            $translator->translate('item_descriptions', $this->name) !== $this->name
            ? $translator->translate('item_descriptions', $this->name)
            : $this->description
        );
        $this->category = $translator->translate('categories', $this->category);

        return $this;
    }

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $com2us_id;

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
    private $category;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $sell_value;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Item
     */
    public function setId(int $id): Item
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getCom2usId(): int
    {
        return $this->com2us_id;
    }

    /**
     * @param int $com2us_id
     * @return Item
     */
    public function setCom2usId(int $com2us_id): Item
    {
        $this->com2us_id = $com2us_id;
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
     * @return Item
     */
    public function setUrl(string $url): Item
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
     * @return Item
     */
    public function setName(string $name): Item
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return Item
     */
    public function setCategory(string $category): Item
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     * @return Item
     */
    public function setIcon(string $icon): Item
    {
        $this->icon = $icon;
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
     * @return Item
     */
    public function setDescription(string $description): Item
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getSellValue(): string
    {
        return $this->sell_value;
    }

    /**
     * @param string $sell_value
     * @return Item
     */
    public function setSellValue(string $sell_value): Item
    {
        $this->sell_value = $sell_value;
        return $this;
    }

}