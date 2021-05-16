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

    public function __construct()
    {
        $this->items = [];
    }

    public function getItems()
    {
        return $this->items;
    }

    public function addItem(Item $item, $itemId)
    {
        $this->items[$itemId] = $item;
    }

    public function removeItem($itemId)
    {
        unset($this->items[$itemId]);
    }

    /* public function getItemDescription(Item $item): ?string
    {
        $key = array_search($item, $this->items);

        if ($key) {
            return $this->items[$key]->getDescription();
        }
    }

    public function getItemName(Item $item): ?string
    {
        $key = array_search($item, $this->items);

        if ($key) {
            return $this->items[$key]->getName();
        }
    } */

    public function getItem($itemId): ?Item
    {
        foreach ($this->items as $key=>$item) {
            if ($key == $itemId) {
                return $item;
            }
        }

        return null;
    }
}