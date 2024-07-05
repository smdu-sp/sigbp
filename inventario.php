<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    setcookie('recordsPerPage_inventario', $limit, time() + (86400 * 30), "/");
} else if (isset($_COOKIE['recordsPerPage_inventario'])) {
    $limit = $_COOKIE['recordsPerPage_inventario'];
} else {
    $limit = 7;
}

$condicoes = [];
$joins = [];

$ano = isset($_GET['ano']) ? $_GET['ano'] : 2024;

if (isset($_GET['ano']) && $_GET['ano'] !== '') {
    $ano = $_GET['ano'];
    $condicoes[] = "transferencia.datatransf LIKE '%$ano%'";
}
if (isset($_GET['unidade']) && $_GET['unidade'] !== '') {
    $unidade = $conexao->real_escape_string($_GET['unidade']);
    $condicoes[] = "localnovo = '$unidade'";
}


if (isset($_GET['pesquisar']) && $_GET['pesquisar'] !== '') {
    $valor_pesquisar = $conexao->real_escape_string($_GET['pesquisar']);
    $palavras = explode(' ', $valor_pesquisar);
    $condicao_frase_completa = [];
    $condicao_individual = [];
    $condicao_frase_completa[] = "(item.patrimonio LIKE '%$valor_pesquisar%' OR item.nome LIKE '%$valor_pesquisar%' OR transferencia.localnovo LIKE '%$valor_pesquisar%' OR transferencia.cimbpm LIKE '%$valor_pesquisar%' OR transferencia.servidoratual LIKE '%$valor_pesquisar%' OR transferencia.datatransf LIKE '%$valor_pesquisar%')";

    foreach ($palavras as $palavra) {
        if (DateTime::createFromFormat('Y-m-d', $palavra) !== false) {
            $data_formatada = date('Y-m-d', strtotime($palavra));
            $condicao_individual[] = "transferencia.datatransf LIKE '%$data_formatada%'";
        } else {
            $palavra = $conexao->real_escape_string($palavra);
            $condicao_individual[] = "(item.patrimonio LIKE '%$palavra%' OR item.nome LIKE '%$palavra%' OR transferencia.localnovo LIKE '%$palavra%' OR transferencia.cimbpm LIKE '%" . str_replace('-', '.', $palavra) . "%' OR transferencia.servidoratual LIKE '%$palavra%' OR transferencia.datatransf LIKE '%$palavra%')";
        }
    }

    if (count($condicao_frase_completa) > 0) {
        $condicoes[] = "(" . implode(" OR ", $condicao_frase_completa) . ")";
    }
    if (count($condicao_individual) > 0) {
        $condicoes[] = "(" . implode(" OR ", $condicao_individual) . ")";
    }
}

if (!empty($condicoes)) {
    $where = " WHERE " . implode(" AND ", $condicoes);
} else {
    $where = '';
}


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
    $where
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
    $where
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

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$sql_inventario_query = "$busca LIMIT {$limit} OFFSET {$offset}";
$sql_inventario_query_exec = $conexao->query($sql_inventario_query) or die($conexao->error);

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
    $where
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

