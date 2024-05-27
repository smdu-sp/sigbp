<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

$condicoes = [];

if (isset($_GET['nome']) && $_GET['nome'] !== '') {
    $condicoes[] = "unidades = '{$_GET['nome']}'";
}

if (isset($_GET['pesquisar']) && $_GET['pesquisar'] !== '') {
    $valor_pesquisar = $_GET['pesquisar'];
    $condicoes[] = "(unidades LIKE '%$valor_pesquisar%' OR sigla LIKE '%$valor_pesquisar%' OR codigo LIKE '%$valor_pesquisar%' OR statusunidade LIKE '%$valor_pesquisar%')";
}

if (isset($_GET['status']) && $_GET['status'] !== '') {
    if ($_GET['status'] != 'Todos') {
        $condicoes[] = "statusunidade = '{$_GET['status']}'";
    }
}

if (isset($_GET['sigla']) && $_GET['sigla'] !== '') {
    $condicoes[] = "sigla = '{$_GET['sigla']}'";
}

$where = '';
if (!empty($condicoes)) {
    $where = " WHERE " . implode(" AND ", $condicoes);
}

$busca = "SELECT * FROM unidades $where ORDER BY id ASC";

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    $limit = 10;
}
$offset = ($page - 1) * $limit;

$sql_unidades_query = "$busca LIMIT {$limit} OFFSET {$offset}";
$sql_unidades_query_exec = $conexao->query($sql_unidades_query) or die($conexao->error);

$sql_unidades_count_query = "SELECT COUNT(*) as c FROM unidades $where";
$sql_unidades_count_query_exec = $conexao->query($sql_unidades_count_query) or die($conexao->error);

$sql_unidades_count = $sql_unidades_count_query_exec->fetch_assoc();
$unidades_count = $sql_unidades_count['c'];

$page_number = ceil($unidades_count / $limit);
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
                <a href="./unidades.php" class="text-primary ms-1 carrossel-text">Usuários</a>
            </div>
            <!-- <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div> -->
        </div>
        <h2 class="mb-3 mt-4">Unidades</h2>
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <div class="d-flex justify-content-center flex-column" style="width: 100%;">
                <form class="d-flex justify-content-end align-items-end" action="pesquisar-unidades.php" method="GET" style="width: 100%;">
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
                            <option value="<?php echo empty($status) ? 'Ativo' : htmlspecialchars($status); ?>" hidden><?php echo empty($status) ? 'Ativo' : htmlspecialchars($status); ?></option>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                            <option value="Todos">Todos</option>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Sigla:</p>
                        <select id="permissaoSelect" class="form-select" aria-label="Default select example" name="sigla">
                            <option value="<?php echo $_GET['sigla'] == '' ? '' : $_GET['sigla'] ?>" hidden><?php echo $_GET['sigla'] == '' ? 'Selecionar' : $_GET['sigla'] ?></option>
                        <?php include 'query-unidades.php'?>
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
                            <th>Nome</th>
                            <th>Sigla</th>
                            <th>Codigo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id='myTable'>
                        <?php
                        while ($user_data = $sql_unidades_query_exec->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>" . $user_data['unidades'] . "</td>";
                            echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>" . $user_data['sigla'] . "</td>";
                            echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>" . $user_data['codigo'] . "</td>";
                            echo "<td style='cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>" . $user_data['statusunidade'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class='pagination-controls'>
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

                $status = $_GET['status'];
                $pesquisar = $_GET['pesquisar'];
                $sigla = $_GET['sigla'];


                echo "<a href='?page=" . ($page - 1) . "&limit=" . $limit . "&status=" . $status . "&sigla=" . $sigla  . "&pesquisar=" . $pesquisar . "' class='arrow-button esquerda" . ($disabled_esquerda ? ' disabled' : '') . "' id='esquerda" . ($disabled_esquerda ? '-disabled' : '') . "' style='opacity: {$opacidade_esquerda}' {$disabled_esquerda} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></a>";
                echo "<a href='?page=" . ($page + 1) . "&limit=" . $limit . "&status=" . $status . "&sigla=" . $sigla  . "&pesquisar=" . $pesquisar . "' class='arrow-button direita" . ($disabled_direita ? ' disabled' : '') . "' id='direita" . ($disabled_direita ? '-disabled' : '') . "' style='opacity: {$opacidade_direita}' {$disabled_direita} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></a>";

                ?>
            </div>
            <div class="d-flex justify-content-end mt-4 mr-2">
                <a href="./cadastrodeunidades.php" id="btn-adc-usuario">
                    <img src="./images/icons-adcUsuario.png" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="hide" id="modal"></div>
</body>
<script>
    function limparInput() {
        window.location.href = 'unidades.php';
    }

    function recarregar() {
        window.location.reload(true);
    }

    function updateLimit() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const newLimit = document.getElementById('recordsPerPage').value;
        const status = urlParams.get('status');
        const sigla = urlParams.get('sigla');
        const pesquisar = urlParams.get('pesquisar');
        window.location.href = '?limit=' + newLimit + '&status=' + status + '&sigla=' + sigla + '&pesquisar=' + pesquisar;
    }


    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.arrow-button.disabled').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
            });
        });
    });
</script>