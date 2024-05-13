<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('verificacao.php');

$recordsPerPage = 5;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Offset para a consulta SQL
$offset = ($currentPage - 1) * $recordsPerPage;

// Consulta SQL modificada para incluir a cláusula LIMIT
$sql = "SELECT item.patrimonio, item.tipo, item.marca, item.modelo, item.nome, transferencia.cimbpm, transferencia.localnovo, transferencia.servidoratual, transferencia.usuario, transferencia.datatransf FROM item, transferencia WHERE item.idbem = transferencia.iditem ORDER BY transferencia.datatransf DESC";
$result = $conexao->query($sql) or die($mysqli->error);
$totalRecords = mysqli_num_rows($result);

// Número total de páginas
$totalPages = ceil($totalRecords / $recordsPerPage);

$buscar_permisao = "SELECT permissao FROM usuarios WHERE `usuario`='" . strtolower($_SESSION['SesID']) . "';";
$query_usuario = mysqli_query($conexao, $buscar_permisao);
$row = mysqli_fetch_assoc($query_usuario);
$permissao = $row['permissao'];
if ($permissao != 1) {
    header('Location: home.php');
}


$sql = "SELECT item.patrimonio, item.tipo, item.marca, item.modelo, item.nome, transferencia.cimbpm, transferencia.localnovo, transferencia.servidoratual, transferencia.usuario, transferencia.datatransf FROM item, transferencia WHERE item.idbem = transferencia.iditem ORDER BY transferencia.datatransf DESC";
$result = $conexao->query($sql) or die($mysqli->error);
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
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo overflow">
        <div class="carrossel-box mb-4">
            <div class="carrossel">
                <a href="./controledeusuario" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./cadastrodeusuario.php" class="text-primary ms-1 carrossel-text">Usuários</a>
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
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Unidade:</p>
                        <select id="unidadeSelect" class="form-select" aria-label="Default select example">
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
                    <div class="col-4 mb-2">
                        <p class="mb-1 text-muted">Buscar:</p>
                        <input class="form-control" id="myInput" type="text" placeholder="Procurar...">
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
                        <?php
                        while ($user_data = mysqli_fetch_assoc($result)) {
                            $marca = $user_data['marca'];
                            $modelo = $user_data['modelo'];
                            $tipo = $user_data['tipo'];
                            $desc = $tipo . ' ' . $marca . ' Modelo:' . $modelo;
                            echo "<tr>";
                            echo "<td style='cursor: pointer;'>" . $user_data['patrimonio'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $user_data['nome'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $user_data['marca'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td class='unidade' style='cursor: pointer;'>" . $user_data['tipo'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $user_data['modelo'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $desc . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $user_data['localnovo'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $user_data['usuario'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $user_data['cimbpm'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $user_data['datatransf'] . '<span hidden>todos</span>' . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class='pagination-controls'>
                <div class='records-per-page'>
                    <label for='recordsPerPage'>Registros por página:</label>
                    <select id='recordsPerPage'>
                        <option value='5'selected>5</option>
                        <option value='10' >10</option>
                        <option value='20'>20</option>
                    </select>
                </div>
                <div class='page-info'>Página 1 de 2</div>
                <button onclick='sort(1)' class='arrow-button esquerda' id='esquerda'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></button>
                <button onclick='sort(2)' class='arrow-button direita' id='direita'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></button>
            </div>
        </div>
    </div>
    <div class="hide" id="modal"></div>
</body>
<script>
    $(document).ready(function() {
        function aplicarFiltros() {
            var inputValue = $("#myInput").val().toLowerCase();
            var unidadeValue = $("#unidadeSelect").val();

            $("#myTable tr").each(function(index) {
                if (index > 0) {
                    var row = $(this);
                    var textToShow = true;

                    if (inputValue) {
                        textToShow = textToShow && row.text().toLowerCase().indexOf(inputValue) > -1;
                    }

                    if (unidadeValue) {
                        textToShow = textToShow && row.text().indexOf(unidadeValue) > -1;
                    }

                    row.toggle(textToShow);
                }
            });
        }

        $("#myInput, #unidadeSelect").on("change keyup", function() {
            aplicarFiltros();
        });

        function limparInputs() {
            $("#myInput").val('');
            $("#unidadeSelect").val('');
            $("#myTable tr").show();
        }

        $("#limpar").on("click", function() {
            limparInputs();
        });
    });

    $(document).ready(function() {
        var totalRecords = <?php echo $totalRecords; ?>;
        var recordsPerPage = <?php echo $recordsPerPage; ?>;
        var totalPages = Math.ceil(totalRecords / recordsPerPage);
        var currentPage = <?php echo $currentPage; ?>;
        function updateTable() {
            var start = (currentPage - 1) * recordsPerPage;
            var end = start + recordsPerPage;
            $('#myTable tbody tr').hide().slice(start, end).show();
            $('.page-info').text('Página ' + currentPage + ' de ' + totalPages);

            if (totalPages < 2) {
                var botaoEsquerda = document.getElementById('esquerda');
                var botaoDireita = document.getElementById('direita');
                botaoEsquerda.disabled = true;
                botaoDireita.disabled = true;
                botaoEsquerda.style.opacity = '0.5';
                botaoDireita.style.opacity = '0.5';
            } else {
                var botaoEsquerda = document.getElementById('esquerda');
                var botaoDireita = document.getElementById('direita');
                if (currentPage == 1) {
                    botaoEsquerda.disabled = true;
                    botaoEsquerda.style.opacity = '0.5';
                    botaoDireita.disabled = false;
                    botaoDireita.style.opacity = '1';
                } else if (currentPage == totalPages) {
                    botaoEsquerda.disabled = false;
                    botaoEsquerda.style.opacity = '1';
                    botaoDireita.disabled = true;
                    botaoDireita.style.opacity = '0.5';
                } else {
                    botaoEsquerda.disabled = false;
                    botaoDireita.disabled = false;
                }
            }
        }

        updateTable();

        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                updateTable();
            }
        }

        function nextPage() {
            if (currentPage < totalPages) {
                currentPage++;
                updateTable();
            }
        }

        $('.arrow-button:first').click(previousPage);
        $('.arrow-button:last').click(nextPage);
        $('#recordsPerPage').change(function() {
            recordsPerPage = parseInt($(this).val());
            totalPages = Math.ceil(totalRecords / recordsPerPage);
            currentPage = 1;
            updateTable();
        });
    });
</script>

</html>