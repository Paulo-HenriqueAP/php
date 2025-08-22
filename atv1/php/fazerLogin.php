<?php
include "../conexao.php";

$login = $_POST["login"];
$senha = $_POST["senha"];
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "SELECT id FROM usuarios WHERE login = $login";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
       echo "Ja existe";
       header("Location: ../imc.html");
} else {
       header("Location: ../cadastro.html");
}
// echo("normal > ". $senha);

// echo("... cripto > " . $senha_hash);

if ($conn->query($sql) === TRUE) {
       echo "Tudo certo!" . $login;
} else {
       echo "Error :<" . $conn->error;
}

$conn->close();
?>