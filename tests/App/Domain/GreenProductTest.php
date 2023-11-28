<?php

namespace App\Tests\App\Service;

use App\Domain\GreenProduct;
use PHPUnit\Framework\TestCase;

class GreenProductTest extends TestCase
{
    private GreenProduct $sut;

    /**
     * @dataProvider provideWeightRequests
     */
    public function testGetWeightQuantity(
        float $weight,
        string $unit,
        string $requestUnit,
        array $expected
    ): void
    {
        $this->sut = new GreenProduct(
            1,
            "Potatoes",
            "vegetable",
            $weight,
            $unit
        );

        $this->assertSame($expected[0], $this->sut->getWeightQuantity($requestUnit));
        $this->assertSame($expected[1], $this->sut->getWeightUnit());
    }

    public function provideWeightRequests(): array
    {
        return [
            "caseG" => [
                "weight" => 16,
                "unit" => "kg",
                "requestUnit" => "g",
                "expected" => [16000.0, "g"]
            ],
            "caseKg" => [
                "weight" => 12000,
                "unit" => "g",
                "requestUnit" => "kg",
                "expected" => [12.0, "kg"]
            ],
            "caseNone" => [
                "weight" => 12,
                "unit" => "Kg",
                "requestUnit" => "",
                "expected" => [12.0, "Kg"]
            ]
        ];
    }

    /**
     * @dataProvider isFruitProvider
     */
    public function testIsFruit(
        GreenProduct $greenProduct,
        bool $expected
    ): void
    {
        $this->assertSame($expected, $greenProduct->isFruit());
    }

    public function isFruitProvider(): array
    {
        return [
            "caseTrue" => [
                new GreenProduct(1,"peaches","fruit", 12.5, "kg"),
                "expected" => true
            ],
            "caseFalse" => [
                new GreenProduct(1,"potatoes","vegetable", 12.5, "kg"),
                "expected" => false
            ]
        ];
    }
}
