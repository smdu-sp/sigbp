<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');

$busca = "SELECT item.patrimonio, item.tipo, item.marca, item.modelo, item.nome, transferencia.cimbpm, transferencia.localnovo, transferencia.servidoratual, transferencia.usuario, transferencia.datatransf FROM item, transferencia WHERE item.idbem = transferencia.iditem ORDER BY transferencia.datatransf DESC";

// Número de registros por página
$recordsPerPage = 6;

// Página atual
if (isset($_GET['pagina']) && is_numeric($_GET['pagina'])) {
    $currentPage = $_GET['pagina'];
} else {
    $currentPage = 1;
}

$inicio = ($currentPage - 1) * $recordsPerPage;

// Consulta SQL modificada para incluir a cláusula LIMIT
$limite = mysqli_query($conexao, "$busca LIMIT $inicio,$recordsPerPage");
$todos = mysqli_query($conexao, "$busca");

// Contar o total de registros
$totalRecords = mysqli_num_rows($todos);

$tr = $totalRecords;
$tp = $tr / $recordsPerPage;

$anterior = $currentPage - 1;
$proximo = $currentPage + 1;

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
                    <div class="col-5 mb-2">       
                        <!-- <p class="mb-1 text-muted">Unidade:</p> -->
                        <!-- <select id="unidadeSelect" class="form-select" aria-label="Default select example">
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
                        </select>                         -->
                    </div>
                    <div class="col-6 mb-2">
                        <div class="form-inline">
                            <div class="form-group">
                                <label for="exampleInputName2" class="mb-1 text-muted">Buscar:</label>
                                <input class="form-control" id="myInput" type="text" placeholder="Procurar...">
                            </div>
                        </div>
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
                        while ($user_data = mysqli_fetch_assoc($todos)) {
                            $marca = $user_data['marca'];
                            $modelo = $user_data['modelo'];
                            $tipo = $user_data['tipo'];
                            $desc = $tipo . ' ' . $marca . ' Modelo:' . $modelo;
                            echo "<tr>";
                            echo "<td style='cursor: pointer;'>" . $user_data['patrimonio'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $user_data['nome'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $desc . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $user_data['localnovo'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;'>" . $user_data['servidoratual'] . '<span hidden>todos</span>' . "</td>";
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
                        <option value='6' selected>6</option>
                        <option value='10'>10</option>
                        <option value='20'>20</option>
                    </select>
                </div>
                <div class='page-info'>Página 1 de 2</div>
                <?php
                echo "<a href='?pagina=$anterior' onclick='sort(1)' class='arrow-button esquerda' id='esquerda'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></a>";
                echo "<a href='?pagina=$proximo' onclick='sort(2)' class='arrow-button direita' id='direita'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></a>";
                ?>
            </div>
        </div>
    </div>
    <div class="hide" id="modal"></div>
</body>
<script>
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