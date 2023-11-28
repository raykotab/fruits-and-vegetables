<?php

namespace App\Service;

use App\Domain\GreenProductsCollection;
use App\Domain\GreenProduct;

class StorageService
{
    private string $request;

    public function __construct(
        string $request
    ) 
    {
        $this->request = $request;
    }

    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     * Main service function taking a json request as a string and returning classified collections
     * with their weight in grams.
     * 
     * @return array of GreenProductsCollection
     */
    public function classifyGreens(): array
    {
        $requestArray = \json_decode($this->request, true);
        $fruitsCollection = new GreenProductsCollection();
        $vegetablesCollection = new GreenProductsCollection();

        $sortedCollections = [
            "Fruits" => $fruitsCollection,
            "Vegetables" => $vegetablesCollection
        ];

        foreach ($requestArray as $greenData) {
            $greenData = $this->translateWeightUnits($greenData);
            $greenProduct = new GreenProduct(
                $greenData["id"],
                $greenData["name"],
                $greenData["type"],
                $greenData["quantity"],
                $greenData["unit"]
            );
            $greenProduct->isFruit() ?
            $sortedCollections["Fruits"]->add($greenProduct) :
            $sortedCollections["Vegetables"]->add($greenProduct);
        }

        return $sortedCollections;
    }

    /**
     * Calculates the weight in grams for storage, when it comes as kilograms
     * 
     * @return array 
     */
    private function translateWeightUnits($greenData): array
    {
        if ($greenData["unit"] === "kg") {
            $greenData["quantity"] = $greenData["quantity"] * 1000;
            $greenData["unit"] = "g";
        }

        return $greenData;
    }
}
