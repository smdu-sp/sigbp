<?php
include_once('./conexoes/config.php');

if (isset($_POST['update'])) {
    // Captura e sanitiza os dados
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $nomefr = $_POST['nome'];
    $emailfr = $_POST['email'];
    $permissao = $_POST['permissao'];
    $unidade = $_POST['unidade'];
    $status = $_POST['status'];

    // Prepara a query com parâmetros
    $stmt = $conexao->prepare("
        UPDATE usuarios 
        SET usuario = ?, nome = ?, email = ?, permissao = ?, unidade = ?, statususer = ? 
        WHERE id = ?
    ");

    if ($stmt === false) {
        die('Erro na preparação da query: ' . $conexao->error);
    }

    // Faz o bind dos parâmetros: s = string, i = inteiro
    $stmt->bind_param("ssssssi", $usuario, $nomefr, $emailfr, $permissao, $unidade, $status, $id);

    // Executa e verifica
    if ($stmt->execute()) {
        header('Location: usuarios.php?notificacao=alterado&status=ATIVO&permissao=4');
        exit();
    } else {
        die('Erro na execução: ' . $stmt->error);
    }

    $stmt->close();

} else {
    header('Location: usuarios.php');
    exit();
}
?>
