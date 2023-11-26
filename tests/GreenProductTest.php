<?php

namespace App\Tests\App\Service;

use App\GreenProduct;
use PHPUnit\Framework\TestCase;

class GreenProductTest extends TestCase
{
    /** @var GreenProduct */
    private $sut;

    /**
     * @dataProvider provideWeightUnits
     */
    public function testTranslateWeightUnits(
        int $weight,
        string $unit,
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

        $this->assertSame($expected[0], $this->sut->quantity);
        $this->assertSame($expected[1], $this->sut->unit);
    }

    public function provideWeightUnits(): array
    {
        return [
            "caseKg" => [
                "weight" => 16,
                "unit" => "kg",
                "expected" => [16000, "g"]
            ],
            "caseG" => [
                "weight" => 1200,
                "unit" => "g",
                "expected" => [1200, "g"]
            ],
        ];
    }
}
