<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Item;

/**A class for the inventories in the adventure game */
class Inventory
{
    /**
     * @var array $items The items in the inventory
    */
    private array $items;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = [];
    }

    /**
     * Gets the items
     * @return array with the items
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Add an items
     * @param Item $item the item
     * @param string $itemId the item id
     * @return void
     */
    public function addItem(Item $item, string $itemId): void
    {
        $this->items[$itemId] = $item;
    }

    /**
     * Add an items
     * @param string $itemId
     * @return void
     */
    public function removeItem(string $itemId): void
    {
        unset($this->items[$itemId]);
    }

    /**
     * Gets an items
     * @param string $itemId the id
     * @return Item|null the item
     */
    public function getItem($itemId): ?Item
    {
        foreach ($this->items as $key => $item) {
            if ($key == $itemId) {
                return $item;
            }
        }

        return null;
    }
}
