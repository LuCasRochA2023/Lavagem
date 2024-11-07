<?php  
    require_once "../config/db.php";

    class Services {
        private $conn;

        public function __construct($db) {
            $this->conn = $db;
    }
    public function create($nameService, $price, $timeWait)
    {
        $sql = "INSERT INTO services (nomeServico,preco,tempoDeEspera) VALUES (:name, :price, :timeWait)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nomeServico', $nameService);
        $stmt->bindParam(':preco', $price);
        $stmt->bindParam(':tempoDeEspera', $timeWait);

        return $stmt->execute();
    }
    public function list()
    {
        $sql = "SELECT id, nomeServico, preco, tempoDeEspera FROM services";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}