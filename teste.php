<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');


$sql_home_query = "SELECT item.patrimonio, item.tipo, item.marca, item.modelo, item.nome, transferencia.cimbpm, transferencia.localnovo, transferencia.servidoratual, transferencia.usuario, transferencia.datatransf 
FROM item, transferencia 
WHERE item.idbem = transferencia.iditem AND item.patrimonio = '001-053259699-3'
ORDER BY transferencia.datatransf DESC";
$sql_home_query_exec = $conexao->query($sql_home_query) or die($conexao->error);
?>
<style>
    .modal-historico {
        width: 1300px;
        border-radius: 10px;
    }

    .modal-title {
        margin-left: 20px;
        margin-top: 10px;
    }

    .seila {
        display: flex;
        justify-content: center;
        margin-top: 150px;
    }

    /* 
    #block {
        display: none;
    } */
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo seila">
        <div class="card rounded-3 shadow p-3 mt-5 bg-white rounded border-0 modal-historico seila">
            <h3 class="modal-title mb-3">Movimentações do Item</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nº Patrimônio</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição do Bem</th>
                        <th scope="col">Localização</th>
                        <th scope="col">Servidor</th>
                        <th scope="col">Responsável</th>
                        <th scope="col">CIMBPM</th>
                        <th scope="col">Data</th>
                    </tr>
                </thead>
                <tbody id='myTable'>
                    <?php
                    while ($user_data = $sql_home_query_exec->fetch_assoc()) {
                        $marca = $user_data['marca'];
                        $modelo = $user_data['modelo'];
                        $tipo = $user_data['tipo'];
                        $desc = "$tipo $marca Modelo: $modelo";
                        echo "<tr>";
                        echo "<td onclick='abrirHistorico()'>" . $user_data['patrimonio'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td onclick='abrirHistorico()'>" . $user_data['nome'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td onclick='abrirHistorico()'>" . $desc . '<span hidden>todos</span>' . "</td>";
                        echo "<td onclick='abrirHistorico()'>" . $user_data['localnovo'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td onclick='abrirHistorico()'>" . $user_data['servidoratual'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td onclick='abrirHistorico()'>" . $user_data['usuario'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td onclick='abrirHistorico()'>" . $user_data['cimbpm'] . '<span hidden>todos</span>' . "</td>";
                        echo "<td onclick='abrirHistorico()'>" . $user_data['datatransf'] . '<span hidden>todos</span>' . "</td>";
                        echo "</tr>";
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>