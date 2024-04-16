<?php
include_once('header.php');
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
        margin-left: 340px;
        width: 95%;
    }

    @media (max-width: 1600px) {
        .conteudo {
            margin-left: 75px;
        }

        .menu-principal {
        position: fixed;
        top: 0;
        left: -187px;
        z-index: 999999 !important;
        transition: all 1s ease;
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
    <div class="p-2 pt-5 conteudo">
        <div>
            <p class="mb-1">
                Digite algo no campo de entrada para pesquisar na tabela:
            </p>
            <input class="form-control mb-3 input-filtro" id="myInput" type="text" placeholder="Procurar...">
            <br>
            <p class="mb-1 text-muted">Últimas movimentações</p>
            <div class="large-2">
                <table class="table">
                    <thead class="table-secondary">
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
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
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
        <div class="hide" id="modal"></div>
    </div>
</body>

</html>