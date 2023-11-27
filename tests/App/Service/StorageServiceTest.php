<?php

namespace App\Tests\App\Service;

use App\Service\StorageService;
use App\Domain\GreenProductsCollection;
use PHPUnit\Framework\TestCase;

class StorageServiceTest extends TestCase
{
    /** @var StorageService */
    private $sut;

    public function setUp(): void
    {
        $inputrequest = file_get_contents("request.json");
        $this->sut = new StorageService($inputrequest);
    }

    public function testClassifyGreens(): void
    {
        $sutResult = $this->sut->classifyGreens();

        $this->assertArrayHasKey("fruit", $sutResult);
        $this->assertArrayHasKey("vegetable", $sutResult);

        $this->assertInstanceOf(GreenProductsCollection::class, $sutResult["fruit"]);
        $this->assertInstanceOf(GreenProductsCollection::class, $sutResult["vegetable"]);

        $this->assertEquals("Carrot", $sutResult["vegetable"]->list()[0]->getName());
        $this->assertEquals("fruit", $sutResult["fruit"]->list()[0]->getType());
        
        $this->assertEquals(20000.0, $sutResult["fruit"]->list()[0]->getQuantity());
        $this->assertEquals("g", $sutResult["fruit"]->list()[0]->getUnit());
    }
}
