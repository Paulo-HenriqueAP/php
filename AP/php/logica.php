<?php
include "../conexao.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$nome = $_POST["nome"];
$peso = floatval($_POST["peso"]);
$altura = floatval($_POST["altura"]);
$classificacao = "";
$quemFez = "Admin";

$IMC = $peso / ($altura * $altura);
$IMC = round($IMC, 2);

if ($IMC <= 16) {
       $classificacao = "Baixo peso grau 3";
       echo ("IMC > " . $IMC . ". Baixo peso grau 3! Se alimente melhor");
} else if ($IMC > 16 && $IMC <= 16.99) {
       $classificacao = "Baixo peso grau 2";
       echo ("IMC > " . $IMC . ".baixo peso grau 2! Coma mais");
} else if ($IMC >= 17 && $IMC <= 18.49) {
       $classificacao = "Baixo peso grau 1";
       echo ("IMC > " . $IMC . ".baixo peso grau 1! Tá faltando se alimentar");
} else if ($IMC >= 18.50 && $IMC <= 24.99) {
       $classificacao = "Peso ideal";
       echo ("IMC > " . $IMC . ".Peso ideal! Parabéns!!");
} else if ($IMC >= 25 && $IMC <= 29.99) {
       $classificacao = "Sobrepeso";
       echo ("IMC > " . $IMC . ".Você está com Sobrepeso! Coma menos");
} else if ($IMC >= 30 && $IMC <= 34.99) {
       $classificacao = "Obesidade grau 1";
       echo ("IMC > " . $IMC . ".Obesidade grau 1! Dieta, dieta e dieta!");
} else if ($IMC >= 35 && $IMC <= 39.99) {
       $classificacao = "Obesidade grau 2";
       echo ("IMC > " . $IMC . ".obesidade grau 2, Vá para academia");
} else {
       $classificacao = "Obesidade grau 3";
       echo ("IMC > " . $IMC . ". Obesidade grau 3, fodeu!");
}

$sql = "INSERT INTO imc (nome, peso, altura, imc, classificacao, quemFez)
VALUES('$nome', $peso, $altura, $IMC, '$classificacao', '$quemFez')
";

if ($conn->query($sql) === TRUE) {
       echo "Tudo certo! Cadastro realizado.";
} else {
       echo "Erro ao salvar: " . $conn->error . "<br>";
    echo "Query: $sql<br>"; // Mostra a query para depuração
}
$conn->close();

//https://indicedemassacorporal.com/tabela-imc.html
