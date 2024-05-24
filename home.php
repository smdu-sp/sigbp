<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');

$sql_home_count_query = "SELECT COUNT(*) as c FROM item, transferencia WHERE item.idbem = transferencia.iditem;";
$sql_home_count_query_exec = $conexao->query($sql_home_count_query) or die($conexao->error);

$sql_home_count = $sql_home_count_query_exec->fetch_assoc();
$home_count = $sql_home_count['c'];

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    $limit = 7;
}
$offset = ($page - 1) * $limit;
$page_number = ceil($home_count / $limit);
$busca = "SELECT item.patrimonio, item.tipo, item.marca, item.modelo, item.nome, transferencia.cimbpm, transferencia.localnovo, transferencia.servidoratual, transferencia.usuario, transferencia.datatransf FROM item, transferencia WHERE item.idbem = transferencia.iditem ORDER BY transferencia.datatransf DESC";

$sql_home_query = "$busca LIMIT {$limit} OFFSET {$offset}";
$sql_home_query_exec = $conexao->query($sql_home_query) or die($conexao->error);
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

    .modal {
        background-color: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: none;
    }
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 principal-home conteudo">
        <div class="carrossel-box mb-4">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./home.php" class="text-primary ms-1 carrossel-text">Home</a>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
        </div>
        <h2 class="mb-3 mt-4">Últimas Movimentações</h2>
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <div class="d-flex justify-content-center flex-column" style="width: 100%;">
                <form class="d-flex justify-content-end align-items-end" action="pesquisar-home.php" method="GET" style="width: 100%;">
                    <input type="hidden" name="limit" value="<?php echo $limit; ?>">
                    <a href="#" onclick="recarregar()" class="mb-2 mr-2 usuario-img" id="recarregar" style="cursor: pointer;">
                        <img src="./images/icon-recarregar.png" alt="#" id='img-recarregar'>
                    </a>
                    <a class="mb-2 mr-2 usuario-img" onclick='limparInput()' id="limpar" style="cursor: pointer;">
                        <img src="./images/limpar.png" alt="#" id='img-recarregar'>
                    </a>
                    <div class="col-2 mb-2">
                        <p class="mb-1 text-muted">Ano:</p>
                        <select id="unidadeSelect" class="form-select" name="ano">
                            <option value="" hidden>Selecionar</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Unidade:</p>
                        <select id="unidadeSelect" class="form-select" name="unidade">
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
                    <div class="col-6 mb-2">
                        <p class="mb-1 text-muted">Buscar:</p>
                        <input class="form-control buscar" id="myInput" name="pesquisar" type="text" placeholder="Procurar...">
                    </div>
                    <button type="submit" class="btn btn-primary btn-filtrar"><img class="icon" src="./images/icon-filtrar.png" alt="#"></button>
                </form>
                <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nº Patrimônio</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição do Bem</th>
                            <th scope="col">Localização</th>
                            <th scope="col">Servidor</th>
                            <th scope="col">Responsável</th>
                            <th scope="col">CIMBPM</th>
                            <th scope="col">Data</th>
                        </tr>
                    </thead>
                    <tbody id='myTable'>
                        <?php
                        while ($user_data = $sql_home_query_exec->fetch_assoc()) {
                            $marca = $user_data['marca'];
                            $modelo = $user_data['modelo'];
                            $tipo = $user_data['tipo'];
                            $patrimonio = $user_data['patrimonio'];
                            $desc = "$tipo $marca Modelo: $modelo";
                            echo "<tr>";
                            echo "<td style='cursor: pointer;' onclick=location.href='historicodoitem.php?patrimonio=$patrimonio'>" . $user_data['patrimonio'] . "<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;' onclick=location.href='historicodoitem.php?patrimonio=$patrimonio'>" . $user_data['nome'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;' onclick=location.href='historicodoitem.php?patrimonio=$patrimonio'>" . $desc . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;' onclick=location.href='historicodoitem.php?patrimonio=$patrimonio'>" . $user_data['localnovo'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;' onclick=location.href='historicodoitem.php?patrimonio=$patrimonio'>" . $user_data['servidoratual'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;' onclick=location.href='historicodoitem.php?patrimonio=$patrimonio'>" . $user_data['usuario'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;' onclick=location.href='historicodoitem.php?patrimonio=$patrimonio'>" . $user_data['cimbpm'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;' onclick=location.href='historicodoitem.php?patrimonio=$patrimonio'>" . $user_data['datatransf'] . '<span hidden>todos</span>' . "</td>";
                            echo "</tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class='pagination-controls'>
                <div class='records-per-page'>
                    <label for='recordsPerPage'>Registros por página:</label>
                    <select id='recordsPerPage' onchange="updateLimit()">
                        <option value='<?php echo $limit ?>' hidden> <?php echo $limit ?></option>
                        <option value='7'>7</option>
                        <option value='14'>14</option>
                    </select>
                </div>
                <div class='page-info'>Página <?php echo $page; ?> de <?php echo $page_number; ?></div>
                <?php
                $opacidade_esquerda = ($page == 1) ? '0.5' : '1';
                $opacidade_direita = ($page == $page_number) ? '0.5' : '1';
                $disabled_esquerda = ($opacidade_esquerda == '0.5') ? 'disabled' : '';
                $disabled_direita = ($opacidade_direita == '0.5') ? 'disabled' : '';

                echo "<a href='?page=" . ($page - 1) . '&limit=' . $limit . "' class='arrow-button esquerda" . ($disabled_esquerda ? ' disabled' : '') . "' id='esquerda" . ($disabled_esquerda ? '-disabled' : '') . "' style='opacity: {$opacidade_esquerda}' {$disabled_esquerda} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></a>";
                echo "<a href='?page=" . ($page + 1) . '&limit=' . $limit . "' class='arrow-button direita" . ($disabled_direita ? ' disabled' : '') . "' id='direita" . ($disabled_direita ? '-disabled' : '') . "' style='opacity: {$opacidade_direita}' {$disabled_direita} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></a>";


                ?>
            </div>
        </div>
        <div class="overlay"></div>
    </div>

    <div class="card rounded-3 shadow p-3 bg-white rounded border-0 modal" id="vis-modal" style="width: 1200px;">
        <div class="conteudo-modal">
            <h3 class="modal-title mb-3">Movimentações do Item</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nº Patrimônio</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição do Bem</th>
                        <th scope="col">Localização</th>
                        <th scope="col">Servidor</th>
                        <th scope="col">Responsável</th>
                        <th scope="col">CIMBPM</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>
                <tbody id='myTable'>
                    <?php
                    $sql_historico_query = "SELECT item.patrimonio, item.tipo, item.marca, item.modelo, item.nome, transferencia.cimbpm, transferencia.localnovo, transferencia.servidoratual, transferencia.usuario, transferencia.datatransf
                    FROM item, transferencia
                    WHERE item.idbem = transferencia.iditem AND item.patrimonio = '001-053259699-3'
                    ORDER BY transferencia.datatransf DESC";
                    $sql_historico_query_exec = $conexao->query($sql_historico_query) or die($conexao->error);
                    while ($user_data = $sql_historico_query_exec->fetch_assoc()) {
                        $marca = $user_data['marca'];
                        $modelo = $user_data['modelo'];
                        $tipo = $user_data['tipo'];
                        $desc = "$tipo $marca Modelo: $modelo";
                        echo "<tr>";
                        echo "<td>" . $user_data['patrimonio'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td>" . $user_data['nome'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td>" . $desc . '<span hidden>todos</span>' . "</td>";
                        echo "<td>" . $user_data['localnovo'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td>" . $user_data['servidoratual'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td>" . $user_data['usuario'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td>" . $user_data['cimbpm'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td>" . $user_data['datatransf'] . '<span hidden>todos</span>' . "</td>";
                        echo "</tr>";
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
<script>
function limparInput() {
    window.location.href = 'home.php';
}

function updateLimit() {
    var selectElement = document.getElementById('recordsPerPage');
    var selectedValue = selectElement.value;
    window.location.href = '?limit=' + selectedValue;
}

function recarregar() {
    window.location.reload(true);
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.arrow-button.disabled').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
        });
    });
});

</script>

</html>