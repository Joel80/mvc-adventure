<?php

declare(strict_types=1);

namespace App\Adventure;

/**A class for the items in the adventure game */
class Item
{
    /**
     * @var string $description the item description
     * @var string $name the name of the item
     * @var string $itemId the item id
     * @var string $placementDescription the description of the items placement
     */

    private string $description;
    private string $name;
    private string $itemId;
    private string $placementDescription;

    /**
     * Constructor
     * @param string $description the item description
     * @param string $name the name of the item
     * @param string $itemId the item id
     * @param string $itemPlacement the description of the items placement
     */
    public function __construct(string $description, string $name, string $itemId, string $itemPlacement)
    {
        $this->description = $description;
        $this->name = $name;
        $this->itemId = $itemId;
        $this->placementDescription = $itemPlacement;
    }

    /**
     * Gets the item description
     * @return string the description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Gets the placement description
     * @return string the description
     */
    public function getPlacementDescription(): string
    {
        return $this->placementDescription;
    }

    /**
     * Gets the item name
     * @return string the name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the item id
     * @return string the id
     */
    public function getItemId(): string
    {
        return $this->itemId;
    }
}
