<?php

class Database
{
    private $mysqli;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->mysqli = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DBNAME);

            if ($this->mysqli->connect_error) {
                throw new Exception('Connect Error: ' . $this->mysqli->connect_error);
            }

            if (!$this->mysqli->set_charset('utf8')) {
                throw new Exception('Error loading character set utf8: ' . $this->mysqli->error);
            }
        } catch (Exception $error) {
            die('Database connection failed: ' . $error->getMessage());
        }
    }

    public function getConnect()
    {
        return $this->mysqli;
    }
}



$database = new Database();
$mysqli = $database->getConnect();
