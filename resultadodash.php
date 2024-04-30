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

    $buscar_produtos = "SELECT COUNT(idbem) AS ascom FROM item WHERE tipo = '$item' AND localizacao = 'ASCOM';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $ascom = ceil($row_pg['ascom']);

    $buscar_produtos = "SELECT COUNT(idbem) AS atecc FROM item WHERE tipo = '$item' AND localizacao = 'ATECC';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $atecc = ceil($row_pg['atecc']);

    $buscar_produtos = "SELECT COUNT(idbem) AS atic FROM item WHERE tipo = '$item' AND localizacao = 'ATIC';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $atic = ceil($row_pg['atic']);

    $buscar_produtos = "SELECT COUNT(idbem) AS gab FROM item WHERE tipo = '$item' AND localizacao = 'GAB';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $gab = ceil($row_pg['gab']);

    $buscar_produtos = "SELECT COUNT(idbem) AS stel FROM item WHERE tipo = '$item' AND localizacao = 'STEL';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $stel = ceil($row_pg['stel']);

    $gabinete = $ascom + $atecc + $atic + $gab + $stel;

    $buscar_produtos = "SELECT COUNT(idbem) AS caf_g FROM item WHERE tipo = '$item' AND localizacao = 'CAF';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $caf_g = ceil($row_pg['caf_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dgp FROM item WHERE tipo = '$item' AND localizacao = 'DGP';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dgp = ceil($row_pg['dgp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dlc FROM item WHERE tipo = '$item' AND localizacao = 'DLC';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dlc = ceil($row_pg['dlc']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dof FROM item WHERE tipo = '$item' AND localizacao = 'DOF';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dof = ceil($row_pg['dof']);

    $buscar_produtos = "SELECT COUNT(idbem) AS gabinete FROM item WHERE tipo = '$item' AND localizacao = 'GABINETE';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $a = ceil($row_pg['gabinete']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsup FROM item WHERE tipo = '$item' AND localizacao = 'DSUP';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsup = ceil($row_pg['dsup']);

    $buscar_produtos = "SELECT COUNT(idbem) AS auditorio FROM item WHERE tipo = '$item' AND localizacao = 'AUDITORIO';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $auditorio = ceil($row_pg['auditorio']);

    $buscar_produtos = "SELECT COUNT(idbem) AS almoxarifado FROM item WHERE tipo = '$item' AND localizacao = 'ALMOXARIFADO';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $almoxarifado = ceil($row_pg['almoxarifado']);

    $caf = $caf_g + $dgp + $dlc + $dof + $dsup + $auditorio + $almoxarifado;

    $buscar_produtos = "SELECT COUNT(idbem) AS cap_g FROM item WHERE tipo = '$item' AND localizacao = 'CAP';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $cap_g = ceil($row_pg['cap_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS gabinete FROM item WHERE tipo = '$item' AND localizacao = 'GABINETE';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $a = ceil($row_pg['gabinete']);

    $buscar_produtos = "SELECT COUNT(idbem) AS arthur FROM item WHERE tipo = '$item' AND localizacao = 'ARTHUR SABOYA';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $arthur = ceil($row_pg['arthur']);

    $buscar_produtos = "SELECT COUNT(idbem) AS deprot FROM item WHERE tipo = '$item' AND localizacao = 'DEPROT';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $deprot = ceil($row_pg['deprot']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dpci FROM item WHERE tipo = '$item' AND localizacao = 'DPCI';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dpci = ceil($row_pg['dpci']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dpd FROM item WHERE tipo = '$item' AND localizacao = 'DPD';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dpd = ceil($row_pg['dpd']);

    $buscar_produtos = "SELECT COUNT(idbem) AS nucleo FROM item WHERE tipo = '$item' AND localizacao = 'NUCLEO';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $nucleo = ceil($row_pg['nucleo']);

    $cap = $cap_g + $arthur + $deprot + $dpci + $dpd + $nucleo;

    $buscar_produtos = "SELECT COUNT(idbem) AS case_g FROM item WHERE tipo = '$item' AND localizacao = 'CASE';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $case_g = ceil($row_pg['case_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dcad FROM item WHERE tipo = '$item' AND localizacao = 'DCAD';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dcad = ceil($row_pg['dcad']);

    $buscar_produtos = "SELECT COUNT(idbem) AS ddu FROM item WHERE tipo = '$item' AND localizacao = 'DDU';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $ddu = ceil($row_pg['ddu']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dle FROM item WHERE tipo = '$item' AND localizacao = 'DLE';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dle = ceil($row_pg['dle']);

    $case = $case_g + $dcad + $ddu + $dle;

    $buscar_produtos = "SELECT COUNT(idbem) AS cepeuc FROM item WHERE tipo = '$item' AND localizacao = 'CEPEUC';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $cepeuc = ceil($row_pg['cepeuc']);

    $buscar_produtos = "SELECT COUNT(idbem) AS comin_g FROM item WHERE tipo = '$item' AND localizacao = 'COMIN';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $comin_g = ceil($row_pg['comin_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dcigp FROM item WHERE tipo = '$item' AND localizacao = 'DCIGP';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dcigp = ceil($row_pg['dcigp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dcimp FROM item WHERE tipo = '$item' AND localizacao = 'DCIMP';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dcimp = ceil($row_pg['dcimp']);

    $comin = $comin_g + $dcigp + $dcimp;

    $buscar_produtos = "SELECT COUNT(idbem) AS contru_g FROM item WHERE tipo = '$item' AND localizacao = 'CONTRU';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $contru_g = ceil($row_pg['contru_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dacess FROM item WHERE tipo = '$item' AND localizacao = 'DACESS';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dacess = ceil($row_pg['dacess']);
    
    $buscar_produtos = "SELECT COUNT(idbem) AS dins FROM item WHERE tipo = '$item' AND localizacao = 'DINS';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dins = ceil($row_pg['dins']);
    
    $buscar_produtos = "SELECT COUNT(idbem) AS dlr FROM item WHERE tipo = '$item' AND localizacao = 'DLR';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dlr = ceil($row_pg['dlr']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsus FROM item WHERE tipo = '$item' AND localizacao = 'DSUS';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsus = ceil($row_pg['dsus']);

    $contru = $contru_g + $dacess + $dins + $dlr + $dsus;

    $buscar_produtos = "SELECT COUNT(idbem) AS deuso_g FROM item WHERE tipo = '$item' AND localizacao = 'DEUSO';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $deuso_g = ceil($row_pg['deuso_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dmus FROM item WHERE tipo = '$item' AND localizacao = 'DMUS';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dmus = ceil($row_pg['dmus']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dnus FROM item WHERE tipo = '$item' AND localizacao = 'DNUS';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dnus = ceil($row_pg['dnus']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsiz FROM item WHERE tipo = '$item' AND localizacao = 'DSIZ';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsiz = ceil($row_pg['dsiz']);

    $deuso = $deuso_g + $dmus + $dnus + $dsiz;

    $buscar_produtos = "SELECT COUNT(idbem) AS geoinfo FROM item WHERE tipo = '$item' AND localizacao = 'GEOINFO';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $geoinfo = ceil($row_pg['geoinfo']);

    $buscar_produtos = "SELECT COUNT(idbem) AS gtec FROM item WHERE tipo = '$item' AND localizacao = 'GTEC';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $gtec = ceil($row_pg['gtec']);
    
    $buscar_produtos = "SELECT COUNT(idbem) AS parhis_g FROM item WHERE tipo = '$item' AND localizacao = 'PARHIS';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $parhis_g = ceil($row_pg['parhis_g']);

    
    $buscar_produtos = "SELECT COUNT(idbem) AS dhis FROM item WHERE tipo = '$item' AND localizacao = 'DHIS';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dhis = ceil($row_pg['dhis']);
    
    $buscar_produtos = "SELECT COUNT(idbem) AS dhmp FROM item WHERE tipo = '$item' AND localizacao = 'DHMP';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dhmp = ceil($row_pg['dhmp']);
    
    $buscar_produtos = "SELECT COUNT(idbem) AS dps FROM item WHERE tipo = '$item' AND localizacao = 'DPS';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dps = ceil($row_pg['dps']);
    
    $parhis = $parhis_g + $dhis + $dhmp + $dps;

    $buscar_produtos = "SELECT COUNT(idbem) AS planurb FROM item WHERE tipo = '$item' AND localizacao = 'PLANURB';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $planurb = ceil($row_pg['planurb']);

    $buscar_produtos = "SELECT COUNT(idbem) AS resid_g FROM item WHERE tipo = '$item' AND localizacao = 'RESID';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $resid_g = ceil($row_pg['resid_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS drgp FROM item WHERE tipo = '$item' AND localizacao = 'DRGP';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $drgp = ceil($row_pg['drgp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS drpm FROM item WHERE tipo = '$item' AND localizacao = 'DRPM';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $drpm = ceil($row_pg['drpm']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dru FROM item WHERE tipo = '$item' AND localizacao = 'DRU';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dru = ceil($row_pg['dru']);

    $resid = $resid_g + $drgp + $drpm + $dru;

    $buscar_produtos = "SELECT COUNT(idbem) AS servin_g FROM item WHERE tipo = '$item' AND localizacao = 'SERVIN';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $servin_g = ceil($row_pg['servin_g']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsigp FROM item WHERE tipo = '$item' AND localizacao = 'DSIGP';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsigp = ceil($row_pg['dsigp']);

    $buscar_produtos = "SELECT COUNT(idbem) AS dsimp FROM item WHERE tipo = '$item' AND localizacao = 'DSIMP';";
    $query_produto = mysqli_query($conn, $buscar_produtos);
    $row_pg = mysqli_fetch_assoc($query_produto);
    $dsimp = ceil($row_pg['dsimp']);

    $servin = $servin_g + $dsigp + $dsimp;

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
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>GABINETE(total: <?php echo $gabinete; ?>)</strong></li>
                        <li class="list-group-item">ASCOM: <?php echo $ascom; ?></li>
                        <li class="list-group-item">ATECC: <?php echo $atecc; ?></li>
                        <li class="list-group-item">ATIC: <?php echo $atic; ?></li>
                        <li class="list-group-item">GAB: <?php echo $gab; ?></li>
                        <li class="list-group-item">STEL: <?php echo $stel; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CAF(total: <?php echo $caf; ?>)</strong></li>
                        <li class="list-group-item">CAF-G: <?php echo $caf_g; ?></li>
                        <li class="list-group-item">DGP: <?php echo $dgp; ?></li>
                        <li class="list-group-item">DLC: <?php echo $dlc; ?></li>
                        <li class="list-group-item">DOF: <?php echo $dof; ?></li>
                        <li class="list-group-item">DSUP: <?php echo $dsup; ?></li>
                        <li class="list-group-item">AUDITÓRIO: <?php echo $auditorio; ?></li>
                        <li class="list-group-item">ALMOXARIFADO: <?php echo $almoxarifado; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CAP(total: <?php echo $cap; ?>)</strong></li>
                        <li class="list-group-item">CAP-G: <?php echo $cap_g; ?></li>
                        <li class="list-group-item">ARTHUR SABOYA: <?php echo $arthur; ?></li>
                        <li class="list-group-item">DEPROT: <?php echo $deprot; ?></li>
                        <li class="list-group-item">DPCI: <?php echo $dpci; ?></li>
                        <li class="list-group-item">DPD: <?php echo $dpd; ?></li>
                        <li class="list-group-item">NÚCLEO: <?php echo $nucleo; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CASE(total: <?php echo $case; ?>)</strong></li>
                        <li class="list-group-item">CASE-G: <?php echo $case_g; ?></li>
                        <li class="list-group-item">DCAD: <?php echo $dcad; ?></li>
                        <li class="list-group-item">DDU: <?php echo $ddu; ?></li>
                        <li class="list-group-item">DLE: <?php echo $dle; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CEPEUC(total:<?php echo $cepeuc; ?> )</strong></li>
                        <li class="list-group-item">CEPEUC: <?php echo $cepeuc; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>COMIN(total: <?php echo $comin; ?>)</strong></li>
                        <li class="list-group-item">COMIN-G: <?php echo $comin_g; ?></li>
                        <li class="list-group-item">DCIGP: <?php echo $dcigp; ?></li>
                        <li class="list-group-item">DCIMP: <?php echo $dcimp; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>CONTRU(total: <?php echo $contru; ?>)</strong></li>
                        <li class="list-group-item">CONTRU-G: <?php echo $contru_g; ?></li>
                        <li class="list-group-item">DACESS: <?php echo $dacess; ?></li>
                        <li class="list-group-item">DINS: <?php echo $dins; ?></li>
                        <li class="list-group-item">DLR: <?php echo $dlr; ?></li>
                        <li class="list-group-item">DSUS: <?php echo $dsus; ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row mb-3">
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>DEUSO(total: <?php echo $deuso; ?>)</strong></li>
                        <li class="list-group-item">DEUSO-G: <?php echo $deuso_g; ?></li>
                        <li class="list-group-item">DMUS: <?php echo $dmus; ?></li>
                        <li class="list-group-item">DNUS: <?php echo $dnus; ?></li>
                        <li class="list-group-item">DSIZ: <?php echo $dsiz; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>GEOINFO(total: <?php echo $geoinfo; ?>)</strong></li>
                        <li class="list-group-item">GEOINFO: <?php echo $geoinfo; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>GTEC(total: <?php echo $gtec; ?>)</strong></li>
                        <li class="list-group-item">GTEC: <?php echo $gtec; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>PARHIS(total: <?php echo $parhis; ?>)</strong></li>
                        <li class="list-group-item">PARHIS-G: <?php echo $parhis_g; ?></li>
                        <li class="list-group-item">DHIS: <?php echo $dhis; ?></li>
                        <li class="list-group-item">DHMP: <?php echo $dhmp; ?></li>
                        <li class="list-group-item">DPS: <?php echo $dps; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>PLANURB(total: <?php echo $planurb; ?>)</strong></li>
                        <li class="list-group-item">PLANURB: <?php echo $planurb; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>RESID(total: <?php echo $resid; ?>)</strong></li>
                        <li class="list-group-item">RESID-G: <?php echo $resid_g; ?></li>
                        <li class="list-group-item">DRGP: <?php echo $drgp; ?></li>
                        <li class="list-group-item">DRPM: <?php echo $drpm; ?></li>
                        <li class="list-group-item">DRU: <?php echo $dru; ?></li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-primary" aria-current="true"><strong>SERVIN(total: <?php echo $servin; ?>)</strong></li>
                        <li class="list-group-item">SERVIN-G: <?php echo $servin_g; ?></li>
                        <li class="list-group-item">DSIGP: <?php echo $dsigp; ?></li>
                        <li class="list-group-item">DSIMP: <?php echo $dsimp; ?></li>
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