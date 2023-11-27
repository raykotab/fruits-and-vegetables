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
    public function testGetQuantity(
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

        $this->assertSame($expected[0], $this->sut->getQuantity($requestUnit));
        $this->assertSame($expected[1], $this->sut->getUnit());
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
}
