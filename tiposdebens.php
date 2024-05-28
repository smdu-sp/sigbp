<?php
session_start();
include('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');



if (isset($_POST['submit'])) {
    $tipo = $_POST['tipos'];
    
    if ($tipo == '') {
        header("Location: tiposdebens.php?tipo=campoVazio");
    } else {
        $query = "SELECT COUNT(*) FROM tipos WHERE tipo = '$tipo'";
        $result = mysqli_query($conexao, $query);
        $row = mysqli_fetch_array($result);
        
        if ($row[0] > 0) {
            header("Location: tiposdebens.php?tipo=jaCadastrado");
        } else {
            $result = mysqli_query($conexao, "INSERT INTO tipos(tipo) VALUES ('$tipo')");

            header("Location: tiposdebens.php?tipo=cadastrado");
        }
    }
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
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel-box mb-2">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1">
                    <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
                </a></li>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./dashboard.php" class="text-primary ms-1 carrossel-text">Tipos de Bens</a></li>
            </div>
            <!-- <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div> -->
        </div>
        <h2 class="mb-4">Tipos de Bens</h2>
        <div class="container d-flex justify-content-center">
            <div class="card mb-3 me-3 rounded-0 shadow p-3 mb-5 bg-white rounded border-0">
                <form action="tiposdebens.php" method="POST">
                    <div class="card-body d-flex flex-column" style="width: 800px; height: 700px">
                        <label for="card" class="form-label mt-1 text-primary mb-2">Cadastrar um Tipo:</label>
                        <input class="form-control mb-2" type="text" id="textBusca2" name="tipos">
                        <div class="d-flex justify-content-end mt-1 mb-1" id="bnt ">
                            <input type="submit" class="btn btn-primary" id="btnCadTipos" name="submit" value="Cadastrar"></input>
                        </div>
                </form>
                <label for="card" class="form-label text-muted mb-2">Todos os tipos de bens:</label>
                <div class="card lista-itens">
                    <ul class="list-group list-group-flush overflow-auto" id="ulItens" style="height: 500px;">
                        <?php
                        include 'query-tipos-dashboard.php';
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
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
                icon: "error",
                title: "Produto já cadastrado!",
                titleColor: '#ffffff',
                background: 'red',
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
                icon: "warning",
                title: "Por favor, insira um tipo válido",
                background: "#104EEF",
                iconColor: '#ffffff'
            });
        }
    }

    window.addEventListener('load', function() {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var data = url.searchParams.get("tipo");
        if (data == 'jaCadastrado') {
            alert(1);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'tiposdebens.php');
        } else if (data == 'cadastrado') {
            alert(2);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'tiposdebens.php');
        } else if (data == 'campoVazio') {
            alert(3);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'tiposdebens.php');
        }
    })
</script>

</html>