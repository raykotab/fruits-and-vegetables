<?php

namespace App\Service;

use App\GreensCollection;
use App\GreenProduct;

class StorageService
{
    protected string $request = '';

    protected const FRUIT = 'fruit';
    protected const VEGETABLE = 'vegetable';

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
     * Main service function taking a json request as a string, and returning classified collections.
     * 
     * @return array of GreensCollection
     */
    public function classifyGreens(): array
    {
        $requestArray = json_decode($this->request, true);
        $fruitsCollection = new GreensCollection();
        $vegetablesCollection = new GreensCollection();

        foreach ($requestArray as $greenData) {
            $greenProduct = new GreenProduct(
                $greenData['id'],
                $greenData['name'],
                $greenData['type'],
                $greenData['quantity'],
                $greenData['unit']
            );
            if ($greenProduct->type === self::FRUIT) {
                $fruitsCollection->addGreenProduct($greenProduct);
            } elseif ($greenProduct->type === self::VEGETABLE) {
                $vegetablesCollection->addGreenProduct($greenProduct);
            }
        }
        
        return [
            'Fruits'=> $fruitsCollection,
            'Vegetables'=> $vegetablesCollection
        ];
    }
}
