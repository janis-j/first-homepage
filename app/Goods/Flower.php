<?php

namespace App\Goods;

class Flower implements iGoods
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function id(): string
    {
        return 'FLOWER_' . $this->name;
    }
}