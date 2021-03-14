<?php

namespace App\Warehouses;

use App\Goods\Flower;
use App\Product;
use App\ProductCollection;

class Warehouse3 implements iWarehouse
{
    private ProductCollection $warehouse;

    public function __construct()
    {
        $this->warehouse = new ProductCollection;

        $this->warehouse->add(new Product(new Flower('Tulip'), 10), 150);

        $this->warehouse->add(new Product(new Flower('Iris'), 50), 150);
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