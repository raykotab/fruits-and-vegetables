<?php

namespace App\Domain;

use App\Domain\GreenProduct;

class GreenProductsCollection
{
    private array $greens;

    public function __construct()
    {
        $this->greens = [];
    }

    public function add(GreenProduct $greenProduct): void
    {
        $this->greens[] = $greenProduct;
    }

    public function remove(int $id): array
    {
        return \array_filter(
            $this->greens,
            fn ($greenProduct) => $greenProduct->getId() !== $id
        );
    }

    public function list(): array
    {
        return $this->greens;
    }
}
