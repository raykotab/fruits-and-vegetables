<?php

namespace App\Tests\App\Service;

use App\Service\StorageService;
use App\GreensCollection;
use PHPUnit\Framework\TestCase;

class StorageServiceTest extends TestCase
{
    /** @var StorageService */
    private $sut;

    /** @var string */
    private $inputRequestMock;

    public function setUp(): void
    {
        $this->inputRequestMock = '[
            {
                "id": 1,
                "name": "Potatoes",
                "type": "vegetable",
                "quantity": 16,
                "unit": "kg"
            },
            {
                "id": 2,
                "name": "Bananas",
                "type": "fruit",
                "quantity": 2,
                "unit": "kg"
            }
        ]';
 
        $this->sut = new StorageService($this->inputRequestMock);
    }

    public function testClassifyGreens(): void
    {
        $sutResult = $this->sut->classifyGreens();

        $this->assertArrayHasKey('Fruits', $sutResult);
        $this->assertArrayHasKey('Vegetables', $sutResult);
        $this->assertInstanceOf(GreensCollection::class, $sutResult['Fruits']);
        $this->assertInstanceOf(GreensCollection::class, $sutResult['Vegetables']);
        $this->assertEquals("Potatoes", $sutResult["Vegetables"]->getGreens()[0]->name);
        $this->assertEquals("fruit", $sutResult["Fruits"]->getGreens()[0]->type);
    }
}
