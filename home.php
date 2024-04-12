<?php
session_start();
include_once('./conexoes/config.php');
include_once('header.php');

$sql = "SELECT * FROM "

// if($_SESSION['Perm'] == 1) {
//     echo '<script>alert("Usuario invalido!");</script>';
//     return;
// }
?>
<style>

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
        background-color: #E2E3E5;
        border: none;
        height: 10px;
    }

    .conteudo {
        margin-left: 345px;
        width: 81%;
    }

    @media (max-width: 1300px) {
    .conteudo {
        margin-left: 75px;
        width: 90%;
    }
}
</style>

<body>
    <?php
    include_once('menu.php');

    // if($_SESSION['Perm'] == 1) {
    //     echo '<script>alert("Usuario invalido!");</script>';
    //     return;
    // }
    ?>
    <div class="p-2 pt-5 conteudo ">
        
        <p class="mb-1">
            Digite algo no campo de entrada para pesquisar na tabela:
        </p>
        <input class="form-control mb-3 input-filtro" id="myInput" type="text" placeholder="Procurar...">
        <br>
        <p class="mb-1 text-muted">Últimas movimentações</p>
        <div>
            <table class="table">
                <thead class="table-secondary">
                    <tr>
                        <th>Nº Patrimônio</th>
                        <th>Nome</th>
                        <th>Descrição do Bem</th>
                        <th>Localização</th>
                        <th>Servidor</th>
                        <th>Responsável</th>
                        <th>CIMBPM:</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody id="myTable" class="large-2">
                    <tr>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                        <td>#</td>
                    </tr>
                </tbody>
            </table>
        </div>
            <div>
                <ul class="pagination ml-2 mt-2 " >
                    <li class="page-item" onclick="ativar(this)"><a class="page-link" href="#">Anterior</a></li>
                    <li class="page-item active" onclick="ativar(this)"><a class="page-link" href="#">1</a></li>
                    <li class="page-item" onclick="ativar(this)"><a class="page-link" href="#">2</a></li>
                    <li class="page-item" onclick="ativar(this)"><a class="page-link" href="#">3</a></li>
                    <li class="page-item" onclick="ativar(this)"><a class="page-link" href="#">4</a></li>
                    <li class="page-item" onclick="ativar(this)"><a class="page-link" href="#">Próxima</a></li>
                </ul>
            </div>
        <div class="hide" id="modal"></div>
    </div>
</body>

</html>