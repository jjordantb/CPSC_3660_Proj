<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../main.css">
    <title>WSA - Warranties</title>
</head>

<body>
<div class="toolbar">
    <ul>
        <li class="tool-bar-title"><a href="../index.php">Navigation</a></li>
        <li class="menu-item"><a href="../summary/summary.php">Summary</a></li>
        <li class="menu-item"><a href="../inventory/inventory.php">Vehicle Inventory</a></li>
        <li class="menu-item"><a href="../customers/customers.php">Customer Registry</a></li>
        <li class="menu-item"><a href="warranties.php">Warranty Registry</a></li>
    </ul>
    <div class="user-logout">
        <p>User: John</p>
    </div>
</div>
<div class="main-title">
    <h1>Warranties</h1>
</div>
<div class="contents">
    <br>
    <table align="center">
        <tr class="table-heading">
            <th class="table-heading">WarrantyID</th>
            <th class="table-heading">Coverage</th>
            <th class="table-heading">Cost</th>
            <th class="table-heading">Start Date</th>
            <th class="table-heading">Length</th>
            <th class="table-heading">Deductible</th>
        </tr>
        <?php
        require_once ("../db_query.php");

        $con = new db_query();
        if (!$con->is_connected()) {
            die("Connection Failed: " . $con->connection->connect_error);
        }

        $qry = $con->execute_query("SELECT * FROM Warranties;");

        while ($row = $qry->fetch_array()) {
            $date = date('Y', strtotime($row[3]));
            print "<tr>";
            print "<th><a href=\"../warranty/warranty_info.php?id=" . $row['WarrantyID'] . "\">" . $row['WarrantyID'] . "</a></th>";
            print "<th><a href=\"../warranty/warranty_info.php?id=" . $row['WarrantyID'] . "\">" . $row['ItemsCovered'] . "</a></th>";
            print "<th><a href=\"../warranty/warranty_info.php?id=" . $row['WarrantyID'] . "\">" . $row['Cost'] . "</a></th>";
            print "<th><a href=\"../warranty/warranty_info.php?id=" . $row['WarrantyID'] . "\">" . $row['StartDate'] . "</a></th>";
            print "<th><a href=\"../warranty/warranty_info.php?id=" . $row['WarrantyID'] . "\">" . $row['Length'] . "</a></th>";
            print "<th><a href=\"../warranty/warranty_info.php?id=" . $row['WarrantyID'] . "\">" . $row['Deductible'] . "</a></th>";
            print "</tr>";
        }
        ?>
    </table>
</div>
</body>