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
        $cimbpm = $_POST['CIMBPM'];
        $descsbpm = $_POST['descsbpm'];

        $result = mysqli_query($conexao, "INSERT INTO item(patrimonio, tipo, descsbpm, numserie, marca, modelo, localizacao, servidor, numprocesso, nome, statusitem, cimbpm) 
        VALUES ('$patrimonio', '$tipo', '$descsbpm', '$numserie', '$marca', '$modelo', '$localizacao', '$servidor', '$numprocesso', '$nome', '$statusitem', '$cimbpm')");

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
        border: 1px solid #DEE2E6;
        border-radius: 5px;
    }

    #registros>ul {
        padding: 6px 3px;
    }

    #registros>ul>li {
        border-radius: 5px;
    }

    #registros.show {
        display: block;
    }

    #textBusca {
        background-image: url("./images/arrow-sort-svgrepo-com.svg");
        background-repeat: no-repeat;
        background-position: calc(100% - 5px) center;
        background-size: 1.1em;
        opacity: 0.8;
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
            <!-- <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div> -->
        </div>
        <h2 class="mb-3 mt-4">Cadastro de bens</h2>
        <form method="POST" class="mt-5">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numPatrimonio" class="form-label text-muted">Número do Patrimônio PMSP:</label>
                    <input type="text" class="form-control" id="numPatrimonio" name="numPatrimonio">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tipo" class="form-label text-muted">Tipo:</label>
                    <select class="form-select" name="tipo" id="tipo" required>
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
                        <option value="TABLET MARCA SAMSUNG MODELO TAB S8 5G">TABLET MARCA SAMSUNG MODELO TAB S8 5G
                        </option>
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
                    <input type="text" class="form-control" id="numSerie" name="numSerie" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="localNovo" class="form-label text-muted">Localização:</label>
                    <select class="form-select" id="localNovo" name="localNovo" required>
                        <option value="" hidden="hidden">Selecionar</option>
                        <?php include 'query-unidades.php' ?>
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
                <div class="col-md-6 mb-3">
                    <label for="CIMBPM" class="form-label text-muted">CIMBPM:</label>
                    <input type="text" class="form-control" id="CIMBPM" name="CIMBPM">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="descsbpm" class="form-label text-muted">Desc. SBPM:</label>
                    <input type="text" class="form-control" id="descsbpm" name="descsbpm">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="status" class="form-label text-muted">Status:</label>
                    <select class="form-select" id="status" name="status" required>
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
                <div class="col-md-2 mb-4">
                    <label for="status" class="form-label text-muted">Num de Registro de Itens:</label>
                    <input type="number" class="form-control" name="numRegistro" id="numRegistro" onchange="numRegistros()" min="1" required>
                </div>
                <div class="col-md-10 mb-4 mt-4 d-flex justify-content-end align-items-start">
                    <input type="submit" class="btn btn-primary" id="btnCadBens" name="submit" value="Cadastrar"></input>
                </div>
            </div>
        </form>
        <div class="hide" id="modal"></div>
    </div>

</body>
<script>
    document.getElementById('numRegistro').addEventListener('input', function() {
        let item = this.value;
        let newUrl = 'cadastrarbens.php?num=' + item;
        setRequiredFields(item == 1);
        window.history.pushState({ path: newUrl }, '', newUrl);
    });

    function setRequiredFields(required) {
        var localNovo = document.getElementById('localNovo');
        var status = document.getElementById('status');
        var numSerie = document.getElementById('numSerie');
        var tipo = document.getElementById('tipo');

        localNovo.required = required;
        status.required = required;
        numSerie.required = required;
        tipo.required = required;
    }

    function showAlert(num, numPatrimonio, marca, numSerie, nomeServidor, nomeComputador, numProcesso) {
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

        if (!numPatrimonio || !marca || !numSerie || !nomeServidor || !nomeComputador || !numProcesso) {
            Toast.fire({
                customClass: {
                    title: 'swal2-title'
                },
                icon: "error",
                title: "Erro: Preencha todos os campos obrigatórios!",
                background: 'red',
                iconColor: '#ffffff'
            });
        } else if (num === 1) {
            Toast.fire({
                customClass: {
                    title: 'swal2-title'
                },
                icon: "success",
                title: "Item cadastrado com sucesso!",
                background: 'green',
                iconColor: '#ffffff'
            });
        } else if (num === 2) {
            Toast.fire({
                customClass: {
                    title: 'swal2-title'
                },
                icon: "success",
                title: "Item atualizado com sucesso!",
                background: 'blue',
                iconColor: '#ffffff'
            });
        } else {
            Toast.fire({
                customClass: {
                    title: 'swal2-title'
                },
                icon: "error",
                title: "Erro: Opção inválida!",
                background: 'red',
                iconColor: '#ffffff'
            });
        }
    }
    window.addEventListener('load', function() {
        console.log("Página carregada");
        var url_string = window.location.href;
        var url = new URL(url_string);
        var data = url.searchParams.get('notificacao');
        console.log("Parâmetro de notificação:", data);

        if (data === 'true') {
            console.log("Exibindo alerta de sucesso para cadastro");
            showAlert(1, true, true, true, true, true, true);
            window.history.replaceState({}, document.title, window.location.pathname);
        } else if (data === 'false') {
            console.log("Exibindo alerta de sucesso para atualização");
            showAlert(2, true, true, true, true, true, true);
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });
</script>

</html>