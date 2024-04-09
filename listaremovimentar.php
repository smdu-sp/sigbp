<?php
include_once('header.php');
?>
<style>
    .large-2 {
        overflow-y: auto;
        height: 650px;
        margin-bottom: 30px;
    }

    .large-2::-webkit-scrollbar-track {
        border: 1px solid #fff;
        padding: 2px 0;
        background-color: #fff;
    }

    .large-2::-webkit-scrollbar {
        width: 10px;
    }

    .large-2::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #CFE2FF;
        border: none;
        height: 10px;
    }
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="container p-2 pt-5 conteudo" style="margin-left: 350px;">
        <div style="width: 1530px;">
            <p class="mb-1">
                Digite algo no campo de entrada para pesquisar na tabela:
            </p>
            <input class="form-control mb-3 input-filtro" id="myInput" type="text" placeholder="Procurar...">
            <br>
            <p class="mb-1 text-muted">Últimas movimentações</p>
            <div class="large-2">
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>Nº Patrimônio</th>
                            <th>Nome</th>
                            <th>Marca</th>
                            <th>Tipo</th>
                            <th>Desc. SBPM</th>
                            <th>Modelo</th>
                            <th>Núm. de Série</th>
                            <th>Localização</th>
                            <th>Servidor</th>
                            <th>Num. Processo</th>
                            <th>CIMBPM</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="myTable" class="large-2">
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CORINTHIANS</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>
                        <tr>
                            <td>001-052209414-6</td>
                            <td>SELGBC321</td>
                            <td>DELL</td>
                            <td>MICROCOMPUTADOR</td>
                            <td>N.A.</td>
                            <td>OPTIPLEX 5070</td>
                            <td>CQW8423</td>
                            <td>ATIC</td>
                            <td>atic</td>
                            <td>SEL/ COMPRA 6066.2020/0000628-4</td>
                            <td>001.004639/2023</td>
                            <td>Ativo</td>
                            <td>
                                <a href="./movimentacao.php"><img src="./images/icon-seta.png" alt="Seta"></a>
                                <a href=".//alteracaodebens.php"><img src="./images/icon-lapis.png" alt="Seta"></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <ul class="pagination ml-2 mt-2">
                <li class="page-item" onclick="ativar(this)"><a class="page-link" href="#">Anterior</a></li>
                <li class="page-item active" onclick="ativar(this)"><a class="page-link" href="#">1</a></li>
                <li class="page-item" onclick="ativar(this)"><a class="page-link" href="#">2</a></li>
                <li class="page-item" onclick="ativar(this)"><a class="page-link" href="#">3</a></li>
                <li class="page-item" onclick="ativar(this)"><a class="page-link" href="#">4</a></li>
                <li class="page-item" onclick="ativar(this)"><a class="page-link" href="#">Próxima</a></li>
            </ul>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        const ativar = (elemento) => {
            let itens = document.getElementsByClassName("page-item");
            for (i = 0; i < itens.length; i++) {
                itens[i].classList.remove("active");
            }
            elemento.classList.add("active");
        }
    </script>

</body>

</html>