<?php 
    require_once "../models/User.php";
    class UserController{
        private $user;

        public function __construct($db){
            $this->user = new User( $db );
    }
    public function list() {
        $services = $this->user->list();
        echo json_encode($services); 
    }

    public function create()
{
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->name) && isset($data->email) && isset($data->senha)) {
        try {
            var_dump($data);

            $result = $this->user->create($data->name, $data->email, $data->senha);
            if ($result) {
                echo json_encode(['message' => 'Usuário criado com sucesso.']);
            } else {
                echo json_encode(['message' => 'Erro ao criar usuário.']);
            }
            http_response_code(201);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Erro ao criar o usuário.", "error" => $e->getMessage()]);
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
                $user = $this->user->getById($id);
                if ($user) {
                    echo json_encode($user);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Usuário não encontrado."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar o usuário."]);
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
                $count = $this->user->delete($id);

                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Usuário deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar o usuário."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar o usuário."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

}




