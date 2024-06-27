<?php
include_once('header.php');

if(!isset($_SESSION['logado'])) {
    header("location: index.php?m=faltaLogar");
    session_destroy();
    exit;
}

if(isset($_GET['sair'])) {
    header("location: index.php");
    session_destroy();
    exit;
}

?>