<?php
require_once ("../db_query.php");

$id = "Not Found";

if (sizeof($_GET) > 0) {

    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    $qry = $con->execute_query("SELECT * FROM Warranties WHERE WarrantyID=" . $_GET['id'] . ";");
    if ($row = $qry->fetch_array()) {
        $id = $row[0];
    }
}

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Warranty <?php echo $id ?></title>
</head>

<body>
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
    <h1>Warranty</h1>
</div>
<div class="contents">
    <?php
    echo "ID: {$row['WarrantyID']}<br>";
    echo "Covers: {$row['ItemsCovered']}<br>";
    echo "Started: {$row['StartDate']}<br>";
    echo "Length: {$row['Length']}<br>";
    echo "Cost: {$row['Cost']}<br>";
    echo "Deductible: {$row['Deductible']}<br>";
    echo "Sale Reference: <a href='../sales/sale_info.php?={$row['SaleID']}' > {$row['SaleID']}</a><br>";
    echo "Employee Reference: <a href='../employee/employee_info.php?={$row['EmployeeID']}' > {$row['EmployeeID']}</a><br>";
    echo "Vehicle Reference: <a href='../inventory/vehicle_info.php?={$row['VehicleID']}' > {$row['VehicleID']}</a><br>";
    ?>
</div>
</body>