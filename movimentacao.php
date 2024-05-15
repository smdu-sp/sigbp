<?php
session_start();
include_once('header.php');
include_once('./conexoes/config.php');
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
        header('Location: listaremovimentar.php');
    }
}
echo "<script>console.log('Erro')</script>";

if (isset($_POST['submit'])) {
    echo "<script>console.log('Erro')</script>";
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

    $result = mysqli_query($conexao, "INSERT INTO transferencia(iditem, localanterior, localnovo, usuario, idusuario, servidoranterior, servidoratual, cimbpm) 
    VALUES ('$id', '$localanterior', '$localnovo','$idusuario', '$usuario', '$servidoranterior', '$servidoratual', '$cimbpm')");

    header('Location: listaremovimentar.php?notificacao=1');
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
                <a href="./listaremovimentar.php" class="text-muted ms-1 carrossel-text">Listar/Movimentar Bens</a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-avancar ms-1" alt="icon-avancar">
                <a href="./movimentacao.php" class="text-primary ms-1 carrossel-text">Movimentação</a>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
        </div>
        <div class="mb-1 mt-1">
            <h4 class="mb-3">Movimentação</h4>
        </div>
        <hr class="mb-4">
        <h5 class="mb-3">Dados do Item</h4>
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id" class="form-label text-muted">ID:</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo $id ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="numPatrimonio" class="form-label text-muted">Número do Patrimônio PMSP:</label>
                        <input type="text" class="form-control" id="numPatrimonio" name="numPatrimonio" value="<?php echo $patrimonio ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tipo" class="form-label text-muted">Tipo:</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $tipo ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="modelo" class="form-label text-muted">Modelo:</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo $modelo ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="numSerie" class="form-label text-muted">Número de Série:</label>
                        <input type="text" class="form-control" id="numSerie" name="numSerie" value="<?php echo $numserie ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="marca" class="form-label text-muted">Marca:</label>
                        <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $marca ?>" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="servidorAtual" class="form-label text-muted">Servidor Atual:</label>
                        <input type="text" class="form-control" id="servidorAtual" name="servidorAnterior" value="<?php echo $servidor ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="localAtual" class="form-label text-muted">Localização Atual:</label>
                        <input type="text" class="form-control" id="localanterior" name="localAnterior" value="<?php echo $localizacao ?>" readonly>
                    </div>
                </div>
                <h5 class="mb-3">Dados da Transferência</h4>
                    <hr class="mb-4 w">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nomeServidor" class="form-label text-muted">Nome do Servidor:</label>
                            <input type="text" class="form-control" id="nomeServidor" name="servidoratual" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="localNova" class="form-label text-muted">Localização Nova:</label>
                            <select class="form-select" id="localnovo" required name="localnovo" required>
                                <option value="Selecionar" hidden="hidden">Selecionar</option>
                                <option value="ASCOM">ASCOM</option>
                                <option value="ATAJ">ATAJ</option>
                                <option value="ATECC">ATECC</option>
                                <option value="ATIC">ATIC</option>
                                <option value="AUDITÓRIO">AUDITÓRIO</option>
                                <option value="CAF">CAF</option>
                                <option value="CAF/DGP">CAF/DGP</option>
                                <option value="CAF/DLC">CAF/DLC</option>
                                <option value="CAF/DOF">CAF/DOF</option>
                                <option value="CAF/DSUP">CAF/DSUP</option>
                                <option value="CAP">CAP</option>
                                <option value="CAP/ARTHUR SABOYA">CAP/ARTHUR SABOYA</option>
                                <option value="CAP/DEPROT">CAP/DEPROT</option>
                                <option value="CAP/DPCI">CAP/DPCI</option>
                                <option value="CAP/DPD">CAP/DPD</option>
                                <option value="CAP/NÚCLEO DE ATENDIMENTO">CAP/NÚCLEO DE ATENDIMENTO</option>
                                <option value="CASE">CASE</option>
                                <option value="CASE/DCAD">CASE/DCAD</option>
                                <option value="CASE/DDU">CASE/DDU</option>
                                <option value="CASE/DLE">CASE/DLE</option>
                                <option value="CASE/STEL">CASE/STEL</option>
                                <option value="CEPEUC">CEPEUC</option>
                                <option value="CGPATRI">CGPATRI</option>
                                <option value="COMIN">COMIN</option>
                                <option value="COMIN/DCIGP">COMIN/DCIGP</option>
                                <option value="COMIN/DCIMP">COMIN/DCIMP</option>
                                <option value="CONTRU">CONTRU</option>
                                <option value="CONTRU/DACESS">CONTRU/DACESS</option>
                                <option value="CONTRU/DINS">CONTRU/DINS</option>
                                <option value="CONTRU/DLR">CONTRU/DLR</option>
                                <option value="CONTRU/DSUS">CONTRU/DSUS</option>
                                <option value="DEUSO">DEUSO</option>
                                <option value="GABINETE">GABINETE</option>
                                <option value="GEOINFO">GEOINFO</option>
                                <option value="GTEC">GTEC</option>
                                <option value="ILUME">ILUME</option>
                                <option value="PARHIS">PARHIS</option>
                                <option value="PARHIS/DHIS">PHARIS/DHIS</option>
                                <option value="PARHIS/DHMP">PHARIS/DHMP</option>
                                <option value="PARHIS/DPS">PHARIS/DPS</option>
                                <option value="PLANURB">PLANURB</option>
                                <option value="RESID">RESID</option>
                                <option value="RESID/DRGP">RESID/DRGP</option>
                                <option value="RESID/DRPM">RESID/DRPM</option>
                                <option value="RESID/DRU">RESID/DRU</option>
                                <option value="SERVIN">SERVIN</option>
                                <option value="SERVIN/DSIGP">SERVIN/DSIGP</option>
                                <option value="SERVIN/DSIMP">SERVIN/DSIMP</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cimbpm" class="form-label text-muted">CIMBPM:</label>
                            <input type="text" class="form-control" id="cimbpm" name="cimbpm" value="<?php echo $cimbpm ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="responsavelTransferencia" class="form-label text-muted">Responsável pela Transferência:</label>
                            <input type="text" class="form-control" id="responsavelTransferencia" name="idusuario" value="<?php echo $_SESSION['SesNome'] ?>" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="login" class="form-label text-muted">Login:</label>
                            <input type="text" class="form-control" id="login" name="usuario" value="<?php echo $_SESSION['SesID'] ?>" readonly>
                        </div>
                    </div>
                    <div class="box-btn-voltar">
                        <button type="submit" class="btn btn-primary" name="submit">Movimentar</button>
                    </div>
            </form>
            <div class="hide" id="modal"></div>
    </div>
</body>

</html>