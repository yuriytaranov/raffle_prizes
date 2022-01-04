<?php

namespace app\db\drivers;
use PDO;
use WebApp;

class Mysql {
    /**
     * Stored connection.
     */
    protected $_connection = null;

    /**
     * Make a connection.
     */
    public function __construct() 
    {
        $host = conf('Database', 'host', 'localhost');
        $port = conf('Database', 'port', 3306);
        $user = conf('Database', 'user', 'root');
        $password = conf('Database', 'password', );
        $driver = strtolower(conf('Database', 'driver', 'mysql'));
        $database = conf('Database', 'name', 'hello');
        $dsn = "{$driver}:host={$host};dbname={$database}";
        $this->_connection = new PDO($dsn, $user, $password);
    }

    /**
     * Executes query and return all rows.
     * @param string $sql DB query.
     * @param array $fields fields to apply query.
     * 
     * @return PDOStatement Statement containing query result.
     */
    public function query($sql, $fields = [])
    {
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute($fields);
        return $stmt;
    }

    /**
     * Executes insert query and return its id.
     * @param string $sql DB query.
     * @param array $fields fields to applied query.
     * 
     * @return int last insert id.
     */
    public function insert($sql, $fields)
    {
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute($fields);
        return $this->_connection->lastInsertId();
    }

    /**
     * Use this to update rows.
     * @param string $sql DB query.
     * @param array $fields fields to applied query.
     */
    public function update($sql, $fields = [])
    {
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute($fields);
    }
}