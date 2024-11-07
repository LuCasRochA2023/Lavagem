<?php 
    require_once "../models/User.php";
    class UserController{
        private $user;

        public function __construct($db){
            $this->user = new User( $db );
    }
    public function list() {
        $services = $this->user->list();
        echo json_encode($services); // Retorna a lista de serviços em formato JSON
    }
    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name) && isset($data->email)) {
            try {
                $this->user->create($data->name, $data->email, $data->senha);

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




