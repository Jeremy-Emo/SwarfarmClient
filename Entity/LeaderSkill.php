<?php


namespace SwarfarmClient\Entity;


class LeaderSkill
{
    /**
     * LeaderSkill constructor.
     * @param array $initialData
     */
    public function __construct(array $initialData)
    {
        foreach ($initialData as $key => $value) {
            $this->{$key} = $value;
        }
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
    private $attribute;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var string;
     */
    private $area;

    /**
     * @var ?string
     */
    private $element;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return LeaderSkill
     */
    public function setId(int $id): LeaderSkill
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
     * @return LeaderSkill
     */
    public function setUrl(string $url): LeaderSkill
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getAttribute(): string
    {
        return $this->attribute;
    }

    /**
     * @param string $attribute
     * @return LeaderSkill
     */
    public function setAttribute(string $attribute): LeaderSkill
    {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return LeaderSkill
     */
    public function setAmount(int $amount): LeaderSkill
    {
        $this->amount = $amount;
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
     * @return LeaderSkill
     */
    public function setArea(string $area): LeaderSkill
    {
        $this->area = $area;
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
     * @param string|null $element
     * @return LeaderSkill
     */
    public function setElement(?string $element): LeaderSkill
    {
        $this->element = $element;
        return $this;
    }

}