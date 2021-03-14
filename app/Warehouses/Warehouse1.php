<?php

namespace App\Warehouses;

use App\Goods\Flower;
use App\Product;
use App\ProductCollection;

class Warehouse1 implements iWarehouse
{
    private ProductCollection $warehouse;

    public function __construct()
    {
        $this->addStock();
    }

    private function addStock(): void
    {
        $json = json_decode(file_get_contents
            (
                '/home/janis/PhpstormProjects/first-homepage/storage/garden-garden.json'
            )
            , true);

        $this->warehouse = new ProductCollection;

        foreach($json as $product)
        {
            $this->warehouse->add(new Product(new Flower($product['name']), $product['price']), $product['amount']);
        }
    }

    public function getAllStock(): ProductCollection
    {
        return $this->warehouse;
    }

    public function setAmount(string $name, int $howMuch): int
    {
       return $this->warehouse->changeAmount($name, $howMuch);
    }
}