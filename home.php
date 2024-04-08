<?php
include_once('header.php');
?>
<style>
    .large-2 {
        overflow-y: auto;
        height: 730px;
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
        background-color: #212529;
        border: none;
        height: 10px;
    }
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="container p-2 pt-5 conteudo" style="margin-left: 340px;">
        <div style="width: 1500px; margin-left: 20px;">
            <p class="mb-1">
                Digite algo no campo de entrada para pesquisar na tabela:
            </p>
            <input class="form-control mb-3 input-filtro" id="myInput" type="text" placeholder="Procurar...">
            <br>
            <p class="mb-1 text-muted">Últimas movimentações</p>
            <div class="large-2">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Nº Patrimônio</th>
                            <th>Nome</th>
                            <th>Descrição do Bem</th>
                            <th>Localização</th>
                            <th>Servidor</th>
                            <th>Responsável</th>
                            <th>CIMBPM</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <tr>
                            <td>001-052218428-5</td>
                            <td>SELGBC5032</td>
                            <td class="small">MICROCOMPUTADOR Lenovo Modelo:THINKCENTRE M920Q</td>
                            <td>ATIC</td>
                            <td>Vinicius de Oliveira Giuliani</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>001.001940/2024</td>
                            <td>2024-04-08 09:43:45</td>
                        </tr>
                        <tr>
                            <td>001-052257897-6</td>
                            <td>SELGBC3349</td>
                            <td class="small">MICROCOMPUTADOR DELL Modelo:OPTIPLEX 7070</td>
                            <td>ATIC</td>
                            <td>ATIC</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>001.006390/2024</td>
                            <td>2024-04-08 09:24:55</td>
                        </tr>
                        <tr>
                            <td>001-052422224-9</td>
                            <td>SMDUGBC0096 </td>
                            <td class="small">MICROCOMPUTADOR DELL Modelo:OPTIPLEX 7070</td>
                            <td>ATIC</td>
                            <td>ATIC</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>001.006390/2024</td>
                            <td>2024-04-08 09:20:56</td>
                        </tr>
                        <tr>
                            <td>001-053259699-3</td>
                            <td>95</td>
                            <td class="small">Outros WEBCAM FULL HD 1080P Modelo:WEBCAM FULL HD 1080P</td>
                            <td>ATIC</td>
                            <td>ATIC</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>BAIXA - 001.006327/2022</td>
                            <td>2024-04-05 14:58:17</td>
                        </tr>
                        <tr>
                            <td>001-052218428-5</td>
                            <td>SELGBC5032</td>
                            <td class="small">MICROCOMPUTADOR Lenovo Modelo:THINKCENTRE M920Q</td>
                            <td>ATIC</td>
                            <td>Vinicius de Oliveira Giuliani</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>001.001940/2024</td>
                            <td>2024-04-08 09:43:45</td>
                        </tr>
                        <tr>
                            <td>001-052218428-5</td>
                            <td>SELGBC5032</td>
                            <td class="small">MICROCOMPUTADOR Lenovo Modelo:THINKCENTRE M920Q</td>
                            <td>ATIC</td>
                            <td>Vinicius de Oliveira Giuliani</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>001.001940/2024</td>
                            <td>2024-04-08 09:43:45</td>
                        </tr>
                        <tr>
                            <td>001-052218428-5</td>
                            <td>SELGBC5032</td>
                            <td class="small">MICROCOMPUTADOR Lenovo Modelo:THINKCENTRE M920Q</td>
                            <td>ATIC</td>
                            <td>Vinicius de Oliveira Giuliani</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>001.001940/2024</td>
                            <td>2024-04-08 09:43:45</td>
                        </tr>
                        <tr>
                            <td>001-052218428-5</td>
                            <td>SELGBC5032</td>
                            <td class="small">MICROCOMPUTADOR Lenovo Modelo:THINKCENTRE M920Q</td>
                            <td>ATIC</td>
                            <td>Vinicius de Oliveira Giuliani</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>001.001940/2024</td>
                            <td>2024-04-08 09:43:45</td>
                        </tr>
                        <tr>
                            <td>001-052218428-5</td>
                            <td>SELGBC5032</td>
                            <td class="small">MICROCOMPUTADOR Lenovo Modelo:THINKCENTRE M920Q</td>
                            <td>ATIC</td>
                            <td>Vinicius de Oliveira Giuliani</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>001.001940/2024</td>
                            <td>2024-04-08 09:43:45</td>
                        </tr>
                        <tr>
                            <td>001-052218428-5</td>
                            <td>SELGBC5032</td>
                            <td class="small">MICROCOMPUTADOR Lenovo Modelo:THINKCENTRE M920Q</td>
                            <td>ATIC</td>
                            <td>Vinicius de Oliveira Giuliani</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>001.001940/2024</td>
                            <td>2024-04-08 09:43:45</td>
                        </tr>
                        <tr>
                            <td>001-052218428-5</td>
                            <td>SELGBC5032</td>
                            <td class="small">MICROCOMPUTADOR Lenovo Modelo:THINKCENTRE M920Q</td>
                            <td>ATIC</td>
                            <td>Vinicius de Oliveira Giuliani</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>001.001940/2024</td>
                            <td>2024-04-08 09:43:45</td>
                        </tr>
                        <tr>
                            <td>001-052218428-5</td>
                            <td>SELGBC5032</td>
                            <td class="small">MICROCOMPUTADOR Lenovo Modelo:THINKCENTRE M920Q</td>
                            <td>ATIC</td>
                            <td>Vinicius de Oliveira Giuliani</td>
                            <td>Juliette Maria Alfonso Frederico</td>
                            <td>001.001940/2024</td>
                            <td>2024-04-08 09:43:45</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
    </script>

</body>

</html>