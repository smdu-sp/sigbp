<?php
include_once('./conexoes/config.php');

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $nomefr = $_POST['nome'];
    $emailfr = $_POST['email'];
    $permissao = $_POST['permissao'];
    $unidade = $_POST['unidade'];
    $status = $_POST['status'];

    $sqlUpdate = "UPDATE usuarios SET usuario='$usuario', nome='$nomefr', email='$emailfr', permissao='$permissao', unidade='$unidade', statususer='$status' WHERE id='$id'";

    $result = $conexao->query($sqlUpdate);
    header('Location: usuarios.php?notificacao=alterado');

} else {
    header('Location: usuarios.php');
    exit(); 
}
?>
