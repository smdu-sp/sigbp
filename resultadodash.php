<?php
include_once('header.php');
?>

<body>
    <?php
    include_once('menu.php');
    include_once('./conexoes/conexao.php');

    $buscar_produtos = "SELECT COUNT(tipo) AS resultados_amplificador FROM item WHERE tipo='MICROCOMPUTADOR';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $totalamplificador = $row_pg['resultados_amplificador'];

    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel mb-2">
            <a href="./home.php" class="mb-3 me-1">
                <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
            </a>
            <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
            <a href="./cadastrarbens.php" class="text-primary ms-1 carrossel-text">Dashboard</a>
        </div>
        <div class="container d-flex justify-content-center ">
            <div class="card mb-3 me-3 rounded-0 shadow p-3 mb-5 bg-white rounded border-0">
                <div class="card-body d-flex flex-column">
                    <label for="card" class="form-label mt-1 text-primary">Selecione um Item:</label>
                    <input class="form-control mb-2" type="text" id="text-dash" >
                </div>
                <p class="card-text mb-3 mt-2 m-auto" style="font-size: 20px;"><strong class="mr-2">Total:</strong>
                    <?php echo "<span>$totalamplificador</span>" ?></p>
            </div>
        </div>
    </div>
</body>