<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 4/8/2018
 * Time: 1:31 AM
 */
require_once ("../db_query.php");

$success = false;
$con = new db_query();
if (!$con->is_connected()) {
    die("Connection Failed: " . $con->connection->connect_error);
}

$SaleID = rand(0, 999999999);
$qry = $con->execute_query("INSERT INTO Sale VALUES ("
    . "$SaleID,"
    . "'{$_GET['Date']}',"
    . "'{$_GET['TotalDue']}',"
    . "'{$_GET['DownPayment']}',"
    . "'{$_GET['FinanceAmount']}');"
);

if ($qry) {
    $success = true;
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Add Sale</title>
</head>

<div class="toolbar">
    <ul>
        <li class="tool-bar-title"><a href="../index.php">Navigation</a></li>
        <li class="menu-item"><a href="../summary/summary.php">Summary</a></li>
        <li class="menu-item"><a href="../inventory/inventory.php">Vehicle Inventory</a></li>
        <li class="menu-item"><a href="../customers/customers.php">Customer Registry</a></li>
        <li class="menu-item"><a href="">Employee</a></li>
        <li class="menu-item"><a href="../warranty/warranties.php">Warranty Registry</a></li>
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
        echo "Sale Added";
    }
    ?>
    <form action="add_Sale.php">
        Date of Birth (YYYY-MM-DD)<br>
        <input type="text" name="Date"><br>
        Total Due<br>
        <input type="text" name="TotalDue"><br>
        Down Payment<br>
        <input type="text" name="DownPayment"><br>
        Finance Amount<br>
        <input type="text" name="FinanceAmount"><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
}