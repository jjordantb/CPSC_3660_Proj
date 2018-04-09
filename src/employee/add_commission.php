<?php
/**
 * Created by PhpStorm.
 * User: Kevin Okada
 * Date: 4/8/2018
 * Time: 11:27 AM
 */
require_once ("../db_query.php");

$success = false;
if (count($_GET) > 0) {
    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    $qry = $con->execute_query("UPDATE Employee SET Commission = '{$_GET['Commission']}' WHERE EmployeeID = '{$_GET['EmployeeID']}'");
    if ($qry) {
        $success = true;
    }
}

?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Update Commission</title>
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
    <h1>Add Commission</h1>
</div>
<div class="contents">
    <?php
    if ($success) {
        echo "Added Commission";
    }
    ?>
    <form action="add_commission.php">
        Employee ID<br>
        <input type="text" name="EmployeeID"><br>
        Commission<br>
        <input type="text" name="Commission"><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
