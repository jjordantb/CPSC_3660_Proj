<?php

$success = false;

if (sizeof($_GET) > 0) {
    $success = true;
    require_once ("../db_query.php");

    $count = 0;
    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    $veh_id = rand(0, 999999999);
    $purchase_id = rand(0, 999999999);
    $repair_id = rand(0, 999999999);
    $date = date("Y-m-d");

    $qry = $con->execute_update(
            "INSERT INTO CarPurchase VALUES (" .
            $purchase_id . "," .
            "'" . $_GET['location'] . "'" . "," .
            "'" . $date . "'" . "," .
            "'" . $_GET['auction'] . "'" . "," .
            "'" . $_GET['seller'] . "'" . "," .
            $veh_id . ");");

    $qry2 = $con->execute_update("INSERT INTO BoughtVehicle VALUES ("
        . $veh_id . ","
        . "'" . $_GET['make'] . "'" . ","
        . "'" . $_GET['model'] . "'" . ","
        . "'" . $_GET['year'] . "-01-01'" . ","
        . "'" . $_GET['condition'] . "'" . ","
        . $_GET['miles'] . ","
        . $_GET['book_price'] . ","
        . $_GET['price_paid'] . ","
        . $purchase_id . ","
        . $repair_id
        . ");");
}

?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Add Vehicles</title>
</head>

<body>
<div class="toolbar">
    <ul>
        <li class="tool-bar-title"><a href="../index.php">Navigation</a></li>
        <li class="menu-item"><a href="../summary/summary.php">Summary</a></li>
        <li class="menu-item"><a href="../inventory/inventory.php">Vehicle Inventory</a></li>
        <li class="menu-item"><a href="../customers/customers.php">Customer Registry</a></li>
        <li class="menu-item"><a href="">Warranty Registry</a></li>
    </ul>
    <div class="user-logout">
        <p>User: John</p>
    </div>
</div>
<div class="main-title">
    <h1>Add Vehicles</h1>
</div>
<div class="contents">
    <?php
    if ($success) {
        echo "Vehicle Added Successfully";
    }
    ?>
    <form action="add_vehicle.php">
        Location<br>
        <input type="text" name="location"><br>
        Aution(Y/N)<br>
        <input type="text" name="auction"><br>
        Seller<br>
        <input type="text" name="seller"><br>
        Make<br>
        <input type="text" name="make"><br>
        Model<br>
        <input type="text" name="model"><br>
        Year<br>
        <input type="text" name="year"><br>
        Color<br>
        <input type="text" name="color"><br>
        Miles<br>
        <input type="text" name="miles"><br>
        Condition<br>
        <input type="text" name="condition"><br>
        Book Price<br>
        <input type="text" name="book_price"><br>
        Price Paid<br>
        <input type="text" name="price_paid"><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>
</body>