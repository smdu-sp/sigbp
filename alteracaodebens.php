<?php
include_once('header.php');
include_once('./conexoes/config.php');

$sql = "SELECT * FROM item ORDER BY idbem ASC";
$result = $conexao->query($sql) or die($mysqli->error);

$user_data = mysqli_fetch_assoc($result)
?>
<style>
        .icon-carrossel {
        width: 16px;
    }

    .icon-carrossel-i {
        width: 16px;
    }

    .carrossel > a {
        font-size: 13px;
    }

    .carrossel > a:hover {
        font-family: 'Roboto', sans-serif;
        text-decoration: none;
    }

    .carrossel {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-md-3 conteudo">
        <div class="carrossel mb-2">
            <a href="./home.php" class="mb-3 me-1">
                <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
            </a>
            <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
            <a href="./listaremovimentar.php" class="text-muted ms-1">Listar/Movimentar Bens</a>
            <img src="./images/icon-avancar.png" class="icon-carrossel-i ms-1" alt="icon-avancar">
            <a href="./alteracaodebens.php" class="text-primary ms-1">Alteração de bens</a>
        </div>
        <h3 class="mb-3">Alteração de bens</h3>
        <hr class="mb-4 w" style="opacity: 1;">
        <form method="POST" action="cadastraitem.php">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numPatrimonio" class="form-label text-muted">Número do Patrimônio PMSP:</label>
                    <input type="text" class="form-control" id="numPatrimonio" name="numPatrimonio" value="<?php echo $user_data['patrimonio'] ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tipo" class="form-label text-muted">Tipo:</label>
                    <select class="form-select" name="tipo" id="tipo" required>
                        <option value="Selecionar" hidden="hidden">Selecionar</option>
                        <option value="AMPLIFICADOR">AMPLIFICADOR</option>
                        <option value="ANTENA PARABÓLICA">ANTENA PARABÓLICA</option>
                        <option value="AP TELEFONICO DIGITAL">AP TELEFONICO DIGITAL</option>
                        <option value="APARELHO FAX">APARELHO FAX</option>
                        <option value="AR CONDICIONADO">AR CONDICIONADO</option>
                        <option value="ARMARIO">ARMARIO</option>
                        <option value="ARQUIVO DESLIZANTE">ARQUIVO DESLIZANTE</option>
                        <option value="BALCAO">BALCAO</option>
                        <option value="BATERIA">BATERIA</option>
                        <option value="CADEIRA">CADEIRA</option>
                        <option value="CAIXAS DE SOM">CAIXAS DE SOM</option>
                        <option value="CALCULADORA">CALCULADORA</option>
                        <option value="CARRINHO PARA SUPERMERCADO">CARRINHO PARA SUPERMERCADO</option>
                        <option value="COMPRESSOR DE ÁUDIO COM DOIS CANAIS">ARMARIO</option>
                        <option value="ENCADERNADORA">ENCADERNADORA</option>
                        <option value="ESCADA DE ALUMÍNIO">ESCADA DE ALUMÍNIO</option>
                        <option value="ESMERILHADEIRA">ESMERILHADEIRA</option>
                        <option value="ESTABILIZADOR">ESTABILIZADOR</option>
                        <option value="ESTAÇÃO DE TRABALHO">ESTAÇÃO DE TRABALHO</option>
                        <option value="ESTANTE">ESTANTE</option>
                        <option value="FRAGMENTADORA DE PAPEL">FRAGMENTADORA DE PAPEL</option>
                        <option value="FREEZER">FREEZER</option>
                        <option value="FURADEIRA">FURADEIRA</option>
                        <option value="GAVETEIRO">GAVETEIRO</option>
                        <option value="GPS">GPS</option>
                        <option value="GUILHOTINA DE ESCRITÓRIO">GUILHOTINA DE ESCRITÓRIO</option>
                        <option value="HARD DISCK">HARD DISK</option>
                        <option value="HORODATADOR PROTOCOLADOR">HORODATADOR PROTOCOLADOR</option>
                        <option value="IMPRESSORA">IMPRESSORA</option>
                        <option value="LIXADEIRA DE CINTA">LIXADEIRA DE CINTA</option>
                        <option value="LONGARINA">LONGARINA</option>
                        <option value="MAPA">MAPA</option>
                        <option value="MAQUINA FOTOGRAFICA/ CÂMERA DIGITAL">MAQUINA FOTOGRAFICA/ CÂMERA DIGITAL</option>
                        <option value="MARTELETE ROMPEDOR">MARTELETE ROMPEDOR</option>
                        <option value="MEDITOR DE DISTÂNCIA">MEDIDOR DE DISTÂNCIA</option>
                        <option value="MEDUSA">MEDUSA</option>
                        <option value="MESA">MESA</option>
                        <option value="MESA DE SOM">MESA DE SOM</option>
                        <option value="MICROCOMPUTADOR">MICROCOMPUTADOR</option>
                        <option value="MICROFONES">MICROFONES</option>
                        <option value="MICRO-ONDAS">MICRO-ONDAS</option>
                        <option value="MINIGRAVADOR DIGITAL">MINIGRAVADOR DIGITAL</option>
                        <option value="MONITOR">MONITOR</option>
                        <option value="MORSA">MORSA</option>
                        <option value="NOBREAK">NOBREAK</option>
                        <option value="NOTEBOOK">NOTEBOOK</option>
                        <option value="PAINEL ELETRÔNICO">PAINEL ELETRÔNICO</option>
                        <option value="PEDESTAL">PEDESTAL</option>
                        <option value="PERSIANA">PERSIANA</option>
                        <option value="PLOTTER">PLOTTER</option>
                        <option value="POLTRONA">POLTRONA</option>
                        <option value="PROJETOR MULTIMÍDIA(DATA SHOW)">PROJETOR MULTIMÍDIA(DATA SHOW)</option>
                        <option value="QUADRO DE AVISO">QUADRO DE AVISO</option>
                        <option value="RELÓGIO">RELÓGIO</option>
                        <option value="SCANNER">SCANNER</option>
                        <option value="SERVIDOR">SERVIDOR</option>
                        <option value="SOFA">SOFA</option>
                        <option value="SWITCH">SWITCH</option>
                        <option value="TELA DE PROJEÇÃO RETRÁTIL">TELA DE PROJEÇÃO RETRÁTIL</option>
                        <option value="TELEVISOR">TELEVISOR</option>
                        <option value="TRENA">TRENA</option>
                        <option value="UNID. DE PROCESSAMENTO">UNID. DE PROCESSAMENTO</option>
                        <option value="VENTILADOR">VENTILADOR</option>
                        <option value="OUTROS">OUTROS</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="marca" class="form-label text-muted">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca" value="<?php echo $user_data['marca'] ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="modelo" class="form-label text-muted">Modelo:</label>
                    <input type="text" class="form-control" id="mmodelo" name="modelo" value="<?php echo $user_data['modelo'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numSerie" class="form-label text-muted">Número de Série:</label>
                    <input type="text" class="form-control" id="numSerie" name="numSerie" value="<?php echo $user_data['numserie'] ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="setor" class="form-label text-muted">Setor:</label>
                    <input type="text" class="form-control" id="setor" name="setor" value="<?php echo $user_data['localizacao'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nomeServidor" class="form-label text-muted">Nome do Servidor:</label>
                    <input type="text" class="form-control" id="nomeServidor" name="nomeServidor" value="<?php echo $user_data['servidor'] ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cimbpm" class="form-label text-muted">CIMBPM:</label>
                    <input type="text" class="form-control" id="cimbpm" name="cimbpm" value="<?php echo $user_data['cimbpm'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numProcesso" class="form-label text-muted">Número do Processo:</label>
                    <input type="text" class="form-control" id="numProcesso" name="numProcesso" value="<?php echo $user_data['numprocesso'] ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nomeComputador" class="form-label text-muted">Nome do computador:</label>
                    <input type="text" class="form-control" id="nomeComputador" name="nomeComputador" value="<?php echo $user_data['nome'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="descricaoPBPM" class="form-label text-muted">Descrição PBPM:</label>
                    <input type="text" class="form-control" id="descricaoPBPM" name="descricaoPBPM" value="<?php echo $user_data['descsbpm'] ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label text-muted">Status:</label>
                    <select class="form-select" id="status" required name="status" required>
                        <option value="Selecionar" hidden="hidden">Selecionar</option>
                        <option value="Ativo">Ativo</option>
                        <option value="Baixado">Baixado</option>
                        <option value="Para Doação">Para Doação</option>
                        <option value="Ativo">Para Descarte</option>
                        <option value="Ativo">Doado</option>
                        <option value="Descartado">Descartado</option>
                    </select>
                </div>
            </div>
            <div class="box-btn-voltar">
                <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
                <a href="./listaremovimentar.php" class="seta"><img src="./images/icon-voltar.png" alt="seta-sair" class="seta-voltar"></a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>