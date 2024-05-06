<?php
session_start();
include_once('./conexoes/config.php');
include_once('header.php');


$sql = "SELECT item.patrimonio, item.tipo, item.marca, item.modelo, item.nome, transferencia.cimbpm, transferencia.localnovo, transferencia.servidoratual, transferencia.usuario, transferencia.datatransf FROM item, transferencia WHERE item.idbem = transferencia.iditem ORDER BY transferencia.datatransf DESC";
$result = mysqli_query($conexao, $sql);
?>
<style>
    .conteudo {
        margin-left: 340px;
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
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel mb-4">
            <a href="./home.php" class="mb-3 me-1">
                <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
            </a>
            <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
            <a href="./termo.php" class="text-primary ms-1 carrossel-text">Home</a>
        </div>
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <table id="home" class="display table" style="width: 100%">
                <thead class="table-primary">
                    <th>Nº Patrimônio </th>
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
                    while ($user_data = mysqli_fetch_array($result)) {
                        $numPatrimonio = $user_data['patrimonio'];
                        $nome = $user_data['nome'];
                        $marca = $user_data['marca'];
                        $tipo = $user_data['tipo'];
                        $modelo = $user_data['modelo'];
                        $desc = $tipo . ' ' . $marca . ' Modelo:' . $modelo;
                        $localizacao = $user_data['localnovo'];
                        $servidor = $user_data['servidoratual'];
                        $usuario = $user_data['usuario'];
                        $cimbpm = $user_data['cimbpm'];
                        $data_transf = $user_data['datatransf'];
                    ?>
                        <tr>
                            <td scope="row"><?php echo $numPatrimonio ?>
                            <td><?php echo $nome ?></td>
                            <td><?php echo $desc ?></td>
                            <td><?php echo $localizacao ?></td>
                            <td><?php echo $servidor ?></td>
                            <td><?php echo $usuario ?></td>
                            <td><?php echo $cimbpm ?></td>
                            <td><?php echo $data_transf ?></td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
        <div class="hide" id="modal"></div>
</body>

</html>