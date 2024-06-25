<?php
session_start();
include_once('header.php');
include_once('conexoes/config.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

if (!empty($_GET['id'])) {
    include_once('./conexoes/config.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM item WHERE idbem=$id";

    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $id = $user_data['idbem'];
            $patrimonio = $user_data['patrimonio'];
            $name = $user_data['nome'];
            $marca = $user_data['marca'];
            $tipo = $user_data['tipo'];
            $descsbpm = $user_data['descsbpm'];
            $modelo = $user_data['modelo'];
            $numserie = $user_data['numserie'];
            $localizacao = $user_data['localizacao'];
            $servidor = $user_data['servidor'];
            $numprocesso = $user_data['numprocesso'];
            $cimbpm = $user_data['cimbpm'];
            $statusitem = $user_data['statusitem'];
        }
    } else {
        header('Location: listaremovimentar.php?notificacao=2&status=TODOS');
    }
}
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
                <a href="./home.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-avancar" alt="icon-avancar">
                <a href="./listaremovimentar.php" class="text-muted ms-1 carrossel-text">Listar/Movimentar Bens</a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-avancar ms-1" alt="icon-avancar">
                <a href="#" class="text-primary ms-1 carrossel-text">Alteração de bens</a>
            </div>
        </div>
        <h2 class="mb-5">Alteração de bens</h2>
        <form method="POST" action="salvar-alteracaodebens.php">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numPatrimonio" class="form-label text-muted">Número do Patrimônio PMSP:</label>
                    <input type="text" class="form-control" id="numPatrimonio" name="numPatrimonio" value="<?php echo strtoupper($patrimonio); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tipo" class="form-label text-muted">Tipo:</label>
                    
                    <select class="form-select" name="tipo" id="tipo" required>
                        <option value="<?php echo $tipo ?>" hidden="hidden"><?php echo strtoupper($tipo) ?></option>
                        <?php  include 'query-tipos.php'?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="marca" class="form-label text-muted">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca" value="<?php echo strtoupper($marca) ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="modelo" class="form-label text-muted">Modelo:</label>
                    <input type="text" class="form-control" id="mmodelo" name="modelo" value="<?php echo strtoupper($modelo) ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numSerie" class="form-label text-muted">Número de Série:</label>
                    <input type="text" class="form-control" id="numSerie" name="numSerie" value="<?php echo strtoupper($numserie) ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="localNovo" class="form-label text-muted">Setor:</label>
                    <select id="unidadeSelect" class="form-select" name="localNovo">
                        <option value="<?php echo $localizacao ?>" hidden="hidden"><?php echo strtoupper($localizacao) ?></option>
                        <?php include 'query-unidades.php' ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nomeServidor" class="form-label text-muted">Nome do Servidor:</label>
                    <input type="text" class="form-control" id="nomeServidor" name="nomeServidor" value="<?php echo $servidor ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cimbpm" class="form-label text-muted">CIMBPM:</label>
                    <input type="text" class="form-control" id="cimbpm" name="cimbpm" value="<?php echo strtoupper($cimbpm) ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="numProcesso" class="form-label text-muted">Número do Processo:</label>
                    <input type="text" class="form-control" id="numProcesso" name="numProcesso" value="<?php echo strtoupper($numprocesso) ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label text-muted">Nome do computador:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo strtoupper($name) ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="descricaoPBPM" class="form-label text-muted">Descrição PBPM:</label>
                    <input type="text" class="form-control" id="descricaoPBPM" name="descricaoPBPM" value="<?php echo strtoupper($descsbpm) ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label text-muted">Status:</label>
                    <select class="form-select" id="status" required name="status" required>
                        <option value="<?php echo $statusitem ?>" hidden="hidden"><?php echo strtoupper($statusitem) ?></option>
                        <option value="ATIVO">Ativo</option>
                        <option value="BAIXADO">Baixado</option>
                        <option value="PARA DOAÇÃO">Para Doação</option>
                        <option value="PARA DESCARTE">Para Descarte</option>
                        <option value="DOADO">Doado</option>
                        <option value="DESCARTADO">Descartado</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="box-btn-voltar">
                <button type="submit" class="btn btn-primary" name="update" id="UPDATE">Alterar</button>
            </div>
        </form>
    </div>
    <div class="hide" id="modal"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>