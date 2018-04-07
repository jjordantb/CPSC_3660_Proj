<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Customers</title>
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
    <h1>Customers</h1>
</div>
<div class="contents">
    <br>
    <table align="center">
        <tr class="table-heading">
            <th class="table-heading">ID</th>
            <th class="table-heading">First</th>
            <th class="table-heading">Last</th>
            <th class="table-heading">DOB</th>
            <th class="table-heading">TaxID</th>
            <th class="table-heading">Address</th>
            <th class="table-heading">Late Payments</th>
            <th class="table-heading">Zip</th>
            <th class="table-heading">State</th>
        </tr>
        <?php
        require_once ("../db_query.php");

        $con = new db_query();
        if (!$con->is_connected()) {
            die("Connection Failed: " . $con->connection->connect_error);
        }

        $qry = $con->execute_query("SELECT * FROM Customer;");

        while ($row = $qry->fetch_array()) {
            print "<tr>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[0] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[1] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[2] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[4] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[5] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[6] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[7] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[8] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[9] . "</a></th>";
            print "</tr>";
        }
        ?>
    </table>
    <br>
    <button onclick="location.href='add_customer.php'" type="button">Add Customer</button>
</div>
</body>