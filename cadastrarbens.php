<?php
session_start();
include_once('./conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

if (isset($_GET['num'])) {
    $registros = $_GET['num'];
} else {
    $registros = 1;
}

if (isset($_POST['submit'])) {
    for ($i = 1; $i <= $registros; $i++) {
        $patrimonio = $_POST['numPatrimonio'];
        $tipo = $_POST['tipo'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $numserie = $_POST['numSerie'];
        $localizacao = $_POST['localNovo'];
        $servidor = $_POST['nomeServidor'];
        $numprocesso = $_POST['numprocesso'];
        $nome = $_POST['nomeComputador'];
        $statusitem = $_POST['status'];

        $result = mysqli_query($conexao, "INSERT INTO item(patrimonio, tipo, numserie, marca, modelo, localizacao, servidor, numprocesso, nome, statusitem) 
        VALUES ('$patrimonio', '$tipo', '$numserie', '$marca', '$modelo', '$localizacao', '$servidor', '$numprocesso', '$nome', '$statusitem')");

        header('Location: cadastrarbens.php?notificacao=true');
    }
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

    .swal2-title {
        color: #fff;
    }


    #registros {
        display: none;
    }

    #registros.show {
        display: block;
    }
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel-box mb-2">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1">
                    <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
                </a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./cadastrarbens.php" class="text-primary ms-1 carrossel-text">Cadastro de bens</a>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
        </div>
        <h2 class="mb-3 mt-4">Cadastro de bens</h2>
        <form  method="POST" class="mt-5">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numPatrimonio" class="form-label text-muted">Número do Patrimônio PMSP:</label>
                    <input type="text" class="form-control" id="numPatrimonio" name="numPatrimonio">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tipo" class="form-label text-muted">Tipo:</label>
                    <select class="form-select" name="tipo" id="tipo" >
                        <option value="" hidden="hidden">Selecionar</option>
                        <option value="AMPLIFICADOR">AMPLIFICADOR</option>
                        <option value="ANTENA PARABÓLICA">ANTENA PARABÓLICA</option>
                        <option value="ANTENA WIRELESS">ANTENA WIRELESS</option>
                        <option value="AP TELEFONICO DIGITAL">AP TELEFONICO DIGITAL</option>
                        <option value="APARELHO FAX">APARELHO FAX</option>
                        <option value="AR CONDICIONADO">AR CONDICIONADO</option>
                        <option value="ARMARIO">ARMARIO</option>
                        <option value="ARQUIVO DESLIZANTE">ARQUIVO DESLIZANTE</option>
                        <option value="BALCAO">BALCAO</option>
                        <option value="BATERIA">BATERIA</option>
                        <option value="CADEIRA">CADEIRA</option>
                        <option value="CAIXA ACÚSTICA">CAIXA ACÚSTICA</option>
                        <option value="CAIXAS DE SOM">CAIXAS DE SOM</option>
                        <option value="CALCULADORA">CALCULADORA</option>
                        <option value="CARRINHO PARA SUPERMERCADO">CARRINHO PARA SUPERMERCADO</option>
                        <option value="COMPRESSOR DE ÁUDIO COM DOIS CANAIS">COMPRESSOR DE ÁUDIO COM DOIS CANAIS</option>
                        <option value="COMPUTADOR">COMPUTADOR</option>
                        <option value="CONTROLADOR">CONTROLADOR</option>
                        <option value="CPU">CPU</option>
                        <option value="DESKTOP SWITCH">DESKTOP SWITCH</option>
                        <option value="ENCADERNADORA">ENCADERNADORA</option>
                        <option value="ESCADA DE ALUMÍNIO">ESCADA DE ALUMÍNIO</option>
                        <option value="ESMERILHADEIRA">ESMERILHADEIRA</option>
                        <option value="ESTABILIZADOR">ESTABILIZADOR</option>
                        <option value="ESTAÇÃO DE TRABALHO">ESTAÇÃO DE TRABALHO</option>
                        <option value="ESTANTE">ESTANTE</option>
                        <option value="FRAGMENTADORA DE PAPEL">FRAGMENTADORA DE PAPEL</option>
                        <option value="FREEZER">FREEZER</option>
                        <option value="FURADEIRA">FURADEIRA</option>
                        <option value="GAVETEIRO">GAVETEIRO</option>
                        <option value="GPS">GPS</option>
                        <option value="GUILHOTINA DE ESCRITÓRIO">GUILHOTINA DE ESCRITÓRIO</option>
                        <option value="HARD DISCK">HARD DISK</option>
                        <option value="HD EXTERNO">HD EXTERNO</option>
                        <option value="HORODATADOR PROTOCOLADOR">HORODATADOR PROTOCOLADOR</option>
                        <option value="IMPRESSORA">IMPRESSORA</option>
                        <option value="LIXADEIRA DE CINTA">LIXADEIRA DE CINTA</option>
                        <option value="LONGARINA">LONGARINA</option>
                        <option value="MAPA">MAPA</option>
                        <option value="MAQUINA FOTOGRAFICA/ CÂMERA DIGITAL">MAQUINA FOTOGRAFICA/ CÂMERA DIGITAL</option>
                        <option value="MARTELETE ROMPEDOR">MARTELETE ROMPEDOR</option>
                        <option value="MEDITOR DE DISTÂNCIA">MEDIDOR DE DISTÂNCIA</option>
                        <option value="MEDUSA">MEDUSA</option>
                        <option value="MESA">MESA</option>
                        <option value="MESA DE SOM">MESA DE SOM</option>
                        <option value="MICROCOMPUTADOR">MICROCOMPUTADOR</option>
                        <option value="MICROFONES">MICROFONES</option>
                        <option value="MICRO-ONDAS">MICRO-ONDAS</option>
                        <option value="MINIGRAVADOR DIGITAL">MINIGRAVADOR DIGITAL</option>
                        <option value="MONITOR">MONITOR</option>
                        <option value="MORSA">MORSA</option>
                        <option value="NOBREAK">NOBREAK</option>
                        <option value="NOTEBOOK">NOTEBOOK</option>
                        <option value="PAINEL ELETRÔNICO">PAINEL ELETRÔNICO</option>
                        <option value="PEDESTAL">PEDESTAL</option>
                        <option value="PERSIANA">PERSIANA</option>
                        <option value="PLOTTER">PLOTTER</option>
                        <option value="POLTRONA">POLTRONA</option>
                        <option value="PROJETOR MULTIMÍDIA(DATA SHOW)">PROJETOR MULTIMÍDIA(DATA SHOW)</option>
                        <option value="QUADRO DE AVISO">QUADRO DE AVISO</option>
                        <option value="RACK">RACK</option>
                        <option value="RELÓGIO">RELÓGIO</option>
                        <option value="ROTEADOR">ROTEADOR</option>
                        <option value="SCANNER">SCANNER</option>
                        <option value="SERVIDOR">SERVIDOR</option>
                        <option value="SOFA">SOFA</option>
                        <option value="SWITCH">SWITCH</option>
                        <option value="TABLET MARCA SAMSUNG MODELO TAB S8 5G">TABLET MARCA SAMSUNG MODELO TAB S8 5G</option>
                        <option value="TELA DE PROJEÇÃO RETRÁTIL">TELA DE PROJEÇÃO RETRÁTIL</option>
                        <option value="TELEVISOR">TELEVISOR</option>
                        <option value="TRENA">TRENA</option>
                        <option value="TV">TV</option>
                        <option value="UNID. DE PROCESSAMENTO">UNID. DE PROCESSAMENTO</option>
                        <option value="VENTILADOR">VENTILADOR</option>
                        <option value="WEBCAM FULL HD 1080P">WEBCAM FULL HD 1080P</option>
                        <option value="WORKSTATION">WORKSTATION</option>
                        <option value="OUTROS">OUTROS</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="marca" class="form-label text-muted">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="modelo" class="form-label text-muted">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numSerie" class="form-label text-muted">Número de Série:</label>
                    <input type="text" class="form-control" id="numSerie" name="numSerie" >
                </div>
                <div class="col-md-6 mb-3">
                    <label for="localNovo" class="form-label text-muted">Localização:</label>
                    <select class="form-select" id="localNovo" name="localNovo" >
                        <option value="" hidden="hidden">Selecionar</option>
                        <option value="ASCOM">ASCOM</option>
                        <option value="ATAJ">ATAJ</option>
                        <option value="ATECC">ATECC</option>
                        <option value="ATIC">ATIC</option>
                        <option value="AUDITÓRIO">AUDITÓRIO</option>
                        <option value="CAEPP">CAEPP</option>
                        <option value="CAEPP/DERP">CAEPP/DERPP</option>
                        <option value="CAEPP/DESPP">CAEPP/DESPP</option>
                        <option value="CAF">CAF</option>
                        <option value="CAF/DGP">CAF/DGP</option>
                        <option value="CAF/DLC">CAF/DLC</option>
                        <option value="CAF/DOF">CAF/DOF</option>
                        <option value="CAF/DRV">CAF/DRV</option>
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
                        <option value="CEPEUC">CEPEUC/DCIT</option>
                        <option value="CEPEUC">CEPEUC/DDOC</option>
                        <option value="CEPEUC">CEPEUC/DVF</option>
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
                        <option value="DEUSO">DEUSO/DMUS</option>
                        <option value="DEUSO">DEUSO/DNUS</option>
                        <option value="DEUSO">DEUSO/DSIZ</option>
                        <option value="GABINETE">GABINETE</option>
                        <option value="GEOINFO">GEOINFO</option>
                        <option value="GTEC">GTEC</option>
                        <option value="ILUME">ILUME</option>
                        <option value="PARHIS">PARHIS</option>
                        <option value="PARHIS/DHIS">PHARIS/DHIS</option>
                        <option value="PARHIS/DHMP">PHARIS/DHMP</option>
                        <option value="PARHIS/DHMP">PHARIS/DHPP</option>
                        <option value="PARHIS/DPS">PHARIS/DPS</option>
                        <option value="PLANURB">PLANURB</option>
                        <option value="PLANURB">PLANURB/DART</option>
                        <option value="RESID">RESID</option>
                        <option value="RESID/DRGP">RESID/DRGP</option>
                        <option value="RESID/DRGP">RESID/DRH</option>
                        <option value="RESID/DRPM">RESID/DRPM</option>
                        <option value="RESID/DRPM">RESID/DRVE</option>
                        <option value="RESID/DRU">RESID/DRU</option>
                        <option value="SECRETARIO">SECRETARIO</option>
                        <option value="SEL/AJ">SEL/AJ</option>
                        <option value="SERVIN">SERVIN</option>
                        <option value="SERVIN/DSIGP">SERVIN/DSIGP</option>
                        <option value="SERVIN/DSIMP">SERVIN/DSIMP</option>
                        <option value="STEL">STEL</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nomeServidor" class="form-label text-muted">Nome do Servidor:</label>
                    <input type="text" class="form-control" id="nomeServidor" name="nomeServidor">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="numProcesso" class="form-label text-muted">Número do Processo:</label>
                    <input type="text" class="form-control" id="numprocesso" name="numprocesso">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nomeComputador" class="form-label text-muted">Nome do computador:</label>
                    <input type="text" class="form-control" id="nomeComputador" name="nomeComputador">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="status" class="form-label text-muted">Status:</label>
                    <select class="form-select" id="status" name="status" >
                        <option value="" hidden="hidden">Selecionar</option>
                        <option value="Ativo">Ativo</option>
                        <option value="Baixado">Baixado</option>
                        <option value="Para Doação">Para Doação</option>
                        <option value="Ativo">Para Descarte</option>
                        <option value="Ativo">Doado</option>
                        <option value="Descartado">Descartado</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="status" class="form-label text-muted">Num de Registro de Itens:</label>
                    <input class="form-control mb-2" type="text" id="textBusca" name="inputText" onfocus="showOptions()" onblur="hideOptions()" style="width: 200px;">
                    <div id="registros">
                        <ul class="list-group list-group-flush overflow-auto" id="ulItens" style="height: 200px;width: 200px;">
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('1')">1</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('2')">2</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('3')">3</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('4')">4</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('5')">5</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('6')">6</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('7')">7</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('8')">8</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('9')">9</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('10')">10</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('15')">15</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('20')">20</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('25')">25</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('30')">30</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('35')">35</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('40')">40</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('45')">45</a></li>
                            <li><a href="#" class="list-group-item list-group-item-action" onclick="botaoClicado('50')">50</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 mb-4 mt-4 d-flex justify-content-end align-items-start">
                    <input type="submit" class="btn btn-primary" id="btnCadBens" name="submit" value="Cadastrar"></input>
                </div>
            </div>
        </form>
        <div class="hide" id="modal"></div>
    </div>

</body>
<script>
    function showOptions() {
        document.getElementById("registros").classList.add("show");
    }

    function hideOptions() {
        setTimeout(function() {
            document.getElementById("registros").classList.remove("show");
        }, 100);
    }

    function botaoClicado(item) {
        var localNovo = document.getElementById('localNovo');
        var status = document.getElementById('status');
        var numSerie = document.getElementById('numSerie');
        var tipo = document.getElementById('tipo');

        if(item == 1) {
            localNovo.required = true;
            status.required = true;
            numSerie.required = true;
            tipo.required = true;
        }

        document.getElementById('textBusca').value = item;
        hideOptions();
        let newUrl = 'cadastrarbens.php?num=' + item;
        window.history.pushState({
            path: newUrl
        }, '', newUrl);
    }

    inputText = document.getElementById('textBusca');

    inputText.addEventListener("input", () => {
        let num = inputText.value;
        console.log(num);
        var localNovo = document.getElementById('localNovo');
        var status = document.getElementById('status');
        var numSerie = document.getElementById('numSerie');
        var tipo = document.getElementById('tipo');

        if(num == 1) {
            localNovo.required = true;
            status.required = true;
            numSerie.required = true;
            tipo.required = true;
        }

        let newUrl = 'cadastrarbens.php?num=' + num;
        window.history.pushState({
            path: newUrl
        }, '', newUrl);
    });


    function alert(num) {
        if (num == 1) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                customClass: ({
                    title: 'swal2-title'
                }),
                icon: "success",
                title: "Item cadastrado com sucesso!",
                background: 'green',
                iconColor: '#ffffff'
            });
        }
    }

    window.addEventListener('load', function() {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var data = url.searchParams.get("notificacao");
        if (data == 'true') {
            alert(1);
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });
</script>

</html>