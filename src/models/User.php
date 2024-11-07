<?php 
require_once "../config/db.php";

class User {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function create($name, $email, $senha)
    {
        $sql = "INSERT INTO users (name,email,senha) VALUES (:name, :email, :senha)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        return $stmt->execute();
    }
    public function list()
    {
        $sql = "SELECT id, email, name FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}