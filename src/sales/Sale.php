<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Sale</title>
</head>

<body>
<div class="toolbar">
    <ul>
        <li class="tool-bar-title"><a href="../index.php">Navigation</a></li>
        <li class="menu-item"><a href="../summary/summary.php">Summary</a></li>
        <li class="menu-item"><a href="../inventory/inventory.php">Vehicle Inventory</a></li>
        <li class="menu-item"><a href="../customers/customers.php">Customer Registry</a></li>
        <li class="menu-item"><a href="../employee/employee.php">Employee</a></li>
        <li class="menu-item"><a href="../sales/Sale.php">Sale</a></li>
        <li class="menu-item"><a href="../warranty/warranties.php">Warranty Registry</a></li>
    </ul>
    <div class="user-logout">
        <p>User: John</p>
    </div>
</div>
<div class="main-title">
    <h1>Sale</h1>
</div>
<div class="contents">
    <br>
    <table align="center">
        <tr class="table-heading">
            <th class="table-heading">Sale ID</th>
            <th class="table-heading">Date</th>
            <th class="table-heading">Total Due</th>
            <th class="table-heading">Down Payment</th>
            <th class="table-heading">Finance Amount</th>
            <th class="table-heading">Customer ID</th>
            <th class="table-heading">Employee ID</th>
            <th class="table-heading">Vehicle ID</th>
        </tr>



        <?php
        /**
         * Created by PhpStorm.
         * User: Kevin Okada
         * Date: 4/7/2018
         * Time: 5:24 PM
         */

        require_once ("../db_query.php");

        $success = false;
        $con = new db_query();
        if (!$con->is_connected()) {
            die("Connection Failed: " . $con->connection->connect_error);
        }
        $qry = $con->execute_query("SELECT * FROM Sale;");

        while ($row = $qry->fetch_array()) {
            print "<tr>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[0] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[1] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[2] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[2] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[2] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[2] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[2] . "</a></th>";
            print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[2] . "</a></th>";
            print "</tr>";
        }
        ?>
    </table>
    <br>
    <button onclick="location.href='add_Sale.php'" type="button">Add Sale</button>
</div>
</body>