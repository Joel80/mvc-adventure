<?php

declare(strict_types=1);

namespace App\Adventure;

/**A class for the items in the adventure game */
class Item
{
    /**
     * @var string $description the item description
     * @var string $name the name of the item
     */

    private string $description;
    private string $name;
    private string $itemId;
    private string $placementDescription;

    public function __construct(string $description, string $name, string $itemId, string $itemPlacement)
    {
        $this->description = $description;
        $this->name = $name;
        $this->itemId = $itemId;
        $this->placementDescription = $itemPlacement;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPlacementDescription(): string
    {
        return $this->placementDescription;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getItemId(): string
    {
        return $this->itemId;
    }
}
