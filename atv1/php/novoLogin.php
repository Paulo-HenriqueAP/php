<?php
include "../conexao.php";

$nome = $_POST["nome"];
$login = $_POST["login"];
$senha = $_POST["senha"];
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "SELECT id FROM usuarios WHERE login = $login";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Ja existe, tente outro código";
    header("Refresh:3");
} else {
    $sql = "INSERT INTO usuarios (nome, login, senha )

VALUES('$nome', '$login', '$senha_hash')
";
}

if ($conn->query($sql) === TRUE) {
    echo "Tudo certo! Cadastro realizado.";
    header("Location: ../index.html");
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();
?>