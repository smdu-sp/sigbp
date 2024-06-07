<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

$result = $conexao->query('SELECT
    idbem as "Id",
    patrimonio as "Patrimonio",
    tipo as "Tipo",
    descsbpm as "Descricão",
    numserie as "NumSerie",
    tiposbpm as "TipoSBPM",
    marca as "Marca",
    modelo as "Modelo",
    localizacao as "Localização",
    servidor as "Servidor",
    numprocesso as "NumProcesso",
    cimbpm as "CIMBPM",
    nome as "Nome",
    statusitem as "Status"
    FROM sisgp.item;');

$registros = array();

while ($row = $result->fetch_assoc()) {
    $registros[] = $row;
}

echo "<script>const registros2=" . json_encode($registros) . ";</script>";


$sql_item_count_query = "SELECT COUNT(*) as c FROM item";
$sql_item_count_query_exec = $conexao->query($sql_item_count_query) or die($conexao->error);

$sql_item_count = $sql_item_count_query_exec->fetch_assoc();
$item_count = $sql_item_count['c'];

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    setcookie('recordsPerPage', $limit, time() + (86400 * 30), "/"); 
} else if (isset($_COOKIE['recordsPerPage'])) {
    $limit = $_COOKIE['recordsPerPage'];
} else {
    $limit = 5;
}

$offset = ($page - 1) * $limit;

$page_number = ceil($item_count / $limit);

$busca = "SELECT * FROM item ORDER BY idbem DESC";

$sql_item_query = "$busca LIMIT {$limit} OFFSET {$offset}";
$sql_item_query_exec = $conexao->query($sql_item_query) or die($conexao->error);


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

    #table {
        max-height: 600px;
    }

    table {
        overflow: auto;
    }

    .div-table {
        width: 100%;
        overflow: auto;
    }

    .div-table::-webkit-scrollbar {
        height: 7px;
    }

    .div-table::-webkit-scrollbar-track {
        background-color: #fff;
    }

    .div-table::-webkit-scrollbar-thumb {
        background: #d3d3d3;
        border-radius: 5px;
    }

    .action-links {
        display: flex;
        gap: 10px; 
    }
    .action-links a {
        display: inline-block;
    }
</style>

<body style="overflow-x: hidden;">
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">

        <div class="carrossel-box mb-4">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./listaremovimentar.php" class="text-primary ms-1 carrossel-text">Listar e Movimentar</a>
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
                            <option value="Todos">Todos</option>
                        </select>
                    </div>
                    <div class="col-3 ml-2 mb-2">
                        <p class="mb-1 text-muted">Tipo:</p>
                        <select class="form-select" name="tipo" id="tipo">
                            <option value="" hidden="hidden">Selecionar</option>
                            <?php
                            include 'query-tipos.php';
                            ?>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Unidade:</p>
                        <select id="unidadeSelect" class="form-select" name="unidade">
                            <option value="" hidden="hidden">Selecionar</option>
                            <?php include 'query-unidades.php' ?>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Buscar:</p>
                        <input class="form-control buscar" id="myInput" name="pesquisar" type="text" placeholder="Procurar...">
                    </div>
                    <button type="submit" class="btn btn-primary btn-filtrar"><img class="icon" src="./images/icon-filtrar.png" alt="#"></button>
                </form>
                <br>
                <div class="div-table mb-1">
                    <table class="table table-hover" id="table">
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
                                echo "<td><div class='action-links'>" . "<a href='movimentacao.php?id=$user_data[idbem]' class='border-0'><img src='./images/icon-seta.png' alt='Seta'></a>" . "<a href='alteracaodebens.php?id=$user_data[idbem]'><img src='./images/icon-lapis.png' alt='Seta'></a>" . "<span hidden>todos</span></div></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class='pagination-controls d-flex justify-content-between'>

                <input type="button" onclick="exportarArquivo('listaremovimentar')" value="Exportar" class="btn btn-outline-primary" style="height:40px">

                <div class="d-flex flex-row">
                    <div class='recorde-por-pagina'>
                        <label for='recordsPerPage'>Registros por página:</label>
                        <select id='recordsPerPage' onchange="updateLimit()">
                            <option value='<?php echo $limit ?>' hidden> <?php echo $limit ?></option>
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
                    echo "<a href='?page=" . ($page - 1) . '&limit=' . $limit . "' class='arrow-button esquerda" . ($disabled_esquerda ? ' disabled' : '') . "' id='esquerda" . ($disabled_esquerda ? '-disabled' : '') . "' style='opacity: {$opacidade_esquerda}' {$disabled_esquerda} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></a>";
                    echo "<a href='?page=" . ($page + 1) . '&limit=' . $limit . "' class='arrow-button direita" . ($disabled_direita ? ' disabled' : '') . "' id='direita" . ($disabled_direita ? '-disabled' : '') . "' style='opacity: {$opacidade_direita}' {$disabled_direita} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></a>";    
                    ?>
                </div>
            </div>
            <div class="col-2">
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

    function updateLimit() {
        var selectElement = document.getElementById('recordsPerPage');
        var selectedValue = selectElement.value;
        window.location.href = '?limit=' + selectedValue;
    }

    function recarregar() {
        window.location.reload(true);
    }

    document.addEventListener('DOMContentLoaded', function() {
        var storedLimit = localStorage.getItem('recordsPerPage');
        if (storedLimit) {
            document.getElementById('recordsPerPage').value = storedLimit;
        }

        document.querySelectorAll('.arrow-button.disabled').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
            });
        });
    });

    function alert(num) {
        if (num == 2) {
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
                title: "Item alterado com sucesso!",
                background: 'green',
                iconColor: '#ffffff'
            });
        } else if (num == 3) {
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
                title: "Item movimentado com sucesso!",
                background: 'green',
                iconColor: '#ffffff'
            });
        }
    }

    window.addEventListener('load', function() {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var data = url.searchParams.get("notificacao");
        if (data == 2) {
            alert(2);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'listaremovimentar.php');
        } else if (data == 1) {
            alert(3);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'listaremovimentar.php');
        }
    })
</script>

</html>