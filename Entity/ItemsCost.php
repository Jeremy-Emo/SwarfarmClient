<?php


namespace SwarfarmClient\Entity;


use SwarfarmClient\Exception\TranslatorException;

class ItemsCost
{
    /**
     * ItemsCost constructor.
     * @param array $initialData
     */
    public function __construct(array $initialData)
    {
        $this->item = new Item($initialData['item']);
        $this->quantity = $initialData['quantity'];
    }

    /**
     * @param string $language
     * @return ItemsCost
     * @throws TranslatorException
     */
    public function translateTo(string $language) : ItemsCost
    {
        $this->getItem()->translateTo($language);

        return $this;
    }

    /**
     * @var Item
     */
    private $item;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     * @return ItemsCost
     */
    public function setItem(Item $item): ItemsCost
    {
        $this->item = $item;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return ItemsCost
     */
    public function setQuantity(int $quantity): ItemsCost
    {
        $this->quantity = $quantity;
        return $this;
    }
}