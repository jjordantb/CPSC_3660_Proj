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
    <h1>Employee</h1>
</div>
<div class="contents">
    <br>
    <table align="center">
        <tr class="table-heading">
            <th class="table-heading">First Name</th>
            <th class="table-heading">Last Name</th>
            <th class="table-heading">Phone Number</th>
            <th class="table-heading">Commission</th>
            <th class="table-heading">EmployeeID</th>
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
$qry = $con->execute_query("SELECT * FROM Employee;");

while ($row = $qry->fetch_array()) {
    print "<tr>";
    print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[0] . "</a></th>";
    print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[1] . "</a></th>";
    print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[2] . "</a></th>";
    print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[2] . "</a></th>";
    print "<th><a href=\"customer_info.php?id=" . $row[0] . "\">" . $row[2] . "</a></th>";
    print "</tr>";
}
?>
    </table>
    <br>
    <button onclick="location.href='add_employee.php'" type="button">Add Employee</button>
    <button onclick="location.href='add_commission.php'" type="button">Add Commission</button>
</div>
</body>
