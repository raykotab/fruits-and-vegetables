<?php
namespace App;

Class GreenProduct
{
    public int $id;
    public string $name;
    public string $type;
    public int $quantity;
    public string $unit;

    public function __construct(
        int $id,
        string $name,
        string $type,
        int $quantity,
        string $unit
    ) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->quantity = $quantity;
        $this->unit = $unit;
    }
}