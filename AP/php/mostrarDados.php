<?php 
include "../conexao.php";

$sql = "SELECT * FROM imc ORDER BY data_reg DESC";
$result = $conn->query($sql);

echo "<h2>Registros de IMC</h2>";

if ($result->num_rows > 0) {
    // Pega todas as linhas de uma vez só como array associativo
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    echo "<table border='1' cellpadding='5'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Peso</th>
                <th>Altura</th>
                <th>IMC</th>
                <th>Classificação</th>
                <th>Data</th>
                <th>Quem fez</th>
            </tr>";

    // usamos foreach para percorrer os dados
    foreach ($rows as $row) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['peso']}</td>
                <td>{$row['altura']}</td>
                <td>{$row['imc']}</td>
                <td>{$row['classificacao']}</td>
                <td>{$row['data_reg']}</td>
                <td>{$row['quemFez']}</td>
              </tr>";
    }

    echo "</table>";
    echo "<br><a href='../imc.html'>Calcular novo IMC</a>";
} else {
    echo "Nenhum registro encontrado.";
}

$conn->close();
?>