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
        <li class="menu-item"><a href="">Warranty Registry</a></li>
    </ul>
    <div class="user-logout">
        <p>User: John</p>
    </div>
</div>
<div class="main-title">
    <h1>Vehicle Inventory</h1>
</div>
<div class="contents">

    <h2>Stock</h2>

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
            require_once ("../db_query.php");

            $con = new db_query();
            if (!$con->is_connected()) {
                die("Connection Failed: " . $con->connection->connect_error);
            }

            $qry = $con->execute_query("SELECT * FROM BoughtVehicle;");

            while ($row = $qry->fetch_array()) {
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
        ?>
    </table>
    <br>
    <button onclick="location.href='add_vehicle.php'" type="button">Add Vehicle</button>
</div>
</body>