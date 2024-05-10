<?php
session_start();
include_once('verificacao.php');
include_once('header.php');
include_once('./conexoes/config.php');
?>
<style>
        @media (max-width: 1600px) {
        .conteudo {
            margin-left: 75px;
            width: 95%;
        }

        .conteudo_menu {
            width: 70px;
        }

        .menu-principal {
            position: fixed;
            top: 0;
            left: -187px;
            z-index: 999999 !important;
            transition: all .5s ease;
        }


        .menu-logout {
            z-index: 1000000 !important;
        }

        .aparecer {
            left: 70px !important;
        }


        .menu-button {
            display: block;
            cursor: pointer;
        }
    }
</style>
<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel-box mb-2">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1">
                    <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
                </a></li>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./cadastrarbens.php" class="text-primary ms-1 carrossel-text">Dashboard</a></li>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="card mb-3 me-3 rounded-0 shadow p-3 mb-5 bg-white rounded border-0">
                <form action="resultadodash.php">
                    <div class="card-body d-flex flex-column" style="width: 800px; height: 700px">
                        <label for="card" class="form-label mt-1 text-primary">Selecione um Item:</label>
                        <input class="form-control mb-2" type="text" id="textBusca" name="inputText">
                        <div class="card lista-itens">
                            <ul class="list-group list-group-flush overflow-auto" id="ulItens" style="height: 600px;">
                                <?php

                                $itens = array(
                                    "AMPLIFICADOR",
                                    "ANTENA PARABÓLICA",
                                    "ANTENA WIRELESS",
                                    "AP TELEFONICO DIGITAL",
                                    "APARELHO FAX",
                                    "AR CONDICIONADO",
                                    "ARMARIO",
                                    "ARQUIVO DESLIZANTE",
                                    "BALCAO",
                                    "BATERIA",
                                    "CADEIRA",
                                    "CAIXA ACÚSTICA",
                                    "CAIXAS DE SOM",
                                    "CALCULADORA",
                                    "CARRINHO PARA SUPERMERCADO",
                                    "COMPRESSOR DE ÁUDIO COM DOIS CANAIS",
                                    "COMPUTADOR",
                                    "CONTROLADOR",
                                    "CPU",
                                    "DESKTOP SWITCH",
                                    "ENCADERNADORA",
                                    "ESCADA DE ALUMÍNIO",
                                    "ESMERILHADEIRA",
                                    "ESTABILIZADOR",
                                    "ESTAÇÃO DE TRABALHO",
                                    "ESTANTE",
                                    "FRAGMENTADORA DE PAPEL",
                                    "FREEZER",
                                    "FURADEIRA",
                                    "GAVETEIRO",
                                    "GPS",
                                    "GUILHOTINA DE ESCRITÓRIO",
                                    "HARD DISK",
                                    "HD EXTERNO",
                                    "HORODATADOR PROTOCOLADOR",
                                    "IMPRESSORA",
                                    "LIXADEIRA DE CINTA",
                                    "LONGARINA",
                                    "MAPA",
                                    "MAQUINA FOTOGRAFICA/ CÂMERA DIGITAL",
                                    "MARTELETE ROMPEDOR",
                                    "MEDIDOR DE DISTÂNCIA",
                                    "MEDUSA",
                                    "MESA",
                                    "MESA DE SOM",
                                    "MICROCOMPUTADOR",
                                    "MICROFONES",
                                    "MICRO-ONDAS",
                                    "MINIGRAVADOR DIGITAL",
                                    "MONITOR",
                                    "MORSA",
                                    "NOBREAK",
                                    "NOTEBOOK",
                                    "PAINEL ELETRÔNICO",
                                    "PEDESTAL",
                                    "PERSIANA",
                                    "PLOTTER",
                                    "POLTRONA",
                                    "PROJETOR MULTIMÍDIA(DATA SHOW)",
                                    "QUADRO DE AVISO",
                                    "RACK",
                                    "RELÓGIO",
                                    "ROTEADOR",
                                    "SCANNER",
                                    "SERVIDOR",
                                    "SOFA",
                                    "SWITCH",
                                    "TABLET MARCA SAMSUNG MODELO TAB S8 5G",
                                    "TELA DE PROJEÇÃO RETRÁTIL",
                                    "TELEVISOR",
                                    "TRENA",
                                    "TV",
                                    "UNID. DE PROCESSAMENTO",
                                    "VENTILADOR",
                                    "WEBCAM FULL HD 1080P",
                                    "WORKSTATION",
                                    "OUTROS",
                                );

                                foreach ($itens as $item) {
                                    echo "<li><a href=\"#\" class=\"list-group-item list-group-item-action\" onclick=\"botaoClicado('$item')\">$item</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mr-3 mt-1" id="bnt ">
                        <button type="submit" class="btn btn-primary mb-2" id="btn" disabled>Verificar Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="hide" id="modal"></div>
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
    </script>
</body>