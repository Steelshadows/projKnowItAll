<?php
class db
{
    public $conn;
    public $host;
    public $user;
    public $passwords;
    public $baseName;
    public $debug;

    public function __construct($params = array())
    {
        $this->conn = false;
        $this->user = 'root';
        $this->host = 'localhost';
        $this->password = '';
        $this->baseName = 'veilig';
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    private function connect()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->baseName);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

    public function disconnect()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function singleQuery($query, $arr, $param)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($param, ... $arr);
        $stmt->execute();
        $stmt->close();
    }

    public function resultQuery($query, $arr, $param)
    {
        if (isset($arr) && isset($param)) {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param($param, ... $arr);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $stmt = $this->conn->query($query);
            $result = $stmt;
        }
        if ($result->num_rows == 0) {
            session_destroy();
        }
        $row = [];

        while ($rows = $result->fetch_assoc()) {
            array_push($row, $rows);
        }
        $stmt->close();
        return $row;
    }
}
