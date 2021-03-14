<?php

namespace App\Warehouses;

use App\ProductCollection;

interface iWarehouse
{

    public function getAllStock(): ProductCollection;

    public function setAmount(string $name, int $howMuch): int;

}