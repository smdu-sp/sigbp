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
                <a href="./termo.php" class="text-primary ms-1 carrossel-text">Usuários</a>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
        </div>
        <h3 class="mb-3 mt-4">Usuários</h3>
        <hr class="mb-4">
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <div class="mt-3">
                <p>Buscar:</p>
                <input class="form-control" id="myInput" type="text" placeholder="Procurar..">
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Primeiro Nome</th>
                            <th>Sobrenome</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <tr>
                            <td>João</td>
                            <td>Ninguém</td>
                            <td>joao@examplo.com</td>
                        </tr>
                        <tr>
                            <td>Maria</td>
                            <td>da Silva</td>
                            <td>maria@mail.com</td>
                        </tr>
                        <tr>
                            <td>Julio</td>
                            <td>Moscado</td>
                            <td>julio@grandescaras.com</td>
                        </tr>
                        <tr>
                            <td>Anjelina</td>
                            <td>Não Jolie</td>
                            <td>angel@sweet.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="hide" id="modal"></div>
</body>

</html>