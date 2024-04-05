<?php
    include_once('header.php');
?>
<style>
    body {
        background-color: #dde7ee1b;
    }
    hr {
        width: 100%;
    }

    .conteudo {
        margin-left: 24%;
    }
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="container p-4 p-md-5 pt-5 conteudo">
        <h4 class="mb-3">Cadastro de Usuários</h4>
        <hr class="mb-4 w">
        <form method="POST" action="cadastraitem.php">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="usuario" class="form-label text-muted">Usuário:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label text-muted">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="permissao" class="form-label text-muted">Permissão:</label>
                    <select class="form-select" id="localNovo" required name="localNovo" required>
                        <option value="Selecionar">Selecionar</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Status">Status:</option>
                        </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label text-muted">Nome do computador:</label>
                    <input type="text" class="form-control" id="status" name="status">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>