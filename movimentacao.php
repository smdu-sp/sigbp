<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');


if (!empty($_GET['id'])) {
    include_once('./conexoes/config.php');
    print_r($_POST);

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM item WHERE idbem=$id";

    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $id = $user_data['idbem'];
            $patrimonio = $user_data['patrimonio'];
            $tipo = $user_data['tipo'];
            $marca = $user_data['marca'];
            $modelo = $user_data['modelo'];
            $numserie = $user_data['numserie'];
            $localizacao = $user_data['localizacao'];
            $servidor = $user_data['servidor'];
            $cimbpm = $user_data['cimbpm'];
        }
    } else {
        header('Location: listaremovimentar.php?notificacao=1&status=TODOS');
    }
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

    $result = mysqli_query($conexao, "INSERT INTO transferencia(iditem, localanterior, localnovo, usuario, idusuario, servidoranterior, servidoratual, cimbpm, nome) 
    VALUES ('$id', '$localanterior', '$localnovo','$idusuario', '$usuario', '$servidoranterior', '$servidoratual', '$cimbpm', '$nome')");

    
    $sqlSelect = "SELECT * FROM item WHERE idbem=$id";

    $resultado = mysqli_query($conexao, "UPDATE item SET localizacao='$localnovo', servidor='$servidoratual', cimbpm ='$cimbpm', nome='$nome', statusitem='$status' WHERE idbem='$id'");
    
    header('Location: listaremovimentar.php?notificacao=1&status=TODOS');
}
?>
<style>
    @media (max-width: 1600px) {
        .conteudo {
            margin-left: 25px;
            width: 95%;
        }

        .conteudo_menu {
            width: 70px;
        }

        .menu-principal {
            position: fixed;
            top: 0;
            left: -187px;
            z-index: 999999 !important;
            transition: all .5s ease;
        }


        .menu-logout {
            z-index: 1000000 !important;
        }

        .aparecer {
            left: 70px !important;
        }


        .menu-button {
            display: block;
            cursor: pointer;
        }
    }
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-md-4 pt-3 conteudo">
        <div class="carrossel-box mb-2">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1">
                    <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
                </a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-avancar" alt="icon-avancar">
                <a href="./listaremovimentar.php?status=ATIVO" class="text-muted ms-1 carrossel-text">Listar/Movimentar Bens</a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-avancar ms-1" alt="icon-avancar">
                <a href="#" class="text-primary ms-1 carrossel-text">Movimentação</a>
            </div>
        </div>
        <div class="mb-1 mt-1">
            <h2 class="mb-4">Movimentação do Item</h2>
        </div>
        <h5 class="mb-3">Dados do Item</h5>
        <hr class="mb-3">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id" class="form-label text-muted">ID:</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo strtoupper($id) ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="numPatrimonio" class="form-label text-muted">Número do Patrimônio PMSP:</label>
                        <input type="text" class="form-control" id="numPatrimonio" name="numPatrimonio" value="<?php echo strtoupper($patrimonio) ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tipo" class="form-label text-muted">Tipo:</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo strtoupper($tipo) ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="modelo" class="form-label text-muted">Modelo:</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo strtoupper($modelo) ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="numSerie" class="form-label text-muted">Número de Série:</label>
                        <input type="text" class="form-control" id="numSerie" name="numSerie" value="<?php echo strtoupper($numserie) ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="marca" class="form-label text-muted">Marca:</label>
                        <input type="text" class="form-control" id="marca" name="marca" value="<?php echo strtoupper($marca) ?>" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="servidorAtual" class="form-label text-muted">Servidor Atual:</label>
                        <input type="text" class="form-control" id="servidorAtual" name="servidorAnterior" value="<?php echo $servidor ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="localAtual" class="form-label text-muted">Localização Atual:</label>
                        <input type="text" class="form-control" id="localanterior" name="localAnterior" value="<?php echo strtoupper($localizacao) ?>" readonly>
                    </div>
                </div>
                <h5 class="mb-3">Dados da Transferência</h5>
                    <hr class="mb-3">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nomeServidor" class="form-label text-muted">Nome do Servidor:</label>
                            <input type="text" class="form-control" id="nomeServidor" name="servidoratual" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="localNova" class="form-label text-muted">Localização Nova:</label>
                            <select class="form-select" id="localnovo" required name="localnovo" required>
                                <option value="Selecionar" hidden="hidden">Selecionar</option>
                               <?php include 'query-unidades.php'?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cimbpm" class="form-label text-muted">CIMBPM:</label>
                            <input type="text" class="form-control" id="cimbpm" name="cimbpm">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nome" class="form-label text-muted">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="responsavelTransferencia" class="form-label text-muted">Responsável pela Transferência:</label>
                            <input type="text" class="form-control" id="responsavelTransferencia" name="idusuario" value="<?php echo $_SESSION['SesNome'] ?>" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                        <p class="mb-2 text-muted">Status:</p>
                        <select id="statusSelect" onchange="filtrar()" class="form-select" aria-label="Default select example" name="status">
                            <option value="<?php echo empty($_GET['status']) ? 'Ativo' : strtoupper($_GET['status']); ?>" hidden><?php echo empty($_GET['status']) ? 'Ativo' : strtoupper($_GET['status']); ?></option>
                            <option value="ATIVO">ATIVO</option>
                            <option value="BAIXADO">BAIXADO</option>
                            <option value="PARA DOAÇÃO">PARA DOAÇÃO</option>
                            <option value="PARA DESCARTE">PARA DESCARTE</option>
                            <option value="DOADO">DOADO</option>
                            <option value="DESCARTADO">DESCARTADO</option>
                            <option value="ESTOQUE">ESTOQUE</option>
                            <option value="TODOS">TODOS</option>
                        </select>
                    </div>
                        <div class="col-md-6 mb-3">
                            <label for="login" class="form-label text-muted">Login:</label>
                            <input type="text" class="form-control" id="login" name="usuario" value="<?php echo $_SESSION['SesID'] ?>" readonly>
                        </div>
                    </div>
                    <div class="box-btn-voltar d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" name="submit">Movimentar</button>
                    </div>
            </form>
            <div class="hide" id="modal"></div>
    </div>
</body>

</html>