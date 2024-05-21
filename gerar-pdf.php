<?php
session_start();
include_once('./conexoes/config.php');
include_once('componentes/permissao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataEntregue = $_POST['dataEntregue'];
    $unidadeEntregue = $_POST['unidadeEntregue'];
    $nomeEntrega = $_POST['nomeEntrega'];
    $rfEntrega = $_POST['rfEntrega'];
    $dataRecebimento = $_POST['dataRecebimento'];
    $unidadeRecebimento = $_POST['unidadeRecebimento'];
    $nomeRecebimento = $_POST['nomeRecebimento'];
    $rfRecebimento = $_POST['rfRecebimento'];

    $array1 = explode("\n", $_POST['textarea1']);
    $array2 = explode("\n", $_POST['textarea2']);
} else {
    echo "Nenhum dado recebido";
}


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/pdf.css">
    <script type="text/javascript" src="js/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container-pdf" id="conteudo modal">
        <div class="titulo-termo">
            <img src="./images/logo-cinza.jpg" alt="Logo" class="logo-cinza">
            <div class="texto-titulo">
                <h3>PREFEITURA DO MUNICÍPIO DE SÃO PAULO</h3>
                <h3>SECRETARIA MUNICIPAL DE URBANISMO E LICENCIAMENTO</h3>
            </div>
        </div>
        <div class="conteudo-pdf">
            <h4 class="titulo-conteudo-pdf">TERMO DE ENTREGA</h4>
            <div class="texto-conteudo">
                <p>Recebi nesta data os Bens Patrimoniais descritos no presente termo de responsabilidade e recebimento, cujas movimentações, transferências/ aceites serão registrados no Sistema de Bens Patrimoniais - SBPM via processo SEI, nos termos da legislação que rege a matéria.</p>
            </div>
            <table class="descricaoBem" id="descricaoBem">
                <thead>
                    <tr>
                        <th class="desc-th">Nº PATRIMONIAL/ Nº DE SÉRIE</th>
                        <th class="desc-th">DESCRIÇÃO DO BEM</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $tamanhoArray = max(count($array1), count($array2)); ?>
                    <?php for ($i = 0; $i < $tamanhoArray; $i++) : ?>
                        <?php if (!empty($array1[$i]) || !empty($array2[$i])) : ?>
                            <tr>
                                <td class="desc-td"><?php echo !empty($array1[$i]) ? htmlspecialchars($array1[$i]) : ''; ?></td>
                                <td class="desc-td"><?php echo !empty($array2[$i]) ? htmlspecialchars($array2[$i]) : ''; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endfor; ?>
                </tbody>
            </table>
            <table class="assinatura">
                <tbody>
                    <tr>
                        <td class="ass-td"><strong>Entregue em:</strong> <?php echo $dataEntregue ?></td>
                        <td class="ass-td"><strong>Recebido em:</strong> <?php echo $dataRecebimento ?> </td>
                    </tr>
                    <tr>
                        <td class="ass-td"><strong>UNIDADE:</strong> <?php echo $unidadeEntregue ?></td>
                        <td class="ass-td"><strong>UNIDADE:</strong> <?php echo $unidadeRecebimento ?></td>
                    </tr>
                    <tr>
                        <td class="ass-td"><strong>NOME:</strong> <?php echo $nomeEntrega ?></td>
                        <td class="ass-td"><strong>NOME:</strong> <?php echo $nomeRecebimento ?></td>
                    </tr>
                    <tr>
                        <td class="ass-td"><strong>RF:</strong> <?php echo $rfEntrega ?></td>
                        <td class="ass-td"><strong>RF:</strong> <?php echo $rfRecebimento ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="carimbo">
                <p class="carimbo-p">CARIMBO/ASSINATURA DO ENTREGADOR</p>
                <p>CARIMBO/ASSINATURA DO RECEBEDOR</p>
            </div>
        </div>
    </div>
    <div id="editor"></div>
    <div id="absolute">
        <a type="button" href='termo.php' class="botao2"  id="botao2">Voltar</a>
    </div>
    <div id="absolute2">
        <button  class="botao-modal" id="botao" onclick="printTermo()">Imprimir</button>
    </div>
</body>

</html>

<script>

    function printTermo() {
        botao.style.display = 'none';
        document.getElementById('botao2').style.opacity = '0';
        window.print();
    }

    window.onafterprint = function() {
        botao.style.display = 'block';
        botaoVoltar = document.getElementById('botao2');
        botaoVoltar.style.opacity = '1';
        botaoVoltar.classList.toggle('botao2');
        botaoVoltar.classList.toggle('botao-voltar');
    }
</script>