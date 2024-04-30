<?php
include_once('header.php');
?>

<body>
    <?php
    include_once('menu.php');
    include_once('./conexoes/conexao.php');

    $item = $_GET['inputText'];

    $buscar_produtos = "SELECT COUNT(tipo) AS resultadosItem FROM item WHERE tipo='$item';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $totalItem = $row_pg['resultadosItem'];

    ?>
    <div class="p-4 p-md-4 pt-3 conteudo overflow-y">
        <div class="carrossel mb-2">
            <a href="./home.php" class="mb-3 me-1">
                <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
            </a>
            <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
            <a href="./cadastrarbens.php" class="text-primary ms-1 carrossel-text">Dashboard</a>
        </div>
        <div class="container d-flex justify-content-center ">
            <div class="card mb-3 me-3 rounded-0 shadow p-3 mb-5 bg-white rounded border-0">
                <div class="card-body d-flex flex-column" style="width: 450px;">
                    <label for="card" class="form-label mt-1 text-primary">Item selecionado:</label>
                    <input class="form-control mb-2" type="text" id="textResultado" readonly>
                </div>
                <p class="card-text mb-3 mt-2 m-auto" style="font-size: 20px;"><strong class="mr-2">Total:</strong>
                    <?php echo "<span>$totalItem</span>" ?></p>
            </div>
        </div>
        <div class="container text-center overflow-auto">
            <div class="row mb-3">
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>GABINETE(total: 352)</strong></li>
                        <li class="list-group-item">ASCOM: 10</li>
                        <li class="list-group-item">ATECC: 34</li>
                        <li class="list-group-item">ATIC: 245</li>
                        <li class="list-group-item">GAB: 52</li>
                        <li class="list-group-item">STEL: 11</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CAF(total: 83)</strong></li>
                        <li class="list-group-item">CAF-G: 29</li>
                        <li class="list-group-item">DGP: 30</li>
                        <li class="list-group-item">DLC: 7</li>
                        <li class="list-group-item">DOF: 9</li>
                        <li class="list-group-item">DSUP: 8</li>
                        <li class="list-group-item">AUDITÓRIO: 0</li>
                        <li class="list-group-item">ALMOXARIFCADO: 0</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CAP(total: 60)</strong></li>
                        <li class="list-group-item">CAP-G: 31</li>
                        <li class="list-group-item">ARTHUR SABOYA: 1</li>
                        <li class="list-group-item">DEPROT: 9</li>
                        <li class="list-group-item">DPCI: 17</li>
                        <li class="list-group-item">DPD: 2</li>
                        <li class="list-group-item">NÚCLEO: 0</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CASE(total: )</strong></li>
                        <li class="list-group-item">CASE-G: 28</li>
                        <li class="list-group-item">DCAD: 14</li>
                        <li class="list-group-item">DDU: 7</li>
                        <li class="list-group-item">DLE: 17</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CEPEUC(total: )</strong></li>
                        <li class="list-group-item">CEPEUC: 25</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>COMIN(total: )</strong></li>
                        <li class="list-group-item">COMIN-G: 26</li>
                        <li class="list-group-item">DCIGP: 0</li>
                        <li class="list-group-item">DCIMP: 4</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CONTRU(total: )</strong></li>
                        <li class="list-group-item">CONTRU-G: 2</li>
                        <li class="list-group-item">DACESS: 3</li>
                        <li class="list-group-item">DINS: 4</li>
                        <li class="list-group-item">DLR: 3</li>
                        <li class="list-group-item">DSUS: 3</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>DEUSO(total: )</strong></li>
                        <li class="list-group-item">DEUSO-G: 41</li>
                        <li class="list-group-item">DMUS: 1</li>
                        <li class="list-group-item">DNUS: 1</li>
                        <li class="list-group-item">DSIZ: 1</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row mb-3">
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>GABINETE(total: 352)</strong></li>
                        <li class="list-group-item">ASCOM: 10</li>
                        <li class="list-group-item">ATECC: 34</li>
                        <li class="list-group-item">ATIC: 245</li>
                        <li class="list-group-item">And a fifth one</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CAF(total: 83)</strong></li>
                        <li class="list-group-item">CAF-G: 29</li>
                        <li class="list-group-item">DGP: 30</li>
                        <li class="list-group-item">DLC: 7</li>
                        <li class="list-group-item">DOF: 9</li>
                        <li class="list-group-item">DSUP: 8</li>
                        <li class="list-group-item">AUDITÓRIO: 0</li>
                        <li class="list-group-item">ALMOXARIFCADO: 0</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CAP(total: 60)</strong></li>
                        <li class="list-group-item">CAP-G: 31</li>
                        <li class="list-group-item">ARTHUR SABOYA: 1</li>
                        <li class="list-group-item">DEPROT: 9</li>
                        <li class="list-group-item">DPCI: 17</li>
                        <li class="list-group-item">DPD: 2</li>
                        <li class="list-group-item">NÚCLEO: 0</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CASE(total: )</strong></li>
                        <li class="list-group-item">CASE-G: 28</li>
                        <li class="list-group-item">DCAD: 14</li>
                        <li class="list-group-item">DDU: 7</li>
                        <li class="list-group-item">DLE: 17</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CEPEUC(total: )</strong></li>
                        <li class="list-group-item">CEPEUC: 25</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>COMIN(total: )</strong></li>
                        <li class="list-group-item">COMIN-G: 26</li>
                        <li class="list-group-item">DCIGP: 0</li>
                        <li class="list-group-item">DCIMP: 4</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CONTRU(total: )</strong></li>
                        <li class="list-group-item">CONTRU-G: 2</li>
                        <li class="list-group-item">DACESS: 3</li>
                        <li class="list-group-item">DINS: 4</li>
                        <li class="list-group-item">DLR: 3</li>
                        <li class="list-group-item">DSUS: 3</li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>DEUSO(total: )</strong></li>
                        <li class="list-group-item">DEUSO-G: 41</li>
                        <li class="list-group-item">DMUS: 1</li>
                        <li class="list-group-item">DNUS: 1</li>
                        <li class="list-group-item">DSIZ: 1</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const valorItem = urlParams.get("inputText");
    console.log(valorItem);

    document.getElementById('textResultado').value = valorItem;
</script>