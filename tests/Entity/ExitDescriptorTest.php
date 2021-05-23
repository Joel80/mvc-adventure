<?php

declare(strict_types=1);

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Achievement class
 */

class ExitDescriptorTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateexitDescriptorObject()
    {
        $object = new ExitDescriptor();

        $this->assertInstanceOf("\App\Entity\ExitDescriptor", $object);
    }

    /**
     * Test getId method
     */
    public function testGetId()
    {
        $object = new ExitDescriptor();

        $actualValue = $object->getId();

        $this->assertNull($actualValue);
    }

    /**
     * Test get/set leadsToRoom methods
     */
    public function testGetSetLeadsToRoom()
    {
        $object = new ExitDescriptor();

        $object->setLeadsToRoom("none");

        $actualValue = $object->getLeadsToRoom();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test get/set locatedInRoom methods
     */
    public function testGetSetlocatedInRom()
    {
        $object = new ExitDescriptor();

        $object->setLeadsToRoom("none");

        $actualValue = $object->getLeadsToRoom();

        $this->assertEquals($actualValue, "none");
    }

     /**
     * Test get/set name methods
     */
    public function testGetSetName()
    {
        $object = new ExitDescriptor();

        $object->setName("none");

        $actualValue = $object->getName();

        $this->assertEquals($actualValue, "none");
    }
}
