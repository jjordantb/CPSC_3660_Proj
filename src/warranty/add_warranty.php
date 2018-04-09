<?php
/**
 * Created by PhpStorm.
 * User: Kevin Okada
 * Date: 4/7/2018
 * Time: 5:15 PM
 */
require_once ("../db_query.php");

$success = false;
if (count($_GET) > 0 && key_exists('Cost', $_GET)) {
    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    $war_id = rand(0, 999999999);
    $qry = $con->execute_query("INSERT INTO Warranties VALUES ("
        . "'{$_GET['ItemsCovered']}',"
        . "'" . date("Y-m-d") . "',"
        . "{$_GET['Cost']},"
        . "{$_GET['Length']},"
        . "{$_GET['Deductible']},"
        . "{$_GET['EmployeeID']},"
        . "{$_GET['SaleID']},"
        . "$war_id,"
        . "{$_GET['VehicleID']});"
    );

    if ($qry) {
        $success = true;
    }
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Add Warranty</title>
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
        echo "Warranty Added";
    }
    ?>
    <form action="add_warranty.php">
        Items Covered<br>
        <input type="text" name="ItemsCovered"><br>
        Cost<br>
        <input type="text" name="Cost"><br>
        Length<br>
        <input type="text" name="Length"><br>
        Deductible<br>
        <input type="text" name="Deductible"><br>
        <input type="hidden" name="EmployeeID" value="<?php echo $_GET['emp_id'] ?>">
        <input type="hidden" name="SaleID" value="<?php echo $_GET['sale_id'] ?>">
        <input type="hidden" name="VehicleID" value="<?php echo $_GET['veh_id'] ?>">
        <input type="submit" value="Submit">
    </form>
</div>
</body>