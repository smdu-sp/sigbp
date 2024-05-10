<?php
session_start();
include_once('verificacao.php');
include_once('header.php');
include_once('./conexoes/config.php');

$sql = "SELECT * FROM unidades ORDER BY id ASC";
$result = $conexao->query($sql) or die($mysqli->error);

?>
<style>
    .table-container{
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 100px !important;
    }

    .conteudo {
        height: 100vh;
    }

    .icon-carrossel {
        width: 18px;
    }

    .icon-carrossel-i {
        width: 16px;
    }

    .carrossel>a {
        font-size: 15px;
    }

    .carrossel>a:hover {
        text-decoration: none;
    }

    .carrossel {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .carrossel-text {
        text-decoration: none;
    }

    .carrossel-text:hover {
        text-decoration: none;
    }

    .bnt-cadastrar{
        position: fixed;
        right: 150px;
        bottom: 150px;
    }


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
    .form-select{
        width:40%;
        display: flex;
        align-items: left;

    }
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 conteudo">
        <div class="carrossel mb-4">
            <a href="./home.php" class="mb-3 me-1">
                <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
            </a>
            <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
            <a href="./termo.php" class="text-primary ms-1 carrossel-text">Listar/Movimentar Bens</a>
        </div>
   
        <div class="conteudo ml-1 mt-4 table-container">
        <select class="form-select" aria-label="Default select example"display= flex;
        align-items="left" ;>
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
            </select>
            <table id="example" class="display table" style="width: 1400px;">
                <thead class="table-primary">
                    <tr>
                        <th>Nome</th>
                        <th>Sigla</th>
                        <th>Codigo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($user_data = mysqli_fetch_assoc($result)) {
                        
                        echo "<tr >";
                        echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='unidades.php?id=$user_data[id]'>" . $user_data['unidades'] . "</td>";
                        echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='unidades.php?id=$user_data[id]'>" . $user_data['sigla'] . "</td>";
                        echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='unidades.php?id=$user_data[id]'>" . $user_data['codigo'] . "</td>";
                        $tipostatus = [
                            'Ativo',
                            'Inativo'
                        ];
                        include_once('interruptor.php');
                        // echo "<td style='color: red; font-weight: bold; text-align: right'>" . 'a' . "</td>";                        
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="hide" id="modal"></div>
        <a type="button" class="btn btn-primary bnt-cadastrar" href="cadastrodeunidades.php">Cadastrar</a>
</body>
<script>
    function alert(num) {
        if(num == 1) {
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
                icon: "success",
                title: "Item movimentado com sucesso!"
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
                icon: "success",
                title: "Item alterado com sucesso!"
            });
            
        }
    }
    // alert();
    window.addEventListener('load', function() {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var data = url.searchParams.get("notificacao");
        console.log(data);
        if (data == null) {
            return;
        } else if (data == 1) {
            alert(1);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'http://localhost/listaremovimentar.php');
        } else {
            alert(2);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'http://localhost/listaremovimentar.php');
        }
    })
</script>
</html>