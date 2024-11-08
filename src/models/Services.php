<?php  
    require_once "../config/db.php";

    class Services {
        private $conn;

        public function __construct($db) {
            $this->conn = $db;
    }
    public function create($nameService, $price, $timeWait)
    {
        $sql = "INSERT INTO apiftw.services (nomeServico,preco,tempoDeEspera) VALUES (:name, :price, :timeWait)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nomeServico', $nameService);
        $stmt->bindParam(':preco', $price);
        $stmt->bindParam(':tempoDeEspera', $timeWait);

        return $stmt->execute();
    }
    public function list()
    {
        $sql = "SELECT id, nomeServico, preco, tempoDeEspera FROM apiftw.services";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update($id, $name, $preco, $timeWait)
    {
        $sql = "UPDATE apiftw.services SET nomeServico = :name, preco = :preco, timeWait = :timeWait WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $preco);
        $stmt->bindParam(':timeWait', $timeWait);

        $stmt->execute();
        return $stmt->rowCount();
    }
    public function getById($id)
    {
        $sql = "SELECT * FROM apiftw.services WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function delete($id)
    {
        $sql = "DELETE FROM apiftw.services WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

}