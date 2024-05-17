<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');

// Função para escapar entradas do usuário e prevenir SQL Injection
function escape_input($data) {
    global $conexao;
    return mysqli_real_escape_string($conexao, trim($data));
}

// Número de registros por página
$recordsPerPage = isset($_GET['recordsPerPage']) && is_numeric($_GET['recordsPerPage']) ? (int)$_GET['recordsPerPage'] : 6;

// Página atual
$currentPage = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

$inicio = ($currentPage - 1) * $recordsPerPage;

// Consulta SQL modificada para incluir a cláusula LIMIT
$busca = "SELECT item.patrimonio, item.tipo, item.marca, item.modelo, item.nome, transferencia.cimbpm, transferencia.localnovo, transferencia.servidoratual, transferencia.usuario, transferencia.datatransf FROM item, transferencia WHERE item.idbem = transferencia.iditem ORDER BY transferencia.datatransf DESC LIMIT $inicio, $recordsPerPage";

$limite = mysqli_query($conexao, $busca);

// Verificando se a consulta foi bem-sucedida
if (!$limite) {
    die('Erro na consulta: ' . mysqli_error($conexao));
}

// Contar o total de registros
$todos = mysqli_query($conexao, "SELECT COUNT(*) as total FROM item, transferencia WHERE item.idbem = transferencia.iditem");
$totalRecordsRow = mysqli_fetch_assoc($todos);
$totalRecords = $totalRecordsRow['total'];

$totalPages = ceil($totalRecords / $recordsPerPage);
$anterior = $currentPage > 1 ? $currentPage - 1 : 1;
$proximo = $currentPage < $totalPages ? $currentPage + 1 : $totalPages;

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
</style>

<body>
    <?php include_once('menu.php'); ?>
    <div class="p-4 p-md-4 pt-3 conteudo overflow">
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
            <div>
                <div class="d-flex justify-content-end align-items-end">
                    <a href="#" onclick="recarregar()" class="mb-2 mr-2 usuario-img" id="recarregar" style="cursor: pointer;">
                        <img src="./images/icon-recarregar.png" alt="#" id='img-recarregar'>
                    </a>
                    <a href="#" class="mb-2 mr-2 usuario-img" id="limpar" style="cursor: pointer;">
                        <img src="./images/limpar.png" alt="#" id='img-recarregar'>
                    </a>
                    <div class="col-5 mb-2"></div>
                    <div class="col-6 mb-2">
                        <form method="GET" action="">
                            <div class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputName2" class="mb-1 text-muted">Buscar:</label>
                                    <input class="form-control" name="search" type="text" placeholder="Procurar...">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <table class="table table-hover" id='myTable'>
                    <thead>
                        <tr>
                            <th scope="col">Nº Patrimônio </th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição do Bem</th>
                            <th scope="col">Localização</th>
                            <th scope="col">Servidor</th>
                            <th scope="col">Responsável</th>
                            <th scope="col">CIMBPM</th>
                            <th scope="col">Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user_data = mysqli_fetch_assoc($limite)) {
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
                    <select id='recordsPerPage' onchange="window.location.href = '?pagina=1&recordsPerPage=' + this.value;">
                        <option value='6' <?= $recordsPerPage == 6 ? 'selected' : '' ?>>6</option>
                        <option value='10' <?= $recordsPerPage == 10 ? 'selected' : '' ?>>10</option>
                        <option value='20' <?= $recordsPerPage == 20 ? 'selected' : '' ?>>20</option>
                    </select>
                </div>
                <div class='page-info'>Página <?= $currentPage ?> de <?= $totalPages ?></div>
                <?php if ($currentPage > 1): ?>
                    <a href='?pagina=<?= $anterior ?>&recordsPerPage=<?= $recordsPerPage ?>' class='arrow-button esquerda' id='esquerda'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></a>
                <?php endif; ?>
                <?php if ($currentPage < $totalPages): ?>
                    <a href='?pagina=<?= $proximo ?>&recordsPerPage=<?= $recordsPerPage ?>' class='arrow-button direita' id='direita'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="hide" id="modal"></div>
</body>
</html>
