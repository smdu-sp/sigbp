<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');

$ano = isset($_GET['ano']) ? $_GET['ano'] : 2024;

$result = $conexao->query("WITH ranked_transferencia AS (
    SELECT 
        item.patrimonio AS `Patrimônio`, 
        item.nome AS `Nome`, 
        CONCAT(item.tipo, ' ', item.marca, ' Modelo: ', item.modelo) AS `Descricao do Bem`, 
        transferencia.localnovo AS `Localização`, 
        transferencia.servidoratual AS `Servidor`, 
        transferencia.usuario AS `Responsável`, 
        transferencia.cimbpm AS `CIMBPM`, 
        transferencia.datatransf AS `DataTransf`,
        ROW_NUMBER() OVER (PARTITION BY item.patrimonio ORDER BY transferencia.datatransf DESC) AS rn
    FROM 
        item
    JOIN 
        transferencia ON item.idbem = transferencia.iditem
    WHERE 
        YEAR(transferencia.datatransf) = '$ano'
)
SELECT 
    `Patrimônio`, 
    `Nome`, 
    `Descricao do Bem`, 
    `Localização`, 
    `Servidor`, 
    `Responsável`, 
    `CIMBPM`, 
    `DataTransf`
FROM 
    ranked_transferencia
WHERE 
    rn = 1
ORDER BY 
    `DataTransf` DESC
");

$registros = array();

while ($row = $result->fetch_assoc()) {
    $registros[] = $row;
}

echo "<script>const registros2=" . json_encode($registros) . ";</script>";

$sql_inventario_count_query = "WITH ranked_transferencia AS (
    SELECT 
        item.patrimonio, 
        item.tipo, 
        item.marca, 
        item.modelo, 
        item.nome, 
        transferencia.cimbpm, 
        transferencia.localnovo, 
        transferencia.servidoratual, 
        transferencia.usuario, 
        transferencia.datatransf,
        ROW_NUMBER() OVER (PARTITION BY item.patrimonio ORDER BY transferencia.datatransf DESC) as rn
    FROM 
        item
    JOIN 
        transferencia ON item.idbem = transferencia.iditem
    WHERE 
    YEAR(transferencia.datatransf) = '$ano'
)
SELECT 
    COUNT(*) as c
FROM 
    ranked_transferencia
WHERE 
    rn = 1
";
$sql_inventario_count_query_exec = $conexao->query($sql_inventario_count_query) or die($conexao->error);

$sql_inventario_count = $sql_inventario_count_query_exec->fetch_assoc();
$inventario_count = $sql_inventario_count['c'];

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
} else {
    $limit = 7;
}
$offset = ($page - 1) * $limit;
$page_number = ceil($inventario_count / $limit);
$busca = "WITH ranked_transferencia AS (
    SELECT 
        item.patrimonio, 
        item.tipo, 
        item.marca, 
        item.modelo, 
        item.nome, 
        transferencia.cimbpm, 
        transferencia.localnovo, 
        transferencia.servidoratual, 
        transferencia.usuario, 
        transferencia.datatransf,
        ROW_NUMBER() OVER (PARTITION BY item.patrimonio ORDER BY transferencia.datatransf DESC) as rn
    FROM 
        item
    JOIN 
        transferencia ON item.idbem = transferencia.iditem
    WHERE 
        YEAR(transferencia.datatransf) = '$ano'
)
SELECT 
    patrimonio, 
    tipo, 
    marca, 
    modelo, 
    nome, 
    cimbpm, 
    localnovo, 
    servidoratual, 
    usuario, 
    datatransf
FROM 
    ranked_transferencia
WHERE 
    rn = 1
ORDER BY 
    datatransf DESC
";
$sql_inventario_query = "$busca LIMIT {$limit} OFFSET {$offset}";
$sql_inventario_query_exec = $conexao->query($sql_inventario_query) or die($conexao->error);
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
    <div class="p-4 p-md-4 pt-3 principal-inventario conteudo">
        <div class="carrossel-box mb-4">
            <div class="carrossel">
                <a href="./inventario.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./inventario.php" class="text-primary ms-1 carrossel-text">Inventário</a>
            </div>
        </div>
        <h2 class="mb-3 mt-4">Inventário</h2>
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <div class="d-flex justify-content-center flex-column" style="width: 100%;">
                <form class="d-flex justify-content-end align-items-end" action="pesquisar-inventario.php" method="GET" style="width: 100%;">
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
                            <option value="2024" selected>2024</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Unidade:</p>
                        <select id="unidadeSelect" class="form-select" name="unidade">
                            <option value="" hidden="hidden">Selecionar</option>
                            <?php include 'query-unidades.php' ?>
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
                        while ($user_data = $sql_inventario_query_exec->fetch_assoc()) {
                            $marca = $user_data['marca'];
                            $modelo = $user_data['modelo'];
                            $tipo = $user_data['tipo'];
                            $patrimonio = $user_data['patrimonio'];
                            $desc = "$tipo $marca Modelo: $modelo";
                            echo "<tr>";
                            echo "<td>" . $user_data['patrimonio'] . "<span hidden>todos</span></td>";
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
            <div class='pagination-controls'>

            <input type="button" onclick="exportarArquivo('listaremovimentar')" value="Exportar" class="btn btn-outline-primary" style="margin-right: 940px; height:40px">        

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

        var dataFormatada = `inventario-${dia}-${mes}-${ano}`;
        var nome;
        XLSX.writeFile(workbook, dataFormatada + '.XLSX');
        console.log(registros2);
    }


    function limparInput() {
        window.location.href = 'inventario.php';
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