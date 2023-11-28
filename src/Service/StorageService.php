<?php

namespace App\Service;

use App\Domain\GreenProductsCollection;
use App\Domain\GreenProduct;

class StorageService
{
    private string $request;

    public function __construct(
        string $request
    ) {
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

        $sortedCollections = $this->instantiateCollections();

        foreach ($requestArray as $greenData) {
            $greenData = $this->translateWeightUnits($greenData);
            
            $greenProduct = $this->instantiateProduct($greenData);
            $greenProduct->isFruit() ?
                $sortedCollections["Fruits"]->add($greenProduct) :
                $sortedCollections["Vegetables"]->add($greenProduct);
        }

        return $sortedCollections;
    }

    /**
     * This function instantiates both collections and returns them in array
     * 
     * @return array of GreenProductsCollection
     */
    private function instantiateCollections(): array
    {
        $fruitsCollection = new GreenProductsCollection();
        $vegetablesCollection = new GreenProductsCollection();

        return [
            "Fruits" => $fruitsCollection,
            "Vegetables" => $vegetablesCollection
        ];
    }

    /**
     * Calculates the weight in grams for storage, when it comes as kilograms
     * @param array
     * 
     * @return array 
     */
    private function translateWeightUnits(array $greenData): array
    {
        if ($greenData["unit"] === "kg") {
            $greenData["quantity"] = $greenData["quantity"] * 1000;
            $greenData["unit"] = "g";
        }

        return $greenData;
    }

    /**
     * This function instantiates the product and returns it.
     * @param array
     * 
     * @return GreenProduct 
     */
    private function instantiateProduct(array $greenData): GreenProduct
    {
        return new GreenProduct(
            $greenData["id"],
            $greenData["name"],
            $greenData["type"],
            $greenData["quantity"],
            $greenData["unit"]
        );
    }
}
