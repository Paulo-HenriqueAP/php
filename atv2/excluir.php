<?php
include "conexao.php";

header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["email"])) {
        http_response_code(400);
        echo json_encode(["error" => "E-mail do usuário não fornecido."], JSON_UNESCAPED_UNICODE);
        exit();
    }

    $email = $conn->real_escape_string($data["email"]);

    $sql = "DELETE FROM api_usuarios WHERE email = '$email'";

    if ($conn->query($sql)) {
        if ($conn->affected_rows > 0) {
            http_response_code(200);
            echo json_encode(["mensagem" => "Usuário excluído com sucesso."], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Usuário não encontrado."], JSON_UNESCAPED_UNICODE);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Erro ao excluir: " . $conn->error], JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido. Use DELETE."], JSON_UNESCAPED_UNICODE);
}

$conn->close();
