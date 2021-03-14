<?php

namespace App;

use App\Warehouses\iWarehouse;

class FlowerStore
{

    private array $warehouses;

    public function addWarehouse(iWarehouse $warehouse): void
    {
        $this->warehouses[] = $warehouse;
    }

    public function products(): ProductCollection
    {
        $products = new ProductCollection();

        foreach ($this->warehouses as $warehouse) {
            $warehouseProducts = $warehouse->getAllStock()->all();

            foreach ($warehouseProducts as $barCode => ['product' => $product, 'amount' => $amount]) {
                $products->add(
                    new Product(
                        $product->goods(),
                        $product->price() + ($product->price() * 0.2)
                    ),
                    $amount
                );
            }
        }
        return $products;
    }

    public function getWarehouses(): array
    {
        return $this->warehouses;
    }

    public function takeAmount(string $name, int $amount): void
    {
        foreach ($this->warehouses as $warehouse) {
            $change = $warehouse->setAmount($name, $amount);
            if ($change !== 0) {
                $amount = $change;
            } else {
                break;
            }
        }
    }

    public function getTotal(string $name,int $howMany): int
    {
        $total = 0;
        foreach($this->products()->all() as ['product' => $product, 'amount' => $amount])
        {
            if($product->goods()->name() === $name){
                $total = $product->price() * $howMany;
            }
        }
        $this->takeAmount($name, $howMany);
        return $total;
    }

}