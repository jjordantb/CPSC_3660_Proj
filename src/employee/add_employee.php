<?php
/**
 * Created by PhpStorm.
 * User: Kevin Okada
 * Date: 4/7/2018
 * Time: 5:15 PM
 */
require_once ("../db_query.php");

$success = false;
if (count($_GET) > 0) {
    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    $EmployeeID = rand(0, 999999999);
    $qry = $con->execute_query("INSERT INTO Employee VALUES ("
        . "'{$_GET['FirstName']}',"
        . "'{$_GET['LastName']}',"
        . "'{$_GET['Phone']}',"
        . "0,"
        . "$EmployeeID);"
    );

    if ($qry) {
        $success = true;
    }
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Add Employee</title>
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
    <h1>Add Employee</h1>
</div>
<div class="contents">
    <?php
    if ($success) {
        echo "Employee Added";
    }
    ?>
    <form action="add_employee.php">
        First Name<br>
        <input type="text" name="FirstName"><br>
        Last Name<br>
        <input type="text" name="LastName"><br>
        Phone<br>
        <input type="text" name="Phone"><br>
       <!--Commission<br>
       <input type="text" name="Commission"><br>
       <br>-->
        <input type="submit" value="Submit">
    </form>
</div>
</body>