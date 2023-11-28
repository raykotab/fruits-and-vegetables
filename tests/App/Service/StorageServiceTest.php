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

        $this->assertArrayHasKey("Fruits", $sutResult);
        $this->assertArrayHasKey("Vegetables", $sutResult);

        $this->assertInstanceOf(GreenProductsCollection::class, $sutResult["Fruits"]);
        $this->assertInstanceOf(GreenProductsCollection::class, $sutResult["Vegetables"]);

        $this->assertEquals("Carrot", $sutResult["Vegetables"]->list()[0]->getName());
        $this->assertEquals("fruit", $sutResult["Fruits"]->list()[0]->getType());
        
        $this->assertEquals(20000.0, $sutResult["Fruits"]->list()[0]->getWeightQuantity());
        $this->assertEquals("g", $sutResult["Fruits"]->list()[0]->getWeightUnit());
    }
}
