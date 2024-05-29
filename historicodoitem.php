<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');

$patrimonio = $_GET['patrimonio'];

$sql_home_query = "SELECT item.patrimonio, item.tipo, item.marca, item.modelo, item.nome, transferencia.cimbpm, transferencia.localnovo, transferencia.servidoratual, transferencia.usuario, transferencia.datatransf 
FROM item, transferencia 
WHERE item.idbem = transferencia.iditem AND item.patrimonio = '$patrimonio'
ORDER BY transferencia.datatransf DESC";
$sql_home_query_exec = $conexao->query($sql_home_query) or die($conexao->error);
?>

<head>
    <link rel="stylesheet" href="./css/historicodoitem.css">
</head>
<body>
    
</body>
</html>
<style>
    .nsei {
        margin-left: 370px;
        position: relative;
    }
</style>

<body>
    <?php 
        include_once('menu.php'); 
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel-box mb-4">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-avancar" alt="icon-avancar">
                <a href="./home.php" class="text-muted ms-1 carrossel-text">Home</a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-avancar ms-1" alt="icon-avancar">
                <a href="#" class="text-primary ms-1 carrossel-text">Movimentações do Item</a>
            </div>
        </div>
        <h2 class="mb-1 mt-4">Movimentações do Item</h2>
        <div class="timeline">
            <ul>
                <?php 
                $index = 0;
                while ($row = $sql_home_query_exec->fetch_assoc()) { 
                    $formattedDate = date('d-m-Y', strtotime($row['datatransf']));
                    $sideClass = ($index % 2 == 0) ? 'left' : 'right';
                ?>
                <li class="<?php echo $sideClass; ?>">
                    <div class="card w-50 mb-3 conteudo" style="background-color: #FBFCFE;">
                        <div class="card-body">
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label text-muted">Nº Patrimônio</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($row['patrimonio']); ?>" readonly>
                            </div>
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label text-muted">Nome</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($row['nome']); ?>" readonly>
                            </div>
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label text-muted">Des do Bem</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="Outros WEBCAM FULL HD 1080P Modelo: <?php echo htmlspecialchars($row['modelo']); ?>" readonly>
                            </div>
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label text-muted">Localização</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($row['localnovo']); ?>" readonly>
                            </div>
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label text-muted">Servidor</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($row['servidoratual']); ?>" readonly>
                            </div>
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label text-muted">Responsável</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($row['usuario']); ?>" readonly>
                            </div>
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label text-muted">CIMBPM</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlspecialchars($row['cimbpm']); ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="data-historico">
                        <h4><?php echo $formattedDate; ?></h4>
                    </div>
                </li>
                <?php 
                $index++;
                } 
                ?>
                <div style="clear: both;"></div>
            </ul>
        </div>
    </div>
</body>