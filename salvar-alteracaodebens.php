<?php
include_once('./conexoes/config.php');

if (isset($_POST['update'])) {
    // Captura os dados do formulário
    $id = $_POST['id'];
    $patrimonio = $_POST['numPatrimonio'];
    $name = $_POST['nome'];
    $marca = $_POST['marca']; 
    $tipo = $_POST['tipo'];
    $descsbpm = $_POST['descricaoPBPM']; 
    $modelo = $_POST['modelo'];
    $numserie = $_POST['numSerie'];
    $localizacao = $_POST['localNovo'];
    $servidor = $_POST['nomeServidor'];
    $numprocesso = $_POST['numProcesso'];
    $cimbpm = $_POST['cimbpm'];
    $statusitem = $_POST['status'];

    // Prepara a query de atualização
    $stmt = $conexao->prepare("
        UPDATE item SET 
            patrimonio = ?, 
            tipo = ?, 
            descsbpm = ?, 
            numserie = ?, 
            marca = ?, 
            modelo = ?, 
            localizacao = ?, 
            servidor = ?, 
            numprocesso = ?, 
            cimbpm = ?, 
            nome = ?, 
            statusitem = ? 
        WHERE idbem = ?
    ");

    if ($stmt === false) {
        die('Erro ao preparar a query: ' . $conexao->error);
    }

    // Faz o bind dos parâmetros (tudo string, exceto idbem que deve ser int se for chave primária numérica)
    $stmt->bind_param(
        "ssssssssssssi", 
        $patrimonio, 
        $tipo, 
        $descsbpm, 
        $numserie, 
        $marca, 
        $modelo, 
        $localizacao, 
        $servidor, 
        $numprocesso, 
        $cimbpm, 
        $name, 
        $statusitem, 
        $id
    );

    // Executa a query
    if ($stmt->execute()) {
        header('Location: listaremovimentar.php?notificacao=2&status=Ativo');
        exit();
    } else {
        die('Erro ao executar o update: ' . $stmt->error);
    }

    $stmt->close();

} else {
    // Se acesso direto sem POST
    header('Location: listaremovimentar.php');
    exit();
}
?>
