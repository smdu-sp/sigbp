<?php
session_start();
include_once ('conexoes/config.php');
include_once ('header.php');
include_once ('verificacao.php');

$busca = "SELECT * FROM unidades ORDER BY id ASC";

// Número de registros por página
$recordsPerPage = 10;

// if ($_GET['atualizado'] === '1') {
//     echo "<script>alert('Unidade atualizada com sucesso!');</script>";
// }

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

$buscar_permisao = "SELECT permissao FROM usuarios WHERE `usuario`='" . strtolower($_SESSION['SesID']) . "';";
$query_usuario = mysqli_query($conexao, $buscar_permisao);
$row = mysqli_fetch_assoc($query_usuario);
$permissao = $row['permissao'];
if ($permissao != 1) {
    header('Location: home.php');
}
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
    include_once ('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo overflow">
        <div class="carrossel-box mb-4">
            <div class="carrossel">
                <a href="./unidades.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3"
                        alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./unidades.php" class="text-primary ms-1 carrossel-text">Unidades</a>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
        </div>
        <h2 class="mb-3 mt-4">Unidades</h2>
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <div>
                <div class="d-flex justify-content-end align-items-end">
                    <a href="#" onclick="recarregar()" class="mb-2 mr-2 usuario-img" id="recarregar"
                        style="cursor: pointer;">
                        <img src="./images/icon-recarregar.png" alt="#" id='img-recarregar'>
                    </a>
                    <a href="#" class="mb-2 mr-2 usuario-img" id="limpar" style="cursor: pointer;">
                        <img src="./images/limpar.png" alt="#" id='img-recarregar'>
                    </a>
                    <div class="col-2 ml-2 mb-2">
                        <p class="mb-1 text-muted">Status:</p>
                        <select id="statusSelect" class="form-select" aria-label="Default select example">
                            <option value="Ativo" selected>Ativo</option>
                            <option value="Inativo">Inativo</option>
                            <option value="todos">Todos</option>
                        </select>
                    </div>
                    <div class="col-2 mb-2">
                        <p class="mb-1 text-muted">Permissão:</p>
                        <select id="permissaoSelect" class="form-select" aria-label="Default select example">
                            <option value="1">Administrador</option>
                            <option value="2">Usuário</option>
                            <option value="3">Sem Permissão</option>
                            <option value="4" selected>Todos</option>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Unidade:</p>
                        <?php include_once ('listaUnidades.php'); ?>
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
                            <th>Nome</th>
                            <th>Sigla</th>
                            <th>Codigo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($user_data = mysqli_fetch_assoc($todos)) {

                            echo "<tr>";
                            echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>" . $user_data['unidades'] . "</td>";
                            echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>" . $user_data['sigla'] . "</td>";
                            echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>" . $user_data['codigo'] . "</td>";
                            $tipostatus = [
                                'Ativo',
                                'Inativo'
                            ];
                            echo $status = $user_data['statusunidade'] == 0 ? "ativo" : "inativo";
                            echo "<td style='cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>$status</td>";
                            // include_once('interruptor.php');
                            // echo "<td style='color: red; font-weight: bold; text-align: right'>" . 'a' . "</td>";                        
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
                        <option value='5'>5</option>
                        <option value='10' selected>10</option>
                        <option value='20'>20</option>
                    </select>
                </div>
                <div class='page-info'>Página 1 de 2</div>
                <?php
                echo "<a href='?pagina=$anterior' onclick='sort(1)' class='arrow-button esquerda' id='esquerda'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></a>";
                echo "<a href='?pagina=$proximo' onclick='sort(2)' class='arrow-button direita' id='direita'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></a>";
                ?>
            </div>

            <div class="d-flex justify-content-end mt-5 mr-2">
                <a href="./cadastrodeunidades.php" id="btn-adc-usuario">
                    <img src="./images/icons-adcUsuario.png" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="hide" id="modal"></div>
</body>
<script>
    $(document).ready(function () {
        function aplicarFiltros() {
            var inputValue = $("#myInput").val().toLowerCase();
            var unidadeValue = $("#unidadeSelect").val();
            var statusValue = $("#statusSelect").val();
            var permissaoValue = $("#permissaoSelect").val();

            $("#myTable tr").each(function (index) {
                if (index > 0) {
                    var row = $(this);
                    var textToShow = true;

                    if (inputValue) {
                        textToShow = textToShow && row.text().toLowerCase().indexOf(inputValue) > -1;
                    }

                    if (unidadeValue) {
                        textToShow = textToShow && row.text().indexOf(unidadeValue) > -1;
                    }

                    if (statusValue) {
                        textToShow = textToShow && row.text().indexOf(statusValue) > -1;
                    }

                    if (permissaoValue) {
                        if (permissaoValue == 1) {
                            textToShow = textToShow && row.text().indexOf('Administrador') > -1;
                        } else if (permissaoValue == 2) {
                            textToShow = textToShow && row.text().indexOf('Usuário') > -1;
                        } else if (permissaoValue == 3) {
                            textToShow = textToShow && row.text().indexOf('Sem permissão') > -1;
                        } else if (permissaoValue == 4) {
                            textToShow = textToShow && row.text().indexOf('todos') > -1;
                        }
                    }

                    row.toggle(textToShow);
                }
            });
        }

        $("#myInput, #unidadeSelect, #statusSelect, #permissaoSelect").on("change keyup", function () {
            aplicarFiltros();
        });

        function limparInputs() {
            $("#myInput").val('');
            $("#unidadeSelect").val('');
            $("#statusSelect").val('Ativo');
            $("#permissaoSelect").val('4');
            $("#myTable tr").show();
        }

        $("#limpar").on("click", function () {
            limparInputs();
        });
    });

    $(document).ready(function () {
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
        $('#recordsPerPage').change(function () {
            recordsPerPage = parseInt($(this).val());
            totalPages = Math.ceil(totalRecords / recordsPerPage);
            currentPage = 1;
            updateTable();
        });
    });
</script>

</html>