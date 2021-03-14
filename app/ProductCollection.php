<?php

namespace App;

class ProductCollection
{
    private array $products;

    public function add(Product $product, int $amount = 1)
    {
        $barcode = $product->barCode();
        if (isset($this->products[$barcode])) {
            $this->products[$barcode]['amount'] += $amount;
            return;
        }
        $this->products[$product->barCode()] = [
            'product' => $product,
            'amount' => $amount
        ];
    }

    public function all(): array
    {
        return $this->products;
    }

    public function changeAmount(string $name, int $howMuch): int
    {
        $change = $howMuch;
        foreach ($this->products as ['product' => $product, 'amount' => &$amount]) {
            if ($product->goods()->name() === $name) {
                switch (true) {
                    case ($amount < $howMuch):
                        $change = $howMuch - $amount;
                        $amount = 0;
                        break;
                    case ($amount >= $howMuch):
                        $amount -= $howMuch;
                        $change = 0;
                        break;
                    default:
                        $change = $howMuch;
                }
            }
        }
        return $change;
    }
}