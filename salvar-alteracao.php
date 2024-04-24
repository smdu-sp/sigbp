<?php
    include_once('./conexoes/config.php');


    if(isset($_POST['update'])) {
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

        $sqlUpdate = "UPDATE item SET patrimonio='$patrimonio', tipo='$tipo', descsbpm='$descsbpm', numserie='$numserie', marca='$marca', modelo='$modelo', localizacao='$localizacao', servidor='$servidor', numprocesso='$numprocesso', cimbpm='$cimbpm', nome='$name', statusitem='$statusitem' WHERE idbem='$id'";

        $result = $conexao->query($sqlUpdate);
    }
    
    header('Location: listaremovimentar.php');
?>