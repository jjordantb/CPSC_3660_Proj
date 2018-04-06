<?php
require_once ("../db_query.php");

$id = "Not Found";

if (sizeof($_GET) > 0) {

    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    $qry = $con->execute_query("SELECT * FROM BoughtVehicle WHERE VechicleID=" . $_GET['id'] . ";");
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
    ?>
</div>
</body>