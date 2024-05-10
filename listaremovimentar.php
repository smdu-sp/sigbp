<?php
    session_start();
    include_once('verificacao.php');
    include_once('header.php');
    include_once('./conexoes/config.php');

    $buscar_permisao = "SELECT permissao FROM usuarios WHERE `usuario`='" . strtolower($_SESSION['SesID']) . "';";
    $query_usuario = mysqli_query($conexao, $buscar_permisao);
    $row = mysqli_fetch_assoc($query_usuario);
    $permissao = $row['permissao'];
    if ($permissao != 1) {
        header('Location: home.php');
    }


    $sql = "SELECT * FROM item ORDER BY idbem ASC";
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
</style>
<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo overflow">
        <div class="carrossel-box mb-4">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1">
                    <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
                </a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./termo.php" class="text-primary ms-1 carrossel-text">Listar/Movimentar Bens</a>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
        </div>
        <div class="conteudo conteudo-table ml-1 mt-4 table-container" style="width: 1500px;">
            <table id="example" class="display table" style="width: 100%;">
                <thead class="table-primary">
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
                <tbody>
                    <?php
                    while ($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td hidden>" . $user_data['idbem'] . "</td>";
                        echo "<td>" . $user_data['patrimonio'] . "</td>";
                        echo "<td>" . $user_data['nome'] . "</td>";
                        echo "<td>" . $user_data['marca'] . "</td>";
                        echo "<td>" . $user_data['tipo'] . "</td>";
                        echo "<td>" . $user_data['descsbpm'] . "</td>";
                        echo "<td>" . $user_data['modelo'] . "</td>";
                        echo "<td>" . $user_data['numserie'] . "</td>";
                        echo "<td>" . $user_data['localizacao'] . "</td>";
                        echo "<td>" . $user_data['servidor'] . "</td>";
                        echo "<td>" . $user_data['numprocesso'] . "</td>";
                        echo "<td>" . $user_data['cimbpm'] . "</td>";
                        echo "<td>" . $user_data['statusitem'] . "</td>";
                        echo "<td>" . "<a href='movimentacao.php?id=$user_data[idbem]'><img src='./images/icon-seta.png' alt='Seta'></a>" . "<a href='alteracaodebens.php?id=$user_data[idbem]'><img src='./images/icon-lapis.png' alt='Seta'></a>" . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="hide" id="modal"></div>
</body>
<script>
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
                title: "Item movimentado com sucesso!",
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
                title: "Item alterado com sucesso!",
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
            } else if (data == 1) {
                alert(1);
                window.history.replaceState({}, document.title, window.location.pathname);
                history.pushState({}, '', 'listaremovimentar.php');
            } else {
                alert(2);
                window.history.replaceState({}, document.title, window.location.pathname);
                history.pushState({}, '', 'listaremovimentar.php');
            }
        })
</script>

</html>