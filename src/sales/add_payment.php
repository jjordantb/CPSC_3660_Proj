<?php
require_once ("../db_query.php");

$id = "Not Found";

if (sizeof($_GET) > 0 && key_exists('date', $_GET)) {

    $con = new db_query();
    if (!$con->is_connected()) {
        die("Connection Failed: " . $con->connection->connect_error);
    }

    $curDate = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
    $actDate = DateTime::createFromFormat('Y-m-d', $_GET['date']);
    $dif = $curDate->diff($actDate)->format("%a");

    $updateRepairQry = $con->execute_query("INSERT INTO Payments VALUES ('{$_GET['date']}', {$_GET['amount']}, '{$curDate->format('Y-m-d')}', {$_GET['amount']}, {$_GET['customer_id']});");
    if (!$updateRepairQry) {
        die("Could Not Update Database");
    } else {
        if ($dif > 0) {
            $con->execute_query("UPDATE Customer SET LatePayments=LatePayments + 1 WHERE CustomerID={$_GET['customer_id']};");
        }
        echo
        "<script>
            window.location.replace(\"../customers/customer_info.php?id={$_GET['customer_id']}\");
        </script>";
    }

}

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Repair <?php echo $_GET['customer_id'] ?></title>
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
    <h1>Repair</h1>
</div>
<div class="contents">
    <br>
    <form>
        <p>Amount<br></p>
        <label>
            <input type="text" name="amount">
        </label>
        <p>Pay By Date (YYYY-MM-DD)<br></p>
        <label>
            <input type="text" name="date">
        </label>
        <br>
        <input type="hidden" name="customer_id" value="<?php echo $_GET['customer_id'] ?>">
        <input type="submit" value="Submit">
    </form>
</div>
</body>