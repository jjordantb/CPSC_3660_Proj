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
        <li class="menu-item"><a href="../employee/employees.php">Employee</a></li>
        <li class="menu-item"><a href="../warranty/warranties.php">Warranty Registry</a></li>
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
            print "{$customerRow['FirstName']} {$customerRow['LastName']} ID: {$customerRow['CustomerID']}";
            print "<br>Gender: {$customerRow['Gender']}";
            print "<br>DOB: {$customerRow['DateOfBirth']}";
            print "<br>TaxID: {$customerRow['TaxId']}";
            print "<br>Address: {$customerRow['Address']}";
            print "<br>Zip: {$customerRow['Zip']}";
            print "<br>State: {$customerRow['State']}";
            //TODO: START HERE calculate the number of late payments, add a make payment form, and calculate average payment time
            print "<br>Number of Late Payments: ";
            print "<br>";
        }

    } else {
        print "<p>Customer $id</p>";
    }
    print "<br>";
    ?>
    <p>-- Owned Vehicles --</p>

    <table align="center">
        <tr class="table-heading">
            <th class="table-heading">SaleID</th>
            <th class="table-heading">Date</th>
            <th class="table-heading">Total</th>
            <th class="table-heading">EmployeeID</th>
            <th class="table-heading">VehicleID</th>
        </tr>
        <?php
        $repairQry = $con->execute_query(
                "SELECT * FROM Sale AS s, Customer AS c 
                        WHERE s.CustomerID=c.CustomerID
                        AND s.CustomerID=$id;"
        );
        while($repRow = $repairQry->fetch_array()) {
            $veh_id = $repRow['VehicleID'];
            $emp_id = $repRow['EmployeeID'];
            $sale_id = $repRow['SaleID'];
            print "<tr>";
            print "<th><a href=\"../sales/sale_info.php?id=$sale_id\">" . $repRow['SaleID'] . "</a></th>";
            print "<th><a>" . $repRow['Date'] . "</a></th>";
            print "<th><a>" . $repRow['TotalDue'] . "</a></th>";
            print "<th><a>" . $repRow['EmployeeID'] . "</a></th>";
            print "<th><a href=\"../inventory/vehicle_info.php?id=$veh_id\" >" . $repRow['VehicleID'] . "</a></th>";
            print "<tr>";
        }
        ?>
    </table>
    <br>
    <button onclick="location.href='../sales/add_sale.php?customer_id=<?php echo $_GET['id'] ?>'" type="button">Purchase Vehicle</button>
    <br>

    <p>-- Payment History --</p>

    <table align="center">
        <tr class="table-heading">
            <th class="table-heading">Required Date</th>
            <th class="table-heading">Actual Date</th>
            <th class="table-heading">Amount</th>
        </tr>
        <?php
        $repairQry = $con->execute_query(
            "SELECT * FROM Payments WHERE CustomerID IN (SELECT CustomerID FROM Sale WHERE Sale.CustomerID={$customerRow['CustomerID']});"
        );
        while($repRow = $repairQry->fetch_array()) {
            print "<tr>";
            print "<th><a>" . $repRow['PmtDate'] . "</a></th>";
            print "<th><a>" . $repRow['PaidDate'] . "</a></th>";
            print "<th><a>" . $repRow['Amount'] . "</a></th>";
            print "<tr>";
        }
        ?>
    </table>
    <br>
    <button onclick="location.href='../sales/add_sale.php?customer_id=<?php echo $_GET['id'] ?>'" type="button">Purchase Vehicle</button>
</div>
</body>