<?php
require_once ("../db_query.php");

$id = "Not Found";

if (sizeof($_GET) > 0) {

    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    if (array_key_exists('id', $_GET)) {
        $qry = $con->execute_query("SELECT * FROM Repairs WHERE RepairID=" . $_GET['id'] . ";");
        if ($row = $qry->fetch_array()) {
            $id = $row['VehicleID'];
        }
    } else {
        # Redirected from update repair
        $repairCost = $_GET['cost'];
        $repairID = $_GET['repair_id'];
        $updateRepairQry = $con->execute_query("UPDATE Repairs SET ActualCost=$repairCost WHERE RepairID=$repairID");
        if (!$updateRepairQry) {
            die("Could Not Update Database");
        } else {
            echo
            "<script>
                window.location.replace(\"../inventory/vehicle_info.php?id={$_GET['vehicle_id']}\");
            </script>";
        }
    }

}

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Repair <?php echo $_GET['id'] ?></title>
</head>

<body>
    <div class="toolbar">
        <ul>
            <li class="tool-bar-title"><a href="../index.php">Navigation</a></li>
            <li class="menu-item"><a href="../summary/summary.php">Summary</a></li>
            <li class="menu-item"><a href="../inventory/inventory.php">Vehicle Inventory</a></li>
            <li class="menu-item"><a href="../customers/customers.php">Customer Registry</a></li>
            <li class="menu-item"><a href="../warranty/warranties.php">Warranty Registry</a></li>
        </ul>
        <div class="user-logout">
            <p>User: John</p>
        </div>
    </div>
    <div class="main-title">
        <h1>Repair</h1>
    </div>
    <div class="contents">
        <p>Mark Complete? <br></p>
        <form>
            <p>Cost: </p>
            <label>
                <input type="text" name="cost">
            </label><br>
            <br>
            <input type="hidden" name="repair_id" value="<?php echo $_GET['id'] ?>">
            <input type="hidden" name="vehicle_id" value="<?php echo $id ?>">
            <input type="submit" value="Submit">
        </form>
    </div>
</body>