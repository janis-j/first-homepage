<?php

namespace App\Warehouses;

use App\Goods\Flower;
use App\Product;
use App\ProductCollection;
use Doctrine\DBAL\DriverManager;

class Warehouse3 implements iWarehouse
{
    private ProductCollection $warehouse;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => 'codelex',
            'user' => '',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql'
        ];
        $conn = DriverManager::getConnection($connectionParams);

        $sql = "SELECT * FROM Products";
        $stmt = $conn->query($sql);

        $this->warehouse = new ProductCollection;

        while (($row = $stmt->fetchAssociative()) !== false) {
            $this->warehouse->add(new Product(new Flower($row['name']), $row['price']), $row['amount']);
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
