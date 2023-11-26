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
        $this->translateWeightUnits();
    }

    /**
     * Transforms the weight in grams when it comes as kilograms
     * 
     * @return void 
     */
    private function translateWeightUnits(): void
    {
        if ($this->unit === 'kg') {
            $this->quantity = $this->quantity * 1000;
            $this->unit = 'g';
        }
    }
}