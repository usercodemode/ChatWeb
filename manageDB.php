<?php
class DBmanager
{
    private $host = '127.0.0.1';
    private $dbname = 'chatDB';
    private $user = 'root';
    private $pass = 'root123';

    private $conn;

    private $result = array();

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error: Could not connect to database.");
        }
    }

    // Method to fetch records
    public function select($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);
        if ($params) {
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
        }
        $stmt->execute();
        $this->result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return true;
    }

    // Method to insert a record
    public function insert($query, $params)
    {
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($params);
    }

    // Method to update a record
    public function update($query, $params)
    {
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($params);
    }

    // Method to delete a record
    public function delete($query, $params)
    {
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($params);
    }

    // Show Data
    public function showData()
    {
        return $this->result;
        //$this->result = array("");
    }

    /* CLOSE DB CONNECTION */
    function __destruct()
    {
        //$this->result = array("");
        $this->conn = null;
        if ($this->conn == null) {
            //echo "Connection closed.\n";
        }
    }
}

$db = new DBmanager();

?>
