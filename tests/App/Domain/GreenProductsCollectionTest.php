<?php

namespace App\Tests\App\Service;

use App\Domain\GreenProduct;
use App\Domain\GreenProductsCollection;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GreenProductsCollectionTest extends TestCase
{
    private GreenProductsCollection $sut;
    private GreenProduct&MockObject $mockedGreenProduct1;
    private GreenProduct&MockObject $mockedGreenProduct2;
    private GreenProduct $mockedGreenProduct3;

    public function setUp(): void
    {
        $this->sut = new GreenProductsCollection();

        $this->mockedGreenProduct1 = $this->createMock(GreenProduct::class);
        $this->mockedGreenProduct2 = $this->createMock(GreenProduct::class);

        $this->mockedGreenProduct3 = new GreenProduct(
            14,
            "peaches",
            "fruit",
            3.5,
            "kg"
        );

        $this->sut->add($this->mockedGreenProduct1);
        $this->sut->add($this->mockedGreenProduct2);
        $this->sut->add($this->mockedGreenProduct3);
    }

    public function testAddAndList(): void
    {
        $result = $this->sut->list();
        
        $this->assertIsArray($result);
        $this->assertInstanceOf(GreenProduct::class, $result[0]);
        $this->assertCount(3, $result);
        $this->assertSame("peaches", $result[2]->getName());
    }

    public function testRemove(): void
    {
        $this->mockedGreenProduct1
            ->expects($this->exactly(2))
            ->method("getId")
            ->willReturn(1);

        $this->mockedGreenProduct2
            ->expects($this->exactly(2))
            ->method("getId")
            ->willReturn(2);

        $removedResult = $this->sut->remove(14);

        $this->assertIsArray($removedResult);
        $this->assertCount(2, $removedResult);
        $this->assertSame(1, $removedResult[0]->getId());
        $this->assertSame(2, $removedResult[1]->getId());
        $this->assertFalse(isset($removedResult[2]));
    }
}
