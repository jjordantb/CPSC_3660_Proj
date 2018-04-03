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
     * @param $username
     * @param $password
     * @param $dbname
     * @param $servername
     */
    public function __construct($servername, $username, $password, $dbname) {
        print "Creating Connection";
        $this->connection = new mysqli($servername, $username, $password, $dbname);
        print "Created Connection? " . $this->connection->ping();
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