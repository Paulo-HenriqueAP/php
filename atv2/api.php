<?php
include "conexao.php";

header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (
        isset($data["nome"]) &&
        isset($data["email"]) &&
        isset($data["senha"]) &&
        isset($data["telefone"]) &&
        isset($data["endereco"]) &&
        isset($data["nascimento"])
    ) {
        $nome = $conn->real_escape_string($data["nome"]);
        $email = $conn->real_escape_string($data["email"]);
        $senha = $data["senha"];
        $telefone = $conn->real_escape_string($data["telefone"]);
        $endereco = $conn->real_escape_string($data["endereco"]);
        $nascimento = $conn->real_escape_string($data["nascimento"]);

        $estado = $conn->real_escape_string(isset($data["estado"]) ? $data["estado"] : "MG");

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO api_usuarios (nome, email, senha, telefone, endereco, estado, data_nascimento) 
                VALUES ('$nome', '$email', '$senha_hash', '$telefone', '$endereco', '$estado', '$nascimento')";

        if ($conn->query($sql)) {
            $id = $conn->insert_id;
            $result = $conn->query("SELECT * FROM api_usuarios WHERE id = $id");
            $cliente = $result->fetch_assoc();
            http_response_code(201);
            echo json_encode(["mensagem" => "Tudo certo! Cliente cadastrado.", "cliente" => $cliente], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Erro ao cadastrar: " . $conn->error], JSON_UNESCAPED_UNICODE);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Todos os campos são obrigatórios!"], JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido. Use POST."], JSON_UNESCAPED_UNICODE);
}

$conn->close();
?>