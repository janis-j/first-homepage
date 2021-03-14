<?php

namespace App\Warehouses;

use App\Goods\Flower;
use App\Product;
use App\ProductCollection;

class Warehouse2 implements iWarehouse
{
    private ProductCollection $warehouse;

    public function __construct()
    {
        $this->addStock();
    }

    public function getAllStock(): ProductCollection
    {
        return $this->warehouse;
    }

    public function setAmount(string $name, int $howMuch): int
    {
      return $this->warehouse->changeAmount($name, $howMuch);
    }

    private function addStock(): void
    {
        $this->warehouse = new ProductCollection;

        $warehouse = '/home/janis/PhpstormProjects/first-homepage/storage/garden.csv';

        $warehouseCollection = [];

        if (($penWarehouse = fopen("{$warehouse}", "r")) !== false)
        {
            while (($product = fgetcsv($penWarehouse, 1000, ",")) !== false)
            {
                $warehouseCollection[] = $product;
            }
            fclose($penWarehouse);
        }
        foreach($warehouseCollection as $warehouse)
        {
            $this->warehouse->add(new Product(new Flower($warehouse[0]), $warehouse[1]), $warehouse[2]);
        }
    }
}