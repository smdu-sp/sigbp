<?php
include_once('menu.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimentação</title>
    <link rel="stylesheet" href="./css/movimentacao.css">
</head>

<body>
    <section class="movimentacao">
        <h1 class="title-mov">Movimentação</h1>
        <hr class="linha">
        <h2 class="subtitle-mov">Dados do Item</h2>
        <form action="#" method="post">
            <div class="box-mov">
                <div class="input-mov">
                    <label for="id">ID:</label>
                    <input type="text" name="id-item" id="id-item">
                </div>
                <div class="input-mov">
                    <label for="numPatrimonio-PMSP">Número do Patrimônio PMSP:</label>
                    <input type="text" name="numPatrimonio-PMSP" id="numPatrimonio-PMSP">
                </div>
            </div>
            <div class="box-mov">
                <div class="input-mov">
                    <label for="tipo">Tipo:</label>
                    <input type="text" name="tipo" id="tipo">
                </div>
                <div class="input-mov">
                    <label for="">Modelo:</label>
                    <input type="text" name="modelo" id="modelo">
                </div>
            </div>
            <div class="box-mov">
                <div class="input-mov">
                    <label for="numSerie">Número de Série:</label>
                    <input type="text" name="numSerie" id="numSerie">
                </div>
                <div class="input-mov">
                    <label for="narca">Marca:</label>
                    <input type="text" name="marca" id="marca">
                </div>
            </div>
            <div class="box-mov">
                <div class="input-mov">
                    <label for="local-atual">Localização Atual:</label>
                    <input type="text" name="local-atual" id="local-atual">
                </div>
                <div class="input-mov">
                    <label for="servidorAtual">Servidor Atual:</label>
                    <input type="text" name="servidorAtual" id="servidorAtual">
                </div>
            </div>
            <h2 class="subtitle-mov">Dados da Transferência</h2>
            <hr class="linha">
            <div class="box-mov">
                <div class="input-mov">
                    <label for="nomeServidor">Nome do Servidor:</label>
                    <input type="text" name="nomeServidor" id="nomeServidor">
                </div>
                <div class="input-mov">
                    <label for="local-novo">Localização Nova:</label>
                    <input type="text" name="local-novo" id="local-novo">
                </div>
            </div>
            <div class="box-mov">
                <div class="input-mov">
                    <label for="cimbpm">CIMBPM:</label>
                    <input type="text" name="cimbpm" id="cimbpm">
                </div>
            </div>
            <div class="box-mov">
                <div class="input-mov">
                    <label for="responsavel-transferencia">Responsável pela Transferência:</label>
                    <input type="text" name="responsavel-transferencia" id="responsavel-transferencia">
                </div>
                <div class="input-mov">
                    <label for="login">Login:</label>
                    <input type="text" name="login" id="login">
                </div>
            </div> 
            <input type="button" value="Salvar" class="btn-mov"> 
        </form>
    </section>
</body>

</html>