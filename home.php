<?php
session_start(  );
include_once ('./conexoes/config.php');
include_once ('header.php');
print_r($_POST);
 
$sql = "SELECT * FROM transferencia ORDER BY iditem ASC";
$result  = $conexao->query($sql) or die($conexao->error);
?>
<style>
     .conteudo {
        margin-left: 285px;
        flex-wrap: wrap;
        width: 81%;
        height: 90%;
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

    @media (max-width: 1600px) {
        .conteudo {
            margin-left: 75px;
        }

        .menu-principal {
            position: fixed;
            top: 0;
            left: -187px;
            z-index: 999999 !important;
            transition: all 1s ease;
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
    include_once ('menu.php');
 
    if($_SESSION['Perm'] == 1) {
        echo '<script>alert("Usuario invalido!");</script>';
        return;
    }
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel mb-4">
            <a href="./home.php" class="mb-3 me-1">
                <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
            </a>
            <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
            <a href="./termo.php" class="text-primary ms-1 carrossel-text">Listar/Movimentar Bens</a>
        </div>
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <table id="example" class="display table" style="width: 100%">
                <thead class="table-primary">
                        <th>Nº Patrimônio  </th>
                        <th>Nome</th>
                        <th>Descrição do Bem</th>
                        <th>Localização</th>
                        <th>Servidor</th>
                        <th>Responsável</th>
                        <th>CIMBPM:</th>
                        <th>Data</th>
                    </tr>
                </thead>
               
                <tbody>
                <?php
                    while ($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . '*' . "</td>";
                        echo "<td>" . '*' . "</td>";
                        echo "<td>" . '*' . "</td>";
                        echo "<td>" . $user_data['localnovo'] . "</td>";
                        echo "<td>" . $user_data['servidoratual'] . "</td>";
                        echo "<td>" . $user_data['usuario'] . "</td>";
                        echo "<td>" . $user_data['cimbpm'] . "</td>";
                        if ($user_data['datatransf']) {
                            $teste = explode('-', $user_data['datatransf']);
                            $data = $teste[2] . '/' .$teste[1] . '/' .$teste[0];
                            echo "<td>" . $data . "</td>";
                        } else{
                            echo "<td> NaN </td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
                   
        </div>
       
        <div class="hide" id="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </div>
    </div>
</body>
 
</html>