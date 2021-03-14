<?php

namespace App;

use App\goods\iGoods;

class Product

{
    private iGoods $goods;
    private int $price;

    public function __construct(iGoods $goods, int $price)
    {
        $this->price = $price;
        $this->goods = $goods;
    }

    public function goods(): iGoods
    {
        return $this->goods;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function barCode(): string
    {
        return md5($this->goods->id());
    }
}