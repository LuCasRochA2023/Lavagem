<?php 
    require_once "../models/Services.php";

    class ServiceController{
        private $conn;
        

        public function __construct($db) {
            $this->conn = new Services($db);
        }  public function list() {
            $services = $this->conn->list();
            echo json_encode($services); 
        }
        public function create()
        {
            $data = json_decode(file_get_contents("php://input"));
            if (isset($data->name) && isset($data->email)) {
                try {
                    $this->conn->create($data->name, $data->preco, $data->tempoDeEspera);
    
                    http_response_code(201);
                    echo json_encode(["message" => "Usuário criado com sucesso."]);
                } catch (\Throwable $th) {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao criar o usuário."]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["message" => "Dados incompletos."]);
            }
        }
    
    
    }
    