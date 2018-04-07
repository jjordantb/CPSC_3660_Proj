<?php
require_once ("../db_query.php");

$id = "Not Found";

if (sizeof($_GET) > 0) {

    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    $qry = $con->execute_query("SELECT * FROM Customer WHERE CustomerID=" . $_GET['id'] . ";");
    if ($row = $qry->fetch_array()) {
        $id = $row[0];
    }
}

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Customer <?php echo $id ?></title>
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
    <h1>Customer Information</h1>
</div>
<div class="contents">
    <?php
    if ($id != "Not Found") {
        $custQry = $con->execute_query("SELECT * FROM Customer WHERE CustomerID=$id;");
        if ($custQry->num_rows == 1) {
            $customerRow = $custQry->fetch_array();
            print "Customer {$customerRow['FirstName']} {$customerRow['LastName']} ID: {$customerRow['CustomerID']}";
            print "<br>";
        }

    } else {
        print "<p>Customer $id</p>";
    }
    print "<br>";
    ?>
<!--    <p>-- Repairs --</p>-->
<!---->
<!--    <table align="center">-->
<!--        <tr class="table-heading">-->
<!--            <th class="table-heading">RepairID</th>-->
<!--            <th class="table-heading">Problem</th>-->
<!--            <th class="table-heading">Estimated Cost</th>-->
<!--            <th class="table-heading">Actual Cost</th>-->
<!--        </tr>-->
<!--        --><?php
//        $repairQry = $con->execute_query("SELECT * FROM Repairs, CarPurchase WHERE Repairs.VehicleID=CarPurchase.VehicleID" .
//            " AND Repairs.VehicleID=$id;");
//        while($repRow = $repairQry->fetch_array()) {
//            $cost = $repRow['ActualCost'];
//            $repID = $repRow['RepairID'];
//            print "<tr>";
//            print "<th><a href=\"../repairs/repair.php?id=$repID&vehicleID=$id\" >" . $repRow['RepairID'] . "</a></th>";
//            print "<th><a href=\"../repairs/repair.php?id=$repID&vehicleID=$id\" >" . $repRow['Problem'] . "</a></th>";
//            print "<th><a href=\"../repairs/repair.php?id=$repID&vehicleID=$id\" >" . $repRow['Est_RepairCost'] . "</a></th>";
//            print "<th><a href=\"../repairs/repair.php?id=$repID&vehicleID=$id\" >" . (strlen($cost) == 0 ? "Incomplete" : $cost) . "</a></th>";
//            print "<tr>";
//        }
//        ?>
<!--    </table>-->
</div>
</body>