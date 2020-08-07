<?php


namespace SwarfarmClient\Entity;


use SwarfarmClient\Exception\TranslatorException;
use SwarfarmClient\Utils\Translator;

class Building
{
    const ICON_BASE_PATH = "https://swarfarm.com/static/herders/images/buildings/";

    /**
     * Building constructor.
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
    public function getIconPath()
    {
        return self::ICON_BASE_PATH . $this->icon_filename;
    }

    /**
     * @param string $language
     * @return Building
     * @throws TranslatorException
     */
    public function translateTo(string $language) : Building
    {
        $translator = new Translator($language);

        $this->name = $translator->translate('buildings', $this->name);
        $this->description = (
        $translator->translate('building_descriptions', $this->name) !== $this->name
            ? $translator->translate('building_descriptions', $this->name)
            : $this->description
        );

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
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
    private $area;

    /**
     * @var string
     */
    private $affected_stat;

    /**
     * @var string
     */
    private $element;

    /**
     * @var int
     */
    private $com2us_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $max_level;

    /**
     * @var array
     */
    private $stat_bonus;

    /**
     * @var array
     */
    private $upgrade_cost;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $icon_filename;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Building
     */
    public function setId(int $id): Building
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
     * @return Building
     */
    public function setUrl(string $url): Building
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getArea(): string
    {
        return $this->area;
    }

    /**
     * @param string $area
     * @return Building
     */
    public function setArea(string $area): Building
    {
        $this->area = $area;
        return $this;
    }

    /**
     * @return string
     */
    public function getAffectedStat(): string
    {
        return $this->affected_stat;
    }

    /**
     * @param string $affected_stat
     * @return Building
     */
    public function setAffectedStat(string $affected_stat): Building
    {
        $this->affected_stat = $affected_stat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getElement(): ?string
    {
        return $this->element;
    }

    /**
     * @param string $element
     * @return Building
     */
    public function setElement(string $element): Building
    {
        $this->element = $element;
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
     * @return Building
     */
    public function setCom2usId(int $com2us_id): Building
    {
        $this->com2us_id = $com2us_id;
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
     * @return Building
     */
    public function setName(string $name): Building
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLevel(): int
    {
        return $this->max_level;
    }

    /**
     * @param int $max_level
     * @return Building
     */
    public function setMaxLevel(int $max_level): Building
    {
        $this->max_level = $max_level;
        return $this;
    }

    /**
     * @return array
     */
    public function getStatBonus(): array
    {
        return $this->stat_bonus;
    }

    /**
     * @param array $stat_bonus
     * @return Building
     */
    public function setStatBonus(array $stat_bonus): Building
    {
        $this->stat_bonus = $stat_bonus;
        return $this;
    }

    /**
     * @return array
     */
    public function getUpgradeCost(): array
    {
        return $this->upgrade_cost;
    }

    /**
     * @param array $upgrade_cost
     * @return Building
     */
    public function setUpgradeCost(array $upgrade_cost): Building
    {
        $this->upgrade_cost = $upgrade_cost;
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
     * @return Building
     */
    public function setDescription(string $description): Building
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getIconFilename(): string
    {
        return $this->icon_filename;
    }

    /**
     * @param string $icon_filename
     * @return Building
     */
    public function setIconFilename(string $icon_filename): Building
    {
        $this->icon_filename = $icon_filename;
        return $this;
    }
}