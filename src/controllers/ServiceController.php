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
                    echo json_encode(["message" => "Serviço agendado com sucesso "]);
                } catch (\Throwable $th) {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao agendar serviço."]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["message" => "Dados incompletos."]);
            }
        }
    
        
    public function getById($id)
    {
        if (isset($id)) {
            try {
                $user = $this->conn->getById($id);
                if ($user) {
                    echo json_encode($user);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Serviço não encontrado."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar o serviço."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function delete($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($id)) {
            try {
                $count = $this->conn->delete($id);

                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Pedido deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar o pedido."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar o pedido."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
    }
    