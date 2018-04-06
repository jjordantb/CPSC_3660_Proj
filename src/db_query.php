<?php
/**
 * Created by PhpStorm.
 * User: jordan
 * Date: 28/03/18
 * Time: 2:09 PM
 */

class db_query {

    public $connection;

    /**
     * db_query constructor.
     */
    public function __construct() {
        $this->connection = new mysqli("cs3660.paratek.io", "remote", "Mongoose12!", "WESTWADB");
    }

    public function is_connected() {
        return !$this->connection->connect_error;
    }

    /**
     * Executes a non-update query on the database
     * @param $query
     * @return bool|mysqli_result
     */
    public function execute_query($query) {
        return $this->connection->query($query);
    }

    /**
     * Executes an update query on the database
     * @param $query
     * @return bool|mysqli_result
     */
    public function execute_update($query) {
        return $this->connection->query($query);
    }

    /**
     * Destructor to close the connection
     */
    public function __destruct() {
        $this->connection->close();
    }

    /**
     * @return mysqli
     */
    public function getConnection() {
        return $this->connection;
    }

}