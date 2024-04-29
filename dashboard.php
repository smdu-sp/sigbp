<?php
include_once('header.php');
?>
<style>
    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background-color: #F8F8F8;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #a8a8a8;
        border-radius: 5px;
    }
</style>

<body>
    <?php
    include_once('menu.php');
    include_once('./conexoes/conexao.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel mb-2">
            <a href="./home.php" class="mb-3 me-1">
                <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
            </a></li>
            <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
            <a href="./cadastrarbens.php" class="text-primary ms-1 carrossel-text">Dashboard</a></li>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="card mb-3 me-3 rounded-0 shadow p-3 mb-5 bg-white rounded border-0">
                <form >
                    <div class="card-body d-flex flex-column" style="width: 800px; height: 700px">
                        <label for="card" class="form-label mt-1 text-primary">Selecione um Item:</label>
                        <input class="form-control mb-2" type="text" id="textBusca">
                        <div class="card lista-itens">
                        <ul class="list-group list-group-flush overflow-auto" id="ulItens" style="height: 600px;">
                                <?php
                                    
                                    $itens = array("AMPLIFICADOR", "ANTENA PARABÓLICA", "AP TELEFONICO DIGITAL", "APARELHO FAX", "AR CONDICIONADO", "ARMARIO", "ARQUIVO DESLIZANTE", "BALCAO", "BATERIA", "CADEIRA", "CAIXAS DE SOM", "CALCULADORA", "CARRINHO PARA SUPERMERCADO", "ARMARIO", "ENCADERNADORA", "ESCADA DE ALUMÍNIO", "ESMERILHADEIRA", "ESTABILIZADOR", "ESTAÇÃO DE TRABALHO", "ESTANTE", "FRAGMENTADORA DE PAPEL", "FREEZER", "FURADEIRA", "GAVETEIRO", "GPS", "GUILHOTINA DE ESCRITÓRIO", "HARD DISK", "HORODATADOR PROTOCOLADOR", "IMPRESSORA", "LIXADEIRA DE CINTA", "LONGARINA", "MAPA", "MAQUINA FOTOGRAFICA/ CÂMERA DIGITAL", "MARTELETE ROMPEDOR", "MEDIDOR DE DISTÂNCIA", "MEDUSA", "MESA", "MESA DE SOM", "MICROCOMPUTADOR", "MICROFONES", "MICRO-ONDAS", "MINIGRAVADOR DIGITAL", "MONITOR", "MORSA", "NOBREAK", "NOTEBOOK", "PAINEL ELETRÔNICO", "PEDESTAL", "PERSIANA", "PLOTTER", "POLTRONA", "PROJETOR MULTIMÍDIA(DATA SHOW)", "QUADRO DE AVISO", "RELÓGIO", "SCANNER", "SERVIDOR", "SOFA", "SWITCH", "TELA DE PROJEÇÃO RETRÁTIL", "TELEVISOR", "TRENA", "UNID. DE PROCESSAMENTO", "VENTILADOR", "OUTROS");
                                    foreach ($itens as $item) {
                                        echo "<li><a href=\"#\" class=\"list-group-item list-group-item-action\" onclick=\"botaoClicado('$item')\">$item</a></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mr-3 mt-1">
                        <button type="submit" class="btn btn-primary mb-2" id="btn" onclick="envio()" disabled>Verificar Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#textBusca").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#ulItens li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        function filterList() {
            var input = document.getElementById('textBusca');
            var filter = input.value.toUpperCase();
            var ul = document.getElementById('ulItens');
            var li = ul.getElementsByTagName('li');
            var button = document.getElementById('btn');
            for (var i = 0; i < li.length; i++) {
                var item = li[i].innerText.toUpperCase();
                if (item.indexOf(filter) > -1) {
                    button.disabled = false;
                    return;
                } 
            }
            button.disabled = true;
        }

        function botaoClicado(item) {
            document.getElementById('textBusca').value = item;
            filterList();
        }

        var passarValor = function(valor) {
            window.location = 'http://localhost/resultadodash.php?item='+valor;
        }

        var valorItem = document.getElementById('textBusca').value;
        function envio() {
            passarValor(valorItem);
        }

    </script>
</body>