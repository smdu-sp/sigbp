<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se ID é numérico
    if (!is_numeric($id)) {
        header('Location: listaremovimentar.php?notificacao=1&status=TODOS');
        exit();
    }

    $stmt = $conexao->prepare("SELECT * FROM item WHERE idbem = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $id = $user_data['idbem'];
        $patrimonio = $user_data['patrimonio'];
        $tipo = $user_data['tipo'];
        $marca = $user_data['marca'];
        $modelo = $user_data['modelo'];
        $numserie = $user_data['numserie'];
        $localizacao = $user_data['localizacao'];
        $servidor = $user_data['servidor'];
        $cimbpm = $user_data['cimbpm'];
    } else {
        header('Location: listaremovimentar.php?notificacao=1&status=TODOS');
        exit();
    }
    $stmt->close();
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $patrimonio = $_POST['numPatrimonio'];
    $tipo = $_POST['tipo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $numserie = $_POST['numSerie'];
    $localnovo = $_POST['localnovo'];
    $servidoranterior = $_POST['servidorAnterior'];
    $servidoratual = $_POST['servidoratual'];
    $localanterior = $_POST['localAnterior'];
    $cimbpm = $_POST['cimbpm'];
    $idusuario = $_POST['idusuario'];
    $usuario = $_POST['usuario'];
    $nome = $_POST['nome'];
    $status = $_POST['status'];

    // INSERT seguro em transferencia
    $stmt1 = $conexao->prepare("
        INSERT INTO transferencia (
            iditem, localanterior, localnovo, usuario, idusuario, 
            servidoranterior, servidoratual, cimbpm, nome
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt1->bind_param(
        "isssissss",
        $id,
        $localanterior,
        $localnovo,
        $usuario,
        $idusuario,
        $servidoranterior,
        $servidoratual,
        $cimbpm,
        $nome
    );

    if (!$stmt1->execute()) {
        die("Erro ao inserir transferência: " . $stmt1->error);
    }
    $stmt1->close();

    // UPDATE seguro em item
    $stmt2 = $conexao->prepare("
        UPDATE item 
        SET localizacao = ?, servidor = ?, cimbpm = ?, nome = ?, statusitem = ? 
        WHERE idbem = ?
    ");
    $stmt2->bind_param(
        "sssssi",
        $localnovo,
        $servidoratual,
        $cimbpm,
        $nome,
        $status,
        $id
    );

    if (!$stmt2->execute()) {
        die("Erro ao atualizar item: " . $stmt2->error);
    }
    $stmt2->close();

    // Redirecionamento final
    header('Location: listaremovimentar.php?notificacao=1&status=TODOS');
    exit();
}
?>
