<?php
/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 28/03/18
 * Time: 1:59 PM
 */

require_once("db_query.php");

$servername = "cs3660.paratek.io";
$username = "remote";
$password = "Mongoose12!";
$dbname = "WESTWADB";

$con = new db_query();
if (!$con->is_connected()) {
    die("Connection Failed: " . $con->connection->connect_error);
}

$qry = $con->execute_query("SELECT * FROM BoughtVehicle;");

while ($row = $qry->fetch_array()) {
    print_r($row);
}
