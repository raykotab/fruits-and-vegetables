<?php

namespace App\Domain;

class GreenProduct
{
    private int $id;
    private string $name;
    private string $type;
    private float $weightQuantity;
    private string $weightUnit;

    public function __construct(
        int $id,
        string $name,
        string $type,
        float $weightQuantity,
        string $weightUnit
    ) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->weightQuantity = $weightQuantity;
        $this->weightUnit = $weightUnit;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getWeightQuantity(?string $weightUnit = ''): float
    {
        if (!empty($weightUnit)) {
            if ($weightUnit === "kg" && $this->weightUnit === "g") {
                $this->weightQuantity /= 1000;
                $this->weightUnit = "kg";
            } elseif ($weightUnit === "g" && $this->weightUnit === "kg") {
                $this->weightQuantity *= 1000;
                $this->weightUnit = "g";
            }
        }

        return $this->weightQuantity;
    }

    public function getWeightUnit(): string
    {
        return $this->weightUnit;
    }

    public function isFruit(): bool
    {
        return $this->type === "fruit";
    }
}
