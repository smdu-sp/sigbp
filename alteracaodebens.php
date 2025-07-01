<?php
session_start();
include_once('header.php');
include_once('conexoes/config.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se é um número
    if (!is_numeric($id)) {
        header('Location: listaremovimentar.php?notificacao=2&status=TODOS');
        exit();
    }

    // Prepara a consulta
    $stmt = $conexao->prepare("SELECT * FROM item WHERE idbem = ?");
    if (!$stmt) {
        die('Erro na preparação da query: ' . $conexao->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();

        $id = $user_data['idbem'];
        $patrimonio = $user_data['patrimonio'];
        $name = $user_data['nome'];
        $marca = $user_data['marca'];
        $tipo = $user_data['tipo'];
        $descsbpm = $user_data['descsbpm'];
        $modelo = $user_data['modelo'];
        $numserie = $user_data['numserie'];
        $localizacao = $user_data['localizacao'];
        $servidor = $user_data['servidor'];
        $numprocesso = $user_data['numprocesso'];
        $cimbpm = $user_data['cimbpm'];
        $statusitem = $user_data['statusitem'];
    } else {
        header('Location: listaremovimentar.php?notificacao=2&status=TODOS');
        exit();
    }

    $stmt->close();
}
?>
