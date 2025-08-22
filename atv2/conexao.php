<?php
    $server = "localhost";
    $user = "root";
    $password = "#msql";
    $db = "api_aula2";

    $conn = new mysqli($server, $user, $password, $db);
    
    if($conn ->connect_error) {
        die("Erro de conexão ". $conn -> connect_error);
    };
?>