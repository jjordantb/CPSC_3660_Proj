<?php
require_once ("../db_query.php");

$id = "Not Found";

if (sizeof($_GET) > 0) {

    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    $qry = $con->execute_query("SELECT * FROM Sale WHERE SaleID=" . $_GET['id'] . ";");
    if ($row = $qry->fetch_array()) {
        $id = $row[0];
    }
}

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Sale <?php echo $id ?></title>
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
    <h1>Sale Information</h1>
</div>
<div class="contents">
    <?php
    if ($id != "Not Found") {
        $custQry = $con->execute_query("SELECT * FROM Sale WHERE SaleID=$id;");
        if ($custQry->num_rows == 1) {
            $customerRow = $custQry->fetch_array();
            print "<br>Sale ID: {$customerRow['SaleID']}";
            print "<br>Date: {$customerRow['Date']}";
            print "<br>Total Due: {$customerRow['TotalDue']}";
            print "<br>Down Payment: {$customerRow['DownPayment']}";
            print "<br>Finance Amount: {$customerRow['FinanceAmount']}";
            print "<br>Customer: <a href='../customers/customer_info.php?{$customerRow['CustomerID']}'>{$customerRow['CustomerID']}</a>";
            print "<br>Employee ID: {$customerRow['EmployeeID']}";
            print "<br>Vehicle: <a href='../inventory/vehicle_info.php?{$customerRow['VehicleID']}'>{$customerRow['VehicleID']}</a>";
        }
    } else {
        print "<p>Sale $id</p>";
    }
    print "<br>";
    ?>
    <br>
    <table align="center">
        <tr class="table-heading">
            <th class="table-heading">WarrantyID</th>
            <th class="table-heading">Covered</th>
            <th class="table-heading">Cost</th>
            <th class="table-heading">Starts</th>
            <th class="table-heading">Length</th>
            <th class="table-heading">Deductible</th>
        </tr>
        <?php
        $qry = $con->execute_query("SELECT * FROM Warranties;");
        while ($row = $qry->fetch_array()) {
            print "<tr>";
            print "<th><a>" . $row['WarrantyID'] . "</a></th>";
            print "<th><a>" . $row['ItemsCovered'] . "</a></th>";
            print "<th><a>" . $row['Cost'] . "</a></th>";
            print "<th><a>" . $row['StartDate'] . "</a></th>";
            print "<th><a>" . $row['Length'] . "</a></th>";
            print "<th><a>" . $row['Deductible'] . "</a></th>";
            print "</tr>";
        }
        ?>
    </table>
    <br>
    <?php
    echo "<button onclick=\"location.href='../warranty/add_warranty.php?sale_id={$id}&emp_id={$customerRow['EmployeeID']}&veh_id={$customerRow['VehicleID']}'\" type=\"button\">Add Warranty</button>";
    ?>
</div>
</body>