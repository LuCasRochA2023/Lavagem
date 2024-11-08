<?php 
require_once "../config/db.php";

class User {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function create($name, $email, $senha)
{
    $sql = "INSERT INTO apiftw.users (name, email, senha) VALUES (:name, :email, :senha)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);

    if ($stmt->execute()) {
        return true;
    } else {
        $errorInfo = $stmt->errorInfo();
        echo json_encode(["message" => "Erro ao criar usuário", "error" => $errorInfo]);
        return false;
    }
}

    public function getById($id)
    {
        $sql = "SELECT * FROM apiftw.users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update($id, $name, $email, $senha)
    {
        $sql = "UPDATE apiftw.users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public function delete($id)
    {
        $sql = "DELETE FROM apiftw.users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public function list()
    {
        $sql = "SELECT id, name, email, senha FROM apiftw.users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}