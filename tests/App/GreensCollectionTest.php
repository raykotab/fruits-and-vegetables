<?php

namespace App\Tests\App\Service;

use App\GreenProduct;
use App\GreensCollection;
use PHPUnit\Framework\TestCase;

class GreensCollectionTest extends TestCase
{
    /** @var GreenCollection */
    private $sut;

    public function setUp(): void
    {
        $this->sut = new GreensCollection();
    }
    
    public function testAddGreenProduct(): void
    {
        $greenProduct = $this->createMock(GreenProduct::class);
        $this->sut->addGreenProduct($greenProduct);
        $result = $this->sut->getGreens();

        $this->assertIsArray($result);
        $this->assertInstanceOf(GreenProduct::class, $result[0]);
    }
}
