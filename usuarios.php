<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

$sql_usuarios_count_query = "SELECT COUNT(*) as c FROM usuarios";
$sql_usuarios_count_query_exec = $conexao->query($sql_usuarios_count_query) or die($conexao->error);

$sql_usuarios_count = $sql_usuarios_count_query_exec->fetch_assoc();
$usuarios_count = $sql_usuarios_count['c'];

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$page_number = ceil($usuarios_count / $limit);

$busca = "SELECT * FROM usuarios ORDER BY id ASC";

$sql_usuarios_query = "$busca LIMIT {$limit} OFFSET {$offset}";
$sql_usuarios_query_exec = $conexao->query($sql_usuarios_query) or die($conexao->error);

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
<script>
                        function desativarUsuario(id) {
                            if (confirm("Tem certeza que deseja desativar este usuário?")) {
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "desativar_usuario.php", true);
                                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4 && xhr.status === 200) {
                                        // Manipular a resposta da requisição, se necessário
                                        console.log(xhr.responseText);
                                        // Recarregar a página ou fazer outras ações após desativar o usuário
                                        location.reload();
                                    }
                                };
                                xhr.send("id=" + id);
                            }
                        }
                        </script>
<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo overflow">
        <div class="carrossel-box mb-4">
            <div class="carrossel">
                <a href="./controledeusuario.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./controledeusuario.php" class="text-primary ms-1 carrossel-text">Usuários</a>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
        </div>
        <h2 class="mb-3 mt-4">Usuários</h2>
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <div>
                <div class="d-flex justify-content-end align-items-end">
                    <a href="#" onclick="recarregar()" class="mb-2 mr-2 usuario-img" id="recarregar" style="cursor: pointer;">
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
                        <select id="unidadeSelect" class="form-select" >
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Unidade</th>
                            <th scope="col">Permissão</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id='myTable'>
                        <?php
                        while ($user_data = $sql_usuarios_query_exec->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td hidden>" . $user_data['id'] . "</td>";
                            echo "<td style='cursor: pointer;' onclick=location.href='alteracaodeusuario.php?id=$user_data[id]'>" . $user_data['nome'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;' onclick=location.href='alteracaodeusuario.php?id=$user_data[id]'>" . $user_data['email'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;' onclick=location.href='alteracaodeusuario.php?id=$user_data[id]' hidden>" . $user_data['statususer'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td class='unidade' style='cursor: pointer;' onclick=location.href='alteracaodeusuario.php?id=$user_data[id]'>" . $user_data['usuario'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td style='cursor: pointer;' onclick=location.href='alteracaodeusuario.php?id=$user_data[id]'>" . $user_data['unidade'] . '<span hidden>todos</span>' . "</td>";
                            echo "<td id='permissao' style='cursor: pointer;' onclick=location.href='alteracaodeusuario.php?id=$user_data[id]'>";

                            if ($user_data['permissao'] == 1) {
                                echo "<div id='dev'><p class='perm-usuario'>Administrador<span hidden>todos</span></p></div>";
                            } elseif ($user_data['permissao'] == 2) {
                                echo "<div id='usuario'><p class='perm-usuario'>Usuário<span hidden>todos</span></p></div>";
                            } elseif ($user_data['permissao'] == 3) {
                                echo "<div id='semPermissao'><p class='perm-usuario'>Sem permissão<span hidden>todos</span></p></div>";
                            } else {
                                echo "<div id='todos'><p class='perm-usuario'>Todos<span hidden>todos</span></p></div>";
                            }

                            echo "</td>";
                            echo "<td>";
                            echo "<a class='x-image' id='tooltip2' href='#'><span id='tooltipText2'>Excluir</span><img class='img-usuario' src='./images/icons-x.png' alt='x'></a>";
                            echo "</td>";
                            echo "</tr>";
                            
                        }
                       
                        ?>

                    </tbody>
                </table>
            </div>
            <div class='pagination-controls'>
                <!-- <div class='records-per-page'>
                    <label for='recordsPerPage'>Registros por página:</label>
                    <select id='recordsPerPage' onchange="updateLimit()">
                        <option value='<?php echo $limit ?>' hidden> <?php echo $limit ?></option>
                        <option value='5'>5</option>
                        <option value='10'>10</option>
                    </select>
                </div> -->
                <div class='page-info'>Página <?php echo $page; ?> de <?php echo $page_number; ?></div>
                <?php
                $opacidade_esquerda = ($page == 1) ? '0.5' : '1';
                $opacidade_direita = ($page == $page_number) ? '0.5' : '1';
                $disabled_esquerda = ($opacidade_esquerda == '0.5') ? 'disabled' : '';
                $disabled_direita = ($opacidade_direita == '0.5') ? 'disabled' : '';

                echo "<a href='?page=" . ($page - 1) . "' class='arrow-button esquerda" . ($disabled_esquerda ? ' disabled' : '') . "' id='esquerda" . ($disabled_esquerda ? '-disabled' : '') . "' style='opacity: {$opacidade_esquerda}' {$disabled_esquerda} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></a>";
                echo "<a href='?page=" . ($page + 1) . "' class='arrow-button direita" . ($disabled_direita ? ' disabled' : '') . "' id='direita" . ($disabled_direita ? '-disabled' : '') . "' style='opacity: {$opacidade_direita}' {$disabled_direita} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></a>";

                ?>
            </div>
            <div class="d-flex justify-content-end mt-4 mr-2">
                <a href="./cadastrodeusuario.php" id="btn-adc-usuario">
                    <img src="./images/icons-adcUsuario.png" alt="">
                </a>
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
            $("#statusSelect").val('Ativo');
            $("#permissaoSelect").val('4');
            $("#myTable tr").show();
        }

        $("#limpar").on("click", function() {
            limparInputs();
        });
    });


    function updateLimit() {
        var selectElement = document.getElementById('recordsPerPage');
        var selectedValue = selectElement.value;
        window.location.href = '?limit=' + selectedValue;
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.arrow-button.disabled').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Impede a ação padrão do clique
            });
        });
    });

    function alert(num) {
        if (num == 1) {
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
                title: "Usuário alterado com sucesso!",
                background: 'green',
                iconColor: '#ffffff'
            });
        } else {
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
                title: "Usuário cadastrado com sucesso!",
                background: 'green',
                iconColor: '#ffffff'
            });
        }
    }
    window.addEventListener('load', function() {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var data = url.searchParams.get("notificacao");
        if (data == null) {
            return;
        } else if (data == 'alterado') {
            alert(1);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'http://localhost/usuario.php');
        } else if (data == 'cadastrado') {
            alert(2);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'http://localhost/listaremovimentar.php');
        }
    })
</script>

</html>