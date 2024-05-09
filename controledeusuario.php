<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('verificacao.php');

$sql = "SELECT * FROM usuarios ORDER BY id ASC";
$result = $conexao->query($sql) or die($mysqli->error);
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
                <table class="table">
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
                    <tbody id="myTable">
                        <?php
                        while ($user_data = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td hidden>" . $user_data['id'] . "</td>";
                            echo "<td>" . $user_data['nome'] . "</td>";
                            echo "<td>" . $user_data['email'] . "</td>";
                            echo "<td>" . $user_data['usuario'] . "</td>";
                            echo "<td>" . $user_data['unidade'] . "</td>";
                            echo "<td>";

                            if ($user_data['permissao'] == 1) {
                                echo "<div id='dev'><p class='perm-usuario'>Desenvolvedor</p></div>";
                            } elseif ($user_data['permissao'] == 2) {
                                echo "<div id='usuario'><p class='perm-usuario'>Usuário</p></div>";
                            } else {
                                echo "<div id='semPermissao'><p class='perm-usuario'>Sem permissão</p></div>";
                            }

                            echo "</td>";

                            echo "<td>" . "<a href='movimentacao.php?id=$user_data[id]'><img src='./images/icon-seta.png' alt='Seta'></a>"  . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-5 mr-2">
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
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

</html>