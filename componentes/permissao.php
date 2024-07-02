<?php

$buscar_permisao = "SELECT permissao FROM usuarios WHERE `usuario`='" . strtolower($_SESSION['SesID']) . "';";
$query_usuario = mysqli_query($conexao, $buscar_permisao);
$row = mysqli_fetch_assoc($query_usuario);
$permissao = $row['permissao'];
if ($permissao != 1) {
    header('Location: termo.php');
}


?>