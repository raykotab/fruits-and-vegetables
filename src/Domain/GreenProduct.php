<?php

namespace App\Domain;

class GreenProduct
{
    private int $id;
    private string $name;
    private string $type;
    private float $quantity;
    private string $unit;

    public function __construct(
        int $id,
        string $name,
        string $type,
        float $quantity,
        string $unit
    ) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->quantity = $quantity;
        $this->unit = $unit;
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

    public function getQuantity(?string $unit = ''): float
    {
        if (!empty($unit)) {
            if ($unit === "kg" && $this->unit === "g") {
                $this->quantity /= 1000;
                $this->unit = "kg";
            } elseif ($unit === "g" && $this->unit === "kg") {
                $this->quantity *= 1000;
                $this->unit = "g";
            }
        }

        return $this->quantity;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }
}
