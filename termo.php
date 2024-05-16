<?php
session_start();
<<<<<<< Updated upstream
include_once('conexoes/config.php');
include_once('header.php'); 
include_once('menu.php');
    


=======
include_once('componentes/verificacao.php');
include_once('header.php');
>>>>>>> Stashed changes

if (isset($_POST['submit'])) {

    $array1 = explode("\n", $_POST['textarea1']);
    $array2 = explode("\n", $_POST['textarea2']);


    $dataEntregue = $_POST['dataEntregue'];
    $unidadeEntregue = $_POST['unidadeEntregue'];
    $nomeEntrega = $_POST['nomeEntrega'];
    $rfEntrega = $_POST['rfEntrega'];
    $dataRecebimento = $_POST['dataRecebimento'];
    $unidadeRecebimento = $_POST['unidadeRecebimento'];
    $nomeRecebimento = $_POST['nomeRecebimento'];
    $rfRecebimento = $_POST['rfRecebimento'];


    $array1Encoded = implode(',', $array1);
    $array2Encoded = implode(',', $array2);


    header("Location: gerar-pdf.php");
    exit;
}
?>
<style>
        @media (max-width: 1600px) {
        .conteudo {
            margin-left: 75px;
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
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel-box mb-2">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./termo.php" class="text-primary ms-1 carrossel-text">Termo</a>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
        </div>
        <h3 class="mb-3 mt-2">Termo de Entrega/Retirada</h3>
        <hr class="mb-3">
        <form method="POST" id="conteudo" action="gerar-pdf.php">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="numPatriSerie" class="form-label text-muted">Nº Patrimonial/Nº de Série:</label>
                    <input type="text" class="form-control campos" id="numPatriSerie" name="numPatriSerie">
                </div>
                <div class="col-md-6 mb-2">
                    <label for="descBem" class="form-label text-muted ">Descrição do Bem:</label>
                    <input type="text" class="form-control campos" id="descBem" name="descBem">
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="exampleFormControlTextarea1" class="text-muted">Itens adicionados</label>
                        <textarea class="form-control" id="textareaNumSerie" name="textarea1" cols="3" rows="3" wrap="hard" readonly></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="exampleFormControlTextarea1" class="text-muted">Itens adicionados</label>
                        <textarea class="form-control" id="textareaDescBem" name="textarea2" cols="3" rows="3" wrap="hard" readonly></textarea>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mr-2"><button type="button" class="btn btn-success mb-3" id="btn-adc-item" name="salvar" onclick="adicionarItem()" disabled>Adicionar Item</button></div>
            <h6 class="mb-2">Entregue em:</h6>
            <hr class="mb-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dataEntregue" class="form-label text-muted">Data da Entrega:</label>
                    <input type="date" class="form-control" id="dataEntregue" name="dataEntregue" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="unidadeEntregue" class="form-label text-muted">Unidade:</label>
                    <select class="form-select" id="unidadeEntregue" name="unidadeEntregue" required>
                        <option value="" hidden="hidden">Selecionar</option>
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
            <div class="row mb-2">
                <div class="col-md-6 mb-3">
                    <label for="nomeEntrega" class="form-label text-muted">Nome responsável pela Entrega:</label>
                    <input type="text" class="form-control" id="nomeEntrega" name="nomeEntrega" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="rfEntrega" class="form-label text-muted">RF:</label>
                    <input type="text" class="form-control" id="rfEntrega" name="rfEntrega" required>
                </div>
            </div>
            <h6 class="mb-2">Recebido em:</h6>
            <hr class="mb-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dataRecebimento" class="form-label text-muted">Data da Recebimento:</label>
                    <input type="date" class="form-control" id="dataRecebimento" name="dataRecebimento" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="unidadeRecebimento" class="form-label text-muted">Unidade que Recebeu:</label>
                    <select class="form-select" id="unidadeRecebimento" name="unidadeRecebimento" required>
                        <option value="" hidden="hidden">Selecionar</option>
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
                    <label for="nomeRecebimento" class="form-label text-muted">Nome responsável pelo Recebimento:</label>
                    <input type="text" class="form-control" id="nomeRecebimento" name="nomeRecebimento" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="rfRecebimento" class="form-label text-muted">RF:</label>
                    <input type="text" class="form-control" id="rfRecebimento" name="rfRecebimento" required>
                </div>
            </div>
            <div class="btn-baixar d-flex justify-content-end mr-2"><button type="submit" class="btn btn-primary mb-4" name="submit" id='btGerarPDF' onclick="enviar_session()">Visualizar Termo</button></div>
        </form>
        <div class="hide" id="modal"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
