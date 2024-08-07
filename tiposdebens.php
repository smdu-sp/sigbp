<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

$status = isset($_GET['statustipos']) ? $_GET['statustipos'] : 'Ativo';

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
            $result = mysqli_query($conexao, "INSERT INTO tipos(tipo, statustipo) VALUES ('$tipo', 'Ativo')");

            header("Location: tiposdebens.php?tipo=cadastrado");
        }
    }
}

if (isset($_POST['update'])) {
    $tipo = $_POST['tipos'];

    $result = mysqli_query($conexao, "UPDATE tipos SET tipo = '$tipo', statustipo = 'Inativo' WHERE tipo='$tipo'");

    header("Location: tiposdebens.php?tipo=alterado");
}

if (isset($_POST['reativar'])) {
    $tipo = $_POST['tipos'];

    $result = mysqli_query($conexao, "UPDATE tipos SET tipo = '$tipo', statustipo = 'Ativo' WHERE tipo='$tipo'");

    header("Location: tiposdebens.php?tipo=reativado");
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

    #btnDesCadTipos {
        display: none;
    }


    #btnRCadTipos {
        display: none;
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
                <a href="./tiposdebens.php" class="text-primary ms-1 carrossel-text">Tipos de Bens</a></li>
            </div>
        </div>
        <h2 class="mb-4">Tipos de Bens</h2>
        <div class="container d-flex justify-content-center">
            <div class="card mb-3 me-3 rounded-0 shadow p-3 mb-5 bg-white rounded border-0">
                <form action="tiposdebens.php" method="POST">
                    <div class="card-body d-flex flex-column" style="width: 800px; height: 700px">
                        <label for="card" class="form-label mt-1 text-primary mb-2">Cadastrar um Tipo:</label>
                        <input class="form-control mb-2" type="text" id="textBusca2" name="tipos">
                        <div class="d-flex justify-content-end mt-1 mb-1" id="bnt ">
                            <input type="submit" class="btn btn-danger mr-1" id="btnDesCadTipos" name="update" value="Desativar" style="width: 90px;"></input>
                            <input type="submit" class="btn btn-primary" id="btnCadTipos" name="submit" value="Cadastrar"></input>
                            <input type="submit" class="btn btn-primary" id="btnRCadTipos" name="reativar" value="Reativar"></input>
                        </div>
                </form>
                <div class="d-flex align-items-baseline">
                    <label for="card" class="form-label text-primary mb-2 mr-2">Todos os tipos de bens ativos:</label>
                    <select class="form-select" onchange="mudou()" name="tipo" id="AITipos" required style="width: 100px; border: none; outline: none;">
                        <option value="<?php echo isset($_GET['statustipos']) ? $_GET['statustipos'] : 'Ativo'; ?>" hidden>
                            <?php echo isset($_GET['statustipos']) ? $_GET['statustipos'] : 'Ativo'; ?>
                        </option>
                        <option value="ATIVO">ATIVO</option>
                        <option value="INATIVO">INATIVO</option>
                    </select>

                </div>
                <div class="card lista-itens mb-2">
                    <ul class="list-group list-group-flush overflow-auto" id="ulItens" style="height: 500px;">
                        <?php
                        include 'query-tipos-bens.php';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="hide" id="modal"></div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function updateURLParameter() {
        const select = document.getElementById('AITipos');
        const selectedValue = select.value;
        const url = new URL(window.location);
        url.searchParams.set('statustipos', selectedValue);
        history.pushState(null, '', url.toString());

        $.ajax({
            url: 'query-tipos-bens.php',
            type: 'GET',
            data: {
                statustipos: selectedValue
            },
            success: function(response) {
                $('#ulItens').html(response);
            },
            error: function(xhr) {
                console.log('Erro ao buscar os dados: ' + xhr.status + ' ' + xhr.statusText);
            }
        });

        var url_string = window.location.href;
        var url_nova = new URL(url_string);
        var data = url.searchParams.get("statustipos");
        var textBusca = document.getElementById('textBusca2');
        var buttonCad = document.getElementById('btnCadTipos');
        var buttonReativar = document.getElementById('btnRCadTipos');
        var buttonTrocar = document.getElementById('btnDesCadTipos');
        if(data == 'ATIVO') {
            textBusca.value = '';
            buttonCad.style.display = 'block';
            buttonTrocar.style.display = 'block';
            buttonReativar.style.display = 'none'
        } else {
            textBusca.value = '';
            buttonReativar.style.display = 'block';
            buttonCad.style.display = 'none';
            buttonTrocar.style.display = 'none'
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('AITipos');
        select.addEventListener('change', updateURLParameter);
    });

    function botaoClicado(item) {
        var select = document.getElementById('AITipos').value;
        var textBusca = document.getElementById('textBusca2');
        textBusca.value = item;
    }

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
                title: "Tipo de Bem já cadastrado!",
                titleColor: '#ffffff',
                background: 'red',
                iconColor: '#ffffff'
            });
        } else if (num == 2) {
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
                title: "Novo tipo de bem cadastrado com sucesso!",
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
                icon: "warning",
                title: "Por favor, insira um tipo válido!",
                background: "#104EEF",
                iconColor: '#ffffff'
            });
        } else if (num == 4 || num == 5) {
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
                title: "Tipo de bem alterado com sucesso!",
                background: 'green',
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
        } else if (data == 'alterado') {
            alert(4);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'tiposdebens.php');
        } else if (data == 'reativado') {
            alert(5);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'tiposdebens.php');
        }
    })

    function toUpperCase(event) {
        event.target.value = event.target.value.toUpperCase();
    }
    const inputTipo = document.getElementById('textBusca2');
    inputTipo.addEventListener('input', toUpperCase);
</script>

</html>