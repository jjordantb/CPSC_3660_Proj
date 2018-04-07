<?php
require_once ("../db_query.php");

$success = false;
if (key_exists('first_name', $_GET) && sizeof($_GET['first_name']) > 0) {

    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    $customer_id = rand(0, 999999999);
    $qry = $con->execute_query("INSERT INTO Customer VALUES ("
        . "$customer_id,"
        . "'{$_GET['first_name']}',"
        . "'{$_GET['last_name']}',"
        . "'{$_GET['gender']}',"
        . "'{$_GET['dob']}',"
        . "{$_GET['taxid']},"
        . "'{$_GET['address']}',"
        . "{$_GET['late_payments']},"
        . "'{$_GET['zip']}',"
        . "'{$_GET['state']}');"
    );

    if ($qry) {
        $success = true;
    }

}

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Add Customer</title>
</head>

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
        echo "Customer Added Successfully";
    }
    ?>
    <form action="add_customer.php">
        First Name<br>
        <input type="text" name="first_name"><br>
        Last Name<br>
        <input type="text" name="last_name"><br>
        Gender<br>
        <input type="radio" name="gender" value="M"> Male<br>
        <input type="radio" name="gender" value="F"> Female<br>
        <input type="radio" name="gender" value="O"> Other<br>
        Date of Birth (YYYY-MM-DD)<br>
        <input type="text" name="dob"><br>
        TaxID<br>
        <input type="text" name="taxid"><br>
        Address<br>
        <input type="text" name="address"><br>
        Number of Late Payments<br>
        <input type="text" name="late_payments"><br>
        Zip<br>
        <input type="text" name="zip"><br>
        State<br>
        <input type="text" name="state"><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>
</body>