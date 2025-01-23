<?php namespace Project\Src\Database;

use mysqli;

class Database 
{
    private $connection;
    
    function __construct(string $host, string $user, string $password, int $port = 3306)
    {
        $this->connection = new mysqli($host, $user, $password, $port);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    private function query($sql, $params = []) 
    {
        $stmt = $this->connection->prepare($sql);

        if ($stmt === false)
        {
            die("Error preparing statement: " . $this->connection->error);
        }

        if (!empty($params))
        {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt;
    }

    public function read($table, $conditions = [], $colums = '*')
    {
        $sql = "SELECT $colums FROM $table";

        if (!empty($conditions))
        {
            $placeholders = implode(' AND ', array_map(fn($key) => "$key = ?", array_keys($conditions)));
            $sql .= " WHERE $placeholders";
        }

        $stmt = $this->query($sql, array_values($conditions));
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}