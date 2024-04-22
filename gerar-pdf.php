<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataEntregue = $_POST['dataEntregue'];
    $unidadeEntregue = $_POST['unidadeEntregue'];
    $nomeEntrega = $_POST['nomeEntrega'];
    $rfEntrega = $_POST['rfEntrega'];
    $dataRecebimento = $_POST['dataRecebimento'];
    $unidadeRecebimento = $_POST['unidadeRecebimento'];
    $nomeRecebimento = $_POST['nomeRecebimento'];
    $rfRecebimento = $_POST['rfRecebimento'];
} else {
    echo "Nenhum dado recebido";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/pdf.css" media="print">
    <script type="text/javascript" src="js/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container-pdf" id="conteudo">
        <div class="titulo-termo">
            <!-- <img src="./images/logo-cinza.jpg" alt="Logo"> -->
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
            <table class="descricaoBem">
                <thead>
                    <tr>
                        <th class="desc-th">Nº PATRIMONIAL/ Nº DE SÉRIE</th>
                        <th class="desc-th">DESCRIÇÃO DO BEM</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="desc-td">001-051100480-9/EWCFM22</td>
                        <td class="desc-td">NOTEBOOK DELL INSPIRON 15</td>
                    </tr>
                    <tr>
                        <td class="desc-td">001-051100480-9</td>
                        <td class="desc-td">DELL INSPIRON 15</td>
                    </tr>
                    <tr>
                        <td class="desc-td">EWCFM22/001-051100480-9</td>
                        <td class="desc-td">DELL INSPIRON 15 NOTEBOOK </td>
                    </tr>
                </tbody>
            </table>
            <table class="assinatura">
                <tbody>
                    <tr>
                        <td class="ass-td"><strong>Entregue em:</strong>  <?php echo $dataEntregue ?></td>
                        <td class="ass-td"><strong>Recebido em:</strong>  <?php echo $dataRecebimento ?> </td>
                    </tr>
                    <tr>
                        <td class="ass-td"><strong>UNIDADE:</strong>  <?php echo $unidadeEntregue ?></td>
                        <td class="ass-td"><strong>UNIDADE:</strong> <?php echo $unidadeRecebimento ?></td>
                    </tr>
                    <tr>
                        <td class="ass-td"><strong>NOME:</strong> <?php echo $nomeEntrega ?></td>
                        <td class="ass-td"><strong>NOME:</strong> <?php echo $nomeRecebimento ?></td>
                    </tr>
                    <tr>
                        <td class="ass-td"><strong>RF:</strong> <?php echo $nomeEntrega ?></td>
                        <td class="ass-td"><strong>RF:</strong> <?php echo $nomeRecebimento ?></td>
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
    <button id="btGerarPDF">Baixar pdf</button>
</body>

</html>

<script>
    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function(element, renderer) {
            return true;
        }
    };

    $('#btGerarPDF').click(function() {
        doc.fromHTML($('.container-pdf').html(), 1, 1, {
            'width': '100%',
            'elementHandlers': specialElementHandlers
        });
        doc.save('termo-pdf.pdf');
    });
</script>