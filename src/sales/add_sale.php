<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 4/8/2018
 * Time: 1:31 AM
 */
require_once ("../db_query.php");

$success = false;
if (count($_GET) > 0 && key_exists('VehicleID', $_GET)) {
    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    $SaleID = rand(0, 999999999);
    $qry = $con->execute_query("INSERT INTO Sale VALUES ("
        . "$SaleID,"
        . "'" . date("Y-m-d") . "',"
        . "'{$_GET['TotalDue']}',"
        . "'{$_GET['DownPayment']}',"
        . "'{$_GET['FinanceAmount']}',"
        . "'{$_GET['customer_id']}',"
        . "'{$_GET['EmployeeID']}',"
        . "'{$_GET['VehicleID']}'"
        .
        ");"
    );

    $qry2 = $con->execute_update("UPDATE Vehicle SET Sold=1 WHERE VehicleID={$_GET['VehicleID']}");

    if ($qry && $qry2) {
        $success = true;
    }
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
        <li class="menu-item"><a href="../employee/employees.php">Employee</a></li>
        <li class="menu-item"><a href="../warranty/warranties.php">Warranty Registry</a></li>
    </ul>
    <div class="user-logout">
        <p>User: John</p>
    </div>
</div>
<div class="main-title">
    <h1>Create Sale</h1>
</div>
<div class="contents">
    <?php
    if ($success) {
        echo "Sale Added";
    }
    ?>
    <form action="add_sale.php">
        Vehicle ID<br>
        <input type="text" name="VehicleID"><br>
        Employee ID<br>
        <input type="text" name="EmployeeID"><br>
        Total Due<br>
        <input type="text" name="TotalDue"><br>
        Down Payment<br>
        <input type="text" name="DownPayment"><br>
        Finance Amount<br>
        <input type="text" name="FinanceAmount"><br>
        <br>
        <input type="hidden" name="customer_id" value="<?php echo $_GET['customer_id'] ?>">
        <input type="submit" value="Submit">
    </form>
</div>
</body>