<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

$condicoes = [];

if (isset($_GET['unidade']) && $_GET['unidade'] !== '') {
    $condicoes[] = "localizacao = '{$_GET['unidade']}'";
}

if (isset($_GET['pesquisar']) && $_GET['pesquisar'] !== '') {
    $valor_pesquisar = $_GET['pesquisar'];
    $condicoes[] = "(patrimonio LIKE '%$valor_pesquisar%' OR tipo LIKE '%$valor_pesquisar%' OR descsbpm LIKE '%$valor_pesquisar%' OR numserie LIKE '%$valor_pesquisar%' OR tiposbpm LIKE '%$valor_pesquisar%' OR marca LIKE '%$valor_pesquisar%' OR modelo LIKE '%$valor_pesquisar%' OR localizacao LIKE '%$valor_pesquisar%' OR servidor LIKE '%$valor_pesquisar%' OR numprocesso LIKE '%$valor_pesquisar%' OR cimbpm LIKE '%$valor_pesquisar%' OR nome LIKE '%$valor_pesquisar%' OR statusitem LIKE '%$valor_pesquisar%')";
}

if (isset($_GET['tipo']) && $_GET['tipo'] !== '') {
    $condicoes[] = "tipo = '{$_GET['tipo']}'";
}

if (isset($_GET['permissao']) && $_GET['permissao'] !== '' && $_GET['permissao'] !== '4') {
    $condicoes[] = "permissao = '{$_GET['permissao']}'";
}

$where = '';
if (!empty($condicoes)) {
    $where = " WHERE " . implode(" AND ", $condicoes);
}

$busca = "SELECT * FROM item $where ORDER BY idbem ASC";

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    $limit = 10;
}
$offset = ($page - 1) * $limit;

$sql_item_query = "$busca LIMIT {$limit} OFFSET {$offset}";
$sql_item_query_exec = $conexao->query($sql_item_query) or die($conexao->error);

$sql_item_count_query = "SELECT COUNT(*) as c FROM item $where";
$sql_item_count_query_exec = $conexao->query($sql_item_count_query) or die($conexao->error);

$sql_item_count = $sql_item_count_query_exec->fetch_assoc();
$item_count = $sql_item_count['c'];

$page_number = ceil($item_count / $limit);
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$unidade = isset($_GET['unidade']) ? $_GET['unidade'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
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

    #img-recarregar {
        width: 22px;
        height: 22px;
    }

    .btn-filtrar {
        width: 40px;
        height: 40px;
        margin-bottom: 7px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-filtrar>img {
        width: 25px;
        height: 25px;
    }

    /* .overflow {
        max-height: 870px;
        overflow: auto;
    } */
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel-box mb-4">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./usuarios.php" class="text-primary ms-1 carrossel-text">Usuários</a>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
        </div>
        <h2 class="mb-3 mt-4">Listar e Movimentar</h2>
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <div class="d-flex justify-content-center flex-column" style="width: 100%;">
                <form class="d-flex justify-content-end align-items-end" action="pesquisar-item.php" method="GET" style="width: 100%;">
                    <input type="hidden" name="limit" value="<?php echo $limit; ?>">
                    <a href="#" onclick="recarregar()" class="mb-2 mr-2 usuario-img" id="recarregar" style="cursor: pointer;">
                        <img src="./images/icon-recarregar.png" alt="#" id='img-recarregar'>
                    </a>
                    <a class="mb-2 mr-2 usuario-img" onclick='limparInput()' id="limpar" style="cursor: pointer;">
                        <img src="./images/limpar.png" alt="#" id='img-recarregar'>
                    </a>
                    <div class="col-2 ml-2 mb-2">
                        <p class="mb-1 text-muted">Status:</p>
                        <select id="statusSelect" class="form-select" aria-label="Default select example" name="status">
                            <option value="Ativo" selected>Ativo</option>
                            <option value="Inativo">Inativo</option>
                            <option value="todos">Todos</option>
                        </select>
                    </div>
                    <div class="col-3 ml-2 mb-2">
                        <p class="mb-1 text-muted">Tipo:</p>
                        <select class="form-select" name="tipo" id="tipo">
                            <option value="<?php echo $_GET['tipo'] == '' ? '' : $_GET['tipo'] ?>" hidden><?php echo $_GET['tipo'] == '' ? 'Selecionar' : $_GET['tipo'] ?></option>
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
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Unidade:</p>
                        <select id="unidadeSelect" class="form-select" name="unidade">
                            <option value="<?php echo $_GET['unidade'] == '' ? '' : $_GET['unidade'] ?>" hidden><?php echo $_GET['unidade'] == '' ? 'Selecionar' : $_GET['unidade'] ?></option>
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
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Buscar:</p>
                        <input class="form-control buscar" id="myInput" name="pesquisar" type="text" placeholder="Procurar..." value="<?php echo $_GET['pesquisar'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-filtrar"><img class="icon" src="./images/icon-filtrar.png" alt="#"></button>
                </form>
                <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th hidden>Id</th>
                            <th>Nº Patrimônio</th>
                            <th>Nome</th>
                            <th>Marca</th>
                            <th>Tipo</th>
                            <th>Desc. SBPM</th>
                            <th>Modelo</th>
                            <th>Núm. de Série</th>
                            <th>Localização</th>
                            <th>Servidor</th>
                            <th>Num. Processo</th>
                            <th>CIMBPM</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id='myTable'>
                        <?php
                        while ($user_data = $sql_item_query_exec->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td hidden>" . $user_data['idbem'] . "</td>";
                            echo "<td>" . $user_data['patrimonio'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . $user_data['nome'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . $user_data['marca'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . $user_data['tipo'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . $user_data['descsbpm'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . $user_data['modelo'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . $user_data['numserie'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . $user_data['localizacao'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . $user_data['servidor'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . $user_data['numprocesso'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . $user_data['cimbpm'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . $user_data['statusitem'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td>" . "<a href='movimentacao.php?id=$user_data[idbem]'><img src='./images/icon-seta.png' alt='Seta'></a>" . "<a href='alteracaodebens.php?id=$user_data[idbem]'><img src='./images/icon-lapis.png' alt='Seta'></a>" . '<span hidden>todos</span>' . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class='pagination-controls'>
            <input type="button" onclick="exportarArquivo(  'listaremovimentar')" value="Exportar" class="btn btn-primary" style="margin-right: 1010px;">
                <div class='records-per-page'>
                    <label for='recordsPerPage'>Registros por página:</label>
                    <select id='recordsPerPage' onchange="updateLimit()">
                        <option value='<?php echo $limit ?>' selected hidden> <?php echo $limit ?></option>
                        <option value='5'>5</option>
                        <option value='10'>10</option>
                    </select>
                </div>
                <div class='page-info'>Página <?php echo $page; ?> de <?php echo $page_number; ?></div>
                <?php
                $opacidade_esquerda = ($page == 1) ? '0.5' : '1';
                $opacidade_direita = ($page == $page_number) ? '0.5' : '1';
                $disabled_esquerda = ($opacidade_esquerda == '0.5') ? 'disabled' : '';
                $disabled_direita = ($opacidade_direita == '0.5') ? 'disabled' : '';

                $unidade = $_GET['unidade'];
                $pesquisar = $_GET['pesquisar'];
                $status = $_GET['status'];
                $tipo = $_GET['tipo'];

                echo "<a href='?page=" . ($page - 1) . "&limit=" . $limit . "&status=" . $status . "&tipo=" . $tipo . "&unidade=" . $unidade . "&pesquisar=" . $pesquisar . "' class='arrow-button esquerda" . ($disabled_esquerda ? ' disabled' : '') . "' id='esquerda" . ($disabled_esquerda ? '-disabled' : '') . "' style='opacity: {$opacidade_esquerda}' {$disabled_esquerda} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></a>";
                echo "<a href='?page=" . ($page + 1) . "&limit=" . $limit . "&status=" . $status . "&tipo=" . $tipo . "&unidade=" . $unidade . "&pesquisar=" . $pesquisar . "' class='arrow-button direita" . ($disabled_direita ? ' disabled' : '') . "' id='direita" . ($disabled_direita ? '-disabled' : '') . "' style='opacity: {$opacidade_direita}' {$disabled_direita} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></a>";

                ?>
            </div>
            <div class="d-flex justify-content-end mt-4 mr-2">
                <a href="./cadastrodeusuario.php" id="btn-adc-usuario">
                    <img src="./images/icons-adcUsuario.png" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="hide" id="modal"></div>
</body>
<script>
    function exportarArquivo() {
        var worksheet = XLSX.utils.json_to_sheet(registros2);
        var workbook = XLSX.utils.book_new(registros2);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Inscrições');

        var data_atual = new Date();

        var dia = data_atual.getDate();
        var mes = data_atual.getMonth() + 1;
        var ano = data_atual.getFullYear();
        var hora = data_atual.getHours();
        var min = data_atual.getMinutes();
        var seg = data_atual.getSeconds();

        var dataFormatada = `movimentação-${dia}-${mes}-${ano}`;
        var nome;
        XLSX.writeFile(workbook, dataFormatada + '.XLSX');
        console.log(registros2);
    }

    function limparInput() {
        window.location.href = 'listaremovimentar.php';
    }

    function recarregar() {
        window.location.reload(true);
    }

    function updateLimit() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const newLimit = document.getElementById('recordsPerPage').value;
        const status = urlParams.get('status');
        const tipo = urlParams.get('tipo');
        const unidade = urlParams.get('unidade');
        const pesquisar = urlParams.get('pesquisar');
        window.location.href = '?limit=' + newLimit + '&status=' + status + '&tipo=' + tipo + '&unidade=' + unidade + '&pesquisar=' + pesquisar;
    }


    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.arrow-button.disabled').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
            });
        });
    });
</script>