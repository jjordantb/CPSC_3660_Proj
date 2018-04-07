<?php
require_once ("../db_query.php");

$id = "Not Found";

if (sizeof($_GET) > 0) {

    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }


    $qry = $con->execute_query("SELECT * FROM BoughtVehicle WHERE VehicleID=" . $_GET['id'] . ";");
    if ($row = $qry->fetch_array()) {
        $id = $row[0];
    }
}

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Vehicle <?php echo $id ?></title>
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
    <h1>Vehicle Information</h1>
</div>
<div class="contents">
    <?php
    if ($id != "Not Found") {
        $purchaseQry = $con->execute_query("SELECT * FROM CarPurchase, BoughtVehicle WHERE CarPurchase.VehicleID" .
            "=BoughtVehicle.VehicleID AND CarPurchase.VehicleID=" . $id . ";");
        if ($purchaseQry->num_rows == 1) {
            $purRow = $purchaseQry->fetch_array();
            print "Vehicle " . ($purRow['Auction'] == "Y" ? "was" : "wasn't") . " purchased at auction. "
                ."It was purchased in " . $purRow['Location'] . " on "
                . $purRow['PurchaseDate'] . " from " . $purRow['Seller_Dealer']. ".";
            print "<br>";
        }

        $date = date('Y', strtotime($row[3]));
        print "<p>Summary for Vehicle $id</p>";
        print "<p>Make: $row[1]</p>";
        print "<p>Model: $row[2]</p>";
        print "<p>Year: $date</p>";
        print "<p>Car Condition: $row[4]</p>";
        print "<p>Miles: $row[5]</p>";
        print "<p>Book Price: $row[6]</p>";
        print "<p>Price Paid: $row[7]</p>";
        # purchase / warenty record links
    } else {
        print "<p>Vehicle $id</p>";
    }
    print "<br>";
    ?>
    -- Repairs --

    <table align="center">
        <tr class="table-heading">
            <th class="table-heading">RepairID</th>
            <th class="table-heading">Problem</th>
            <th class="table-heading">Estimated Cost</th>
            <th class="table-heading">Actual Cost</th>
        </tr>
        <?php
        $repairQry = $con->execute_query("SELECT * FROM Repairs, CarPurchase WHERE Repairs.VehicleID=CarPurchase.VehicleID" .
            " AND Repairs.VehicleID=$id;");
        while($repRow = $repairQry->fetch_array()) {
            $cost = $repRow['ActualCost'];
            $repID = $repRow['RepairID'];
            print "<tr>";
            print "<th><a href=\"../repairs/repair.php?id=$repID&vehicleID=$id\" >" . $repRow['RepairID'] . "</a></th>";
            print "<th><a href=\"../repairs/repair.php?id=$repID&vehicleID=$id\" >" . $repRow['Problem'] . "</a></th>";
            print "<th><a href=\"../repairs/repair.php?id=$repID&vehicleID=$id\" >" . $repRow['Est_RepairCost'] . "</a></th>";
            print "<th><a href=\"../repairs/repair.php?id=$repID&vehicleID=$id\" >" . (strlen($cost) == 0 ? "Incomplete" : $cost) . "</a></th>";
            print "<tr>";
        }
        ?>
    </table>
</div>
</body>