$page_number = ceil($inventario_count / $limit);

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

    .records-per-page_inventario {
        margin-top: 10px;
    }

    .records-per-page_inventario>label {
        margin-right: 10px;
    }

    #recordsPerPage_inventario {
        border: none;
        margin-right: 2px;
        font-size: 14px;
    }
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
                <a href="./inventario.php?ano=2024" class="text-primary ms-1 carrossel-text">Inventário</a>
            </div>
        </div>
        <h2 class="mb-3 mt-4">Inventário</h2>
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <div class="d-flex justify-content-center flex-column" style="width: 100%;">
                <div class="d-flex justify-content-end align-items-end" action="inventario.php" method="GET" style="width: 100%;">
                    <a href="#" onclick="recarregar()" class="mb-2 mr-2 usuario-img" id="recarregar" style="cursor: pointer;">
                        <img src="./images/icon-recarregar.png" alt="#" id='img-recarregar'>
                    </a>
                    <a class="mb-2 mr-2 usuario-img" onclick='limparInput()' id="limpar" style="cursor: pointer;">
                        <img src="./images/limpar.png" alt="#" id='img-recarregar'>
                    </a>
                    <div class="col-2 mb-2">
                        <p class="mb-1 text-muted">Ano:</p>
                        <input type="number" id="anoSelect" class="form-control" onchange="filtrar()" name="ano" placeholder="ex: 2023" min="2023" value="<?php echo $ano ?>">
                    </div>
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Unidade:</p>
                        <select id="unidadeSelect" onchange="filtrar()" class="form-select" name="unidade">
                            <option value="<?php echo empty($_GET['unidade']) ? '' : strtoupper($_GET['unidade']); ?>" hidden><?php echo empty($_GET['unidade']) ? 'Selecionar' : strtoupper($_GET['unidade']); ?></option>
                            <?php include 'query-unidades.php' ?>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <p class="mb-1 text-muted">Buscar:</p>
                        <input class="form-control" onchange="filtrar()" id="myInput" name="pesquisar" type="text" value="<?php echo isset($_GET['pesquisar']) ? htmlspecialchars($_GET['pesquisar']) : ''; ?>" placeholder="Procurar...">
                    </div>
                </div>
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
                            $desc = "$tipo $marca Modelo: $modelo";
                            $datatransf = explode(' ', $user_data['datatransf']);
                            $datatransf_brasil = implode('/', array_reverse(explode('-', $datatransf[0])));
                            echo "<tr>";
                            echo "<td style='cursor: pointer;'>{$user_data['patrimonio']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$user_data['nome']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$desc}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$user_data['localnovo']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$user_data['servidoratual']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$user_data['usuario']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>{$user_data['cimbpm']}<span hidden>todos</span></td>";
                            echo "<td style='cursor: pointer;'>" . $datatransf_brasil . '<br>' . $datatransf[1] . '<span hidden>todos</span>' . "</td>";
                            echo "</tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class='pagination-controls d-flex justify-content-between'>
                <input type="button" onclick="exportarArquivo('inventario')" value="Exportar" class="btn btn-outline-primary" style="margin-right: 940px; height:40px">
                <div class="d-flex flex-row">
                    <div class='records-per-page_inventario'>
                        <label for='recordsPerPage_inventario'>Registros por página:</label>
                        <select id='recordsPerPage_inventario' onchange="filtrar()">
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

                    $ano =  isset($_GET['ano']) ? $_GET['ano'] : '';
                    $unidade =  isset($_GET['unidade']) ? $_GET['unidade'] : '';
                    $pesquisar = isset($_GET['pesquisar']) ? $_GET['pesquisar'] : '';

                    echo "<a href='?page=" . ($page - 1) . '&limit=' . $limit . '&ano=' . $ano . '&unidade=' . $unidade . '&pesquisar=' . $pesquisar . "' class='arrow-button esquerda" . ($disabled_esquerda ? ' disabled' : '') . "' id='esquerda" . ($disabled_esquerda ? '-disabled' : '') . "' style='opacity: {$opacidade_esquerda}' {$disabled_esquerda} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></a>";
                    echo "<a href='?page=" . ($page + 1) . '&limit=' . $limit . '&ano=' . $ano . '&unidade=' . $unidade . '&pesquisar=' . $pesquisar . "' class='arrow-button direita" . ($disabled_direita ? ' disabled' : '') . "' id='direita" . ($disabled_direita ? '-disabled' : '') . "' style='opacity: {$opacidade_direita}' {$disabled_direita} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></a>";
                    ?>
                </div>
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

        var dataFormatada = `inventario-${dia}-${mes}-${ano}`;
        var nome;
        XLSX.writeFile(workbook, dataFormatada + '.XLSX');
        console.log(registros2);
    }


    function limparInput() {
        window.location.href = 'inventario.php?ano=2024';
    }

    function recarregar() {
        window.location.reload(true);
    }

    function filtrar() {
        var selectElement = document.getElementById('recordsPerPage_inventario');
        var selectedValue = selectElement.value;
        var ano = document.getElementById('anoSelect').value;
        var unidade = document.getElementById('unidadeSelect').value;
        var pesquisar = document.getElementById('myInput').value;
        localStorage.setItem('recordsPerPage_inventario', selectedValue);
        window.location.href = '?limit=' + selectedValue + '&ano=' + ano + '&unidade=' + unidade + '&pesquisar=' + pesquisar;
    }

    document.addEventListener('DOMContentLoaded', function() {
        var storedLimit = localStorage.getItem('recordsPerPage_inventario');
        if (storedLimit) {
            document.getElementById('recordsPerPage_inventario').value = storedLimit;
        }

        document.querySelectorAll('.arrow-button.disabled').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
            });
        });
    });
</script>