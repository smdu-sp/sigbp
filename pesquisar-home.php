<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');

$condicoes = [];
$joins = [];

if (isset($_GET['unidade']) && $_GET['unidade'] !== '') {
    $unidade = $conexao->real_escape_string($_GET['unidade']);
    $condicoes[] = "localnovo = '$unidade'";
}

if (isset($_GET['ano']) && $_GET['ano'] !== '') {
    $ano = $_GET['ano'];
    $condicoes[] = "transferencia.datatransf LIKE '%$ano%'";
}

if (isset($_GET['pesquisar']) && $_GET['pesquisar'] !== '') {
    $valor_pesquisar = $conexao->real_escape_string($_GET['pesquisar']);
    $palavras = explode(' ', $valor_pesquisar);
    if (count($palavras) >= 1) {
        $condicao_individual = [];
        foreach ($palavras as $palavra) {
            if (DateTime::createFromFormat('Y-m-d', $palavra) !== false) {
                $data_formatada = date('Y-m-d', strtotime($palavra));
                $condicao_individual[] = "transferencia.datatransf LIKE '%$data_formatada%'";
            } else {
                $palavra = $conexao->real_escape_string($palavra);
                $condicao_individual[] = "(item.patrimonio LIKE '%$palavra%' OR item.nome LIKE '%$palavra%' OR transferencia.localnovo LIKE '%$palavra%' OR transferencia.cimbpm LIKE '" . '%' . str_replace('-', '.', $palavra) . '%' . "' OR transferencia.servidoratual LIKE '%$palavra%' OR transferencia.datatransf LIKE '%$palavra%')";
            }
        }
        $condicoes[] = "(" . implode(" OR ", $condicao_individual) . ")";
    }
}

if (!empty($condicoes)) {
    $where = " WHERE " . implode(" AND ", $condicoes);
} else {
    $where = '';
}

$busca = "SELECT item.patrimonio, item.tipo, item.marca, item.modelo, item.nome, transferencia.cimbpm, transferencia.localnovo, transferencia.servidoratual, transferencia.usuario, transferencia.datatransf 
FROM item
INNER JOIN transferencia ON item.idbem = transferencia.iditem
$where
ORDER BY transferencia.datatransf DESC";

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if (isset($_GET['limit'])) {
    $limit = $conexao->real_escape_string($_GET['limit']);
} else {
    $limit = 7;
}
$offset = ($page - 1) * $limit;

$sql_home_query = "$busca LIMIT {$limit} OFFSET {$offset}";
$sql_home_query_exec = $conexao->query($sql_home_query) or die($conexao->error);

$sql_home_count_query = "SELECT COUNT(*) as c FROM item INNER JOIN transferencia ON item.idbem = transferencia.iditem $where";
$sql_home_count_query_exec = $conexao->query($sql_home_count_query) or die($conexao->error);

$sql_home_count = $sql_home_count_query_exec->fetch_assoc();
$home_count = $sql_home_count['c'];

$page_number = ceil($home_count / $limit);

$pagina = isset($_GET['pagina']) ? $conexao->real_escape_string($_GET['pagina']) : 1;
$unidade = isset($_GET['unidade']) ? $conexao->real_escape_string($_GET['unidade']) : '';
$ano = $unidade = isset($_GET['ano']) ? $conexao->real_escape_string($_GET['ano']) : '';
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
                <a href="./home.php" class="text-primary ms-1 carrossel-text">Home</a>
            </div>
            <!-- <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div> -->
        </div>
        <h2 class="mb-3 mt-4">Últimas Movimentações</h2>
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <div class="d-flex justify-content-center flex-column" style="width: 100%;">
                <form class="d-flex justify-content-end align-items-end" action="pesquisar-home.php" method="GET" style="width: 100%;">
                    <a href="#" onclick="recarregar()" class="mb-2 mr-2 usuario-img" id="recarregar" style="cursor: pointer;">
                        <img src="./images/icon-recarregar.png" alt="#" id='img-recarregar'>
                    </a>
                    <a class="mb-2 mr-2 usuario-img" onclick='limparInput()' id="limpar" style="cursor: pointer;">
                        <img src="./images/limpar.png" alt="#" id='img-recarregar'>
                    </a>
                    <div class="col-2 mb-2">
                        <p class="mb-1 text-muted">Ano:</p>
                        <select id="anoSelect" class="form-select" name="ano">
                        <option value="<?php echo htmlspecialchars($ano) == '' ? '' : htmlspecialchars($ano) ?>" hidden><?php echo htmlspecialchars($ano) == '' ? 'Selecionar' : htmlspecialchars($ano) ?></option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Unidade:</p>
                        <select id="unidadeSelect" class="form-select" name="unidade">
                            <option value="<?php echo $_GET['unidade'] == '' ? '' : $_GET['unidade'] ?>" hidden><?php echo $_GET['unidade'] == '' ? 'Selecionar' : $_GET['unidade'] ?></option>
                            <?php include 'query-unidades.php' ?>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <p class="mb-1 text-muted">Buscar:</p>
                        <input class="form-control buscar" id="myInput" name="pesquisar" type="text" placeholder="Procurar..." value="<?php echo $_GET['pesquisar'] ?>">
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
                            $desc = "$tipo $marca Modelo: $modelo";
                            echo "<tr>";
                            echo "<td style='cursor: pointer;'>{$user_data['patrimonio']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$user_data['nome']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$desc}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$user_data['localnovo']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$user_data['servidoratual']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$user_data['usuario']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$user_data['cimbpm']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$user_data['datatransf']}<span hidden>todos</span></td>";
                            echo "</tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class='pagination-controls'>
                <div class='records-per-page'>
                    <label for='recordsPerPage'>Registros por página:</label>
                    <select id='recordsPerPage' onchange="updateLimit()">
                        <option value='<?php echo $limit ?>' selected hidden> <?php echo $limit ?></option>
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

                $unidade = $_GET['unidade'];
                $pesquisar = $_GET['pesquisar'];
                $ano = $_GET['ano'];

                echo "<a href='?page=" . ($page - 1) . "&limit=" . $limit . "&ano=" . $ano . "&unidade=" . urlencode($unidade) . "&pesquisar=" . urlencode($pesquisar) . "' class='arrow-button esquerda" . ($disabled_esquerda ? ' disabled' : '') . "' id='esquerda" . ($disabled_esquerda ? '-disabled' : '') . "' style='opacity: {$opacidade_esquerda}' {$disabled_esquerda} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></a>";
                echo "<a href='?page=" . ($page + 1) . "&limit=" . $limit . "&ano=" . $ano . "&unidade=" . urlencode($unidade) . "&pesquisar=" . urlencode($pesquisar) . "' class='arrow-button direita" . ($disabled_direita ? ' disabled' : '') . "' id='direita" . ($disabled_direita ? '-disabled' : '') . "' style='opacity: {$opacidade_direita}' {$disabled_direita} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></a>";

                ?>
            </div>
        </div>
    </div>
    <div class="hide" id="modal"></div>
</body>
<script>
    function limparInput() {
        window.location.href = 'home.php';
    }

    function recarregar() {
        window.location.reload(true);
    }

    function updateLimit() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const newLimit = document.getElementById('recordsPerPage').value;
        const ano = urlParams.get('ano');
        const unidade = urlParams.get('unidade');
        const pesquisar = urlParams.get('pesquisar');
        window.location.href = '?limit=' + newLimit + '&ano=' + ano + '&unidade=' + unidade + '&pesquisar=' + pesquisar;
    }


    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.arrow-button.disabled').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
            });
        });
    });
</script>