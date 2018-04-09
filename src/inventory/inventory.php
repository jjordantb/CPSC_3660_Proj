<?php
require_once ("../db_query.php");

$con = new db_query();
if (!$con->is_connected()) {
    die("Connection Failed: " . $con->connection->connect_error);
}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Inventory</title>
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
    <h1>Vehicle Inventory</h1>
</div>
<div class="contents">

    <h2>Current Stock</h2>

    <table align="center">
        <tr class="table-heading">
            <th class="table-heading">ID</th>
            <th class="table-heading">Make</th>
            <th class="table-heading">Model</th>
            <th class="table-heading">Year</th>
            <th class="table-heading">Condition</th>
            <th class="table-heading">Miles</th>
            <th class="table-heading">Book Price</th>
            <th class="table-heading">Price Paid</th>
            <th class="table-heading">PurchaseID</th>
            <th class="table-heading">RepairID</th>
        </tr>
        <?php
            $qry = $con->execute_query("SELECT * FROM Vehicle;");

            while ($row = $qry->fetch_array()) {
                if ($row["Sold"] == 0) {
                    $date = date('Y', strtotime($row[3]));
                    print "<tr>";
                    print "<th><a href=\"vehicle_info.php?id=" . $row[0] . "\">" . $row[0] . "</a></th>";
                    print "<th><a href=\"vehicle_info.php?id=" . $row[0] . "\">" . $row[1] . "</a></th>";
                    print "<th><a href=\"vehicle_info.php?id=" . $row[0] . "\">" . $row[2] . "</a></th>";
                    print "<th><a href=\"vehicle_info.php?id=" . $row[0] . "\">" . $date . "</a></th>";
                    print "<th><a href=\"vehicle_info.php?id=" . $row[0] . "\">" . $row[4] . "</a></th>";
                    print "<th><a href=\"vehicle_info.php?id=" . $row[0] . "\">" . $row[5] . "</a></th>";
                    print "<th><a href=\"vehicle_info.php?id=" . $row[0] . "\">" . $row[6] . "</a></th>";
                    print "<th><a href=\"vehicle_info.php?id=" . $row[0] . "\">" . $row[7] . "</a></th>";
                    print "<th><a href=\"vehicle_info.php?id=" . $row[0] . "\">" . $row[8] . "</a></th>";
                    print "<th><a href=\"vehicle_info.php?id=" . $row[0] . "\">" . $row[9] . "</a></th>";
                    print "</tr>";
                }
            }
        ?>
    </table>
    <br>
    <button onclick="location.href='add_vehicle.php'" type="button">Add Vehicle</button>
    <br>
    <h2>Sold Vehicles</h2>

    <table align="center">
        <tr class="table-heading">
            <th class="table-heading">SaleID</th>
            <th class="table-heading">VehicleID</th>
            <th class="table-heading">Owner</th>
            <th class="table-heading">Address</th>
        </tr>
        <?php
        $qry = $con->execute_query("SELECT S.CustomerID, S.SaleID, S.VehicleID, C.FirstName, C.LastName, C.Address 
                                            FROM Sale AS S, Customer AS C 
                                            WHERE S.CustomerID=C.CustomerID 
                                            AND S.VehicleID IN (SELECT VehicleID FROM Vehicle WHERE Sold=1);");

        while ($row = $qry->fetch_array()) {
            print "<tr>";
            print "<th><a href=\"vehicle_info.php?id=" . $row['VehicleID'] . "\">" . $row['SaleID'] . "</a></th>";
            print "<th><a href=\"vehicle_info.php?id=" . $row['VehicleID'] . "\">" . $row['VehicleID'] . "</a></th>";
            print "<th><a href=\"vehicle_info.php?id=" . $row['VehicleID'] . "\">" . $row['FirstName'] . " " . $row['LastName'] . "</a></th>";
            print "<th><a href=\"vehicle_info.php?id=" . $row['VehicleID'] . "\">" . $row['Address'] . "</a></th>";
            print "</tr>";
        }
        ?>
    </table>

</div>
</body>