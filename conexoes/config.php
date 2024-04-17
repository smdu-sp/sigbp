<?php 

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'sisgp';

    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if($conexao->connect_errno) {
        die('Falha na conexão: (' . $conexao->connect_errno . ')' . $conexao->connect_error);
    } 
?>