<?php

namespace App;

use App\GreenProduct;

class GreensCollection
{
    private array $greensCollection = [];

    public function getGreens(): array
    {
        return $this->greensCollection;
    }

    public function addGreenProduct(GreenProduct $greenProduct): void
    {
        $this->greensCollection[]
            = $greenProduct;
    }

    public function remove(int $id): array
    {
        return array_splice($this->greensCollection, $id,1);
    }

    public function list()
    {
    }
}
