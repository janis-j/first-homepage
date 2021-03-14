<?php

require_once 'vendor/autoload.php';

use App\Application;

$flowerStore = new Application();
$printMessage = $flowerStore->printTotal($_GET);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flower store</title>
</head>
<body>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
    </tr>

    <?PHP
    $flowerStore->printProductTable();
    ?>

</table>

<p><?PHP echo $printMessage; ?></p>

<form action="" method="get">
    <p> Which flower: <input type="text" name="name"></p>
    <p> How many: <input type="number" name="amount"></p>
    <p><input type="radio" name="gender" value="female">Female</p>
    <p><input type="radio" name="gender" value="male">Male</p>
    <p><input type="submit">
</form>

</body>
</html>

