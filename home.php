<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('verificacao.php');



$sql = "SELECT item.patrimonio, item.tipo, item.marca, item.modelo, item.nome, transferencia.cimbpm, transferencia.localnovo, transferencia.servidoratual, transferencia.usuario, transferencia.datatransf FROM item, transferencia WHERE item.idbem = transferencia.iditem ORDER BY transferencia.datatransf DESC";
$result = mysqli_query($conexao, $sql);
?>
<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo overflow">
        <div class="carrossel-box mb-4">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./termo.php" class="text-primary ms-1 carrossel-text">Home</a>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
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