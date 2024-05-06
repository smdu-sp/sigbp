<?php
include_once('header.php');

if(!isset($_SESSION['logado'])) {
    header("location: http://localhost/index.php?m=faltaLogar");
    session_destroy();
    exit;
}

if(isset($_GET['sair'])) {
    header("location: http://localhost/index.php");
    session_destroy();
    exit;
}

?>