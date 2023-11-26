<?php

namespace App\Tests\App\Service;

use App\GreenProduct;
use App\GreensCollection;
use PHPUnit\Framework\TestCase;

class GreensCollectionTest extends TestCase
{
    /** @var GreensCollection */
    private $sut;

    /** @var GreenProduct */
    private $greenProduct;

    public function setUp(): void
    {
        $this->sut = new GreensCollection();
        $this->greenProduct = $this->createMock(GreenProduct::class);
        $this->greenProduct->id = 1;
        $this->greenProduct->name = "Potatoes";
        $this->greenProduct->type = "vegetable";
        $this->greenProduct->quantity = 16;
        $this->greenProduct->unit = "kg";
    }

    public function testAddGreenProduct(): void
    {
        $this->sut->addGreenProduct($this->greenProduct);
        $result = $this->sut->getGreens();

        $this->assertIsArray($result);
        $this->assertInstanceOf(GreenProduct::class, $result[0]);
    }

    public function testRemove(): void
    {
        $removedResult = $this->sut->remove($this->greenProduct->id);
        $this->assertIsArray($removedResult);
        $this->assertEmpty($removedResult);
    }
}
