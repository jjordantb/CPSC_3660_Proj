<?php
/**
 * Created by PhpStorm.
 * User: Azeruel
 * Date: 4/7/2018
 * Time: 5:15 PM
 */
require_once ("../db_query.php");

$success = false;
$con = new db_query();
if (!$con->is_connected()) {
    die("Connection Failed: " . $con->connection->connect_error);
}

$customer_id = rand(0, 999999999);
$qry = $con->execute_query("INSERT INTO Employee VALUES ("
    . "$EmployeeID,"
    . "'{$_GET['FirstName']}',"
    . "'{$_GET['LastName']}',"
    . "'{$_GET['Phone']}',"
    . "'{$_GET['Commission']}',"
);

if ($qry) {
    $success = true;
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
        <li class="menu-item"><a href="">Employee</a></li>
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
        Commission<br>
        <input type="text" name="Commission"><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
}
if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} else {
    echo 'Phew we have it!';
}