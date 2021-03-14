<?php

namespace App;

use App\Warehouses\Warehouse1;
use App\Warehouses\Warehouse2;
use App\Warehouses\Warehouse3;
use NumberFormatter;

class Application
{
    private FlowerStore $flowerStore;

    public function __construct()
    {
        $this->flowerStore = new FlowerStore;
        $this->flowerStore->addWarehouse(new Warehouse1);
        $this->flowerStore->addWarehouse(new Warehouse2);
        $this->flowerStore->addWarehouse(new Warehouse3);
    }

    public function printProductTable()
    {
        $f = new NumberFormatter("en", NumberFormatter::CURRENCY);
        foreach ($this->flowerStore->products()->all() as ['product' => $product, 'amount' => $amount]) {
            echo
            "<tr>
                 <td>{$product->goods()->name()} </td> 
                 <td>{$f->formatCurrency($product->price() / 100, "EUR")} </td>
                 <td> $amount </td>
            </tr>";
        }
    }
//            $whichFlowers = ucfirst(strtolower(readline("Which flowers would you like to buy?: ")));
//            $amount = (int)readline("How many?: ");
//            $gender = strtolower(readline("What is you're gender (f/m)?: "));
//
//            echo $this->printTotal($whichFlowers, $amount, $gender);
//            sleep(3);
//        }
//    }
//
    public function printTotal(array $userInput): string
    {
        $f = new NumberFormatter("en", NumberFormatter::CURRENCY);
        $userName = ucfirst(strtolower($userInput['name']));
        switch ($userInput['gender']) {
            case 'male':
                return "Good choice! $userName: {$userInput['amount']} pcs, In total - " .
                    $f->formatCurrency($this->flowerStore->getTotal($userName, $userInput['amount']) / 100, "EUR")
                    . PHP_EOL;
            case 'female':
                $total = $this->flowerStore->getTotal($userName, $userInput['amount']);
                return "20% discount just for you!! $userName: {$userInput['amount']} pcs, In total - " .
                    $f->formatCurrency(($total * 0.2 + $total) / 100, "EUR") . PHP_EOL;
            case null:
                return "Please fill out the form! ";
            default:
                return 'Sorry, input vas invalid...' . PHP_EOL;
        }
    }
}