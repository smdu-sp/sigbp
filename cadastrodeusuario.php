<?php
include_once('header.php');
?>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-5 pt-5 conteudo">
        <h3 class="mb-5">Cadastro de Usuários</h3>
        <form method="POST" action="cadastraitem.php">
            <div class="row">
                <div class="col-md-13 mb-1">
                    <label for="usuarioCadastro" class="form-label text-muted">Login de rede</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar por login de rede" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary " type="button">Buscar</button>
                        </div>
                    </div>
                </div>
                <hr style="opacity: 1; width: 97%; margin-left: 12px" class="mb-2">
                <div class="col-md-13 mb-1">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label text-muted">Nome</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nome">
                    </div>
                </div>
                <hr style="opacity: 1; width: 97%; margin-left: 12px" class="mb-2">
                <div class="col-md-12 mb-3">
                    <label for="usuarioCadastro" class="form-label text-muted">Permissão</label>
                    <div class="input-group">
                        <div class="input-group-text" style="background-color: transparent;"><img src="./images/icon-cracha.png" alt="" class="imgCadastro"></div>
                        <select class="form-select" aria-label="Filter select">
                            <option value="Usuário" selected>Usuário</option>
                            <option value="Desenvolvedor">Desenvolvedor</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Técnico">Técnico</option>
                        </select>
                    </div>
                </div>
                <hr style="opacity: 1; width: 97%; margin-left: 12px" class="mb-2">
                <div class="col-md-12 mb-3">
                    <label for="usuarioCadastro" class="form-label text-muted">Unidade</label>
                    <div class="input-group">
                        <div class="input-group-text" style="background-color: transparent;"><img src="./images/unidades.png" alt="" class="imgCadastro"></div>
                        <select class="form-select">
                            <option value="Selecionar" hidden="hidden">Selecionar</option>
                            <option value="ASCOM">ASCOM</option>
                            <option value="ATAJ">ATAJ</option>
                            <option value="ATECC">ATECC</option>
                            <option value="ATIC">ATIC</option>
                            <option value="AUDITÓRIO">AUDITÓRIO</option>
                            <option value="CAF">CAF</option>
                            <option value="CAF/DGP">CAF/DGP</option>
                            <option value="CAF/DLC">CAF/DLC</option>
                            <option value="CAF/DOF">CAF/DOF</option>
                            <option value="CAF/DSUP">CAF/DSUP</option>
                            <option value="CAP">CAP</option>
                            <option value="CAP/ARTHUR SABOYA">CAP/ARTHUR SABOYA</option>
                            <option value="CAP/DEPROT">CAP/DEPROT</option>
                            <option value="CAP/DPCI">CAP/DPCI</option>
                            <option value="CAP/DPD">CAP/DPD</option>
                            <option value="CAP/NÚCLEO DE ATENDIMENTO">CAP/NÚCLEO DE ATENDIMENTO</option>
                            <option value="CASE">CASE</option>
                            <option value="CASE/DCAD">CASE/DCAD</option>
                            <option value="CASE/DDU">CASE/DDU</option>
                            <option value="CASE/DLE">CASE/DLE</option>
                            <option value="CASE/STEL">CASE/STEL</option>
                            <option value="CEPEUC">CEPEUC</option>
                            <option value="CGPATRI">CGPATRI</option>
                            <option value="COMIN">COMIN</option>
                            <option value="COMIN/DCIGP">COMIN/DCIGP</option>
                            <option value="COMIN/DCIMP">COMIN/DCIMP</option>
                            <option value="CONTRU">CONTRU</option>
                            <option value="CONTRU/DACESS">CONTRU/DACESS</option>
                            <option value="CONTRU/DINS">CONTRU/DINS</option>
                            <option value="CONTRU/DLR">CONTRU/DLR</option>
                            <option value="CONTRU/DSUS">CONTRU/DSUS</option>
                            <option value="DEUSO">DEUSO</option>
                            <option value="GABINETE">GABINETE</option>
                            <option value="GEOINFO">GEOINFO</option>
                            <option value="GTEC">GTEC</option>
                            <option value="ILUME">ILUME</option>
                            <option value="PARHIS">PARHIS</option>
                            <option value="PARHIS/DHIS">PHARIS/DHIS</option>
                            <option value="PARHIS/DHMP">PHARIS/DHMP</option>
                            <option value="PARHIS/DPS">PHARIS/DPS</option>
                            <option value="PLANURB">PLANURB</option>
                            <option value="RESID">RESID</option>
                            <option value="RESID/DRGP">RESID/DRGP</option>
                            <option value="RESID/DRPM">RESID/DRPM</option>
                            <option value="RESID/DRU">RESID/DRU</option>
                            <option value="SERVIN">SERVIN</option>
                            <option value="SERVIN/DSIGP">SERVIN/DSIGP</option>
                            <option value="SERVIN/DSIMP">SERVIN/DSIMP</option>
                        </select>
                    </div>
                </div>
                <hr style="opacity: 1; width: 97%; margin-left: 12px" class="mb-2">
                <div class="mb-3">
                    <label for="usuarioCadastro" class="form-label text-muted">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="d-flex flex-row-reverse">
                    <input type="submit" class="btn btn-primary ml-2 pe-auto" name="salvar" value="Enviar"></input>
                    <input type="submit" class="btn btn-light pe-auto" name="salvar" value="Cancelar"></input>
                </div>
        </form>
        <div class="hide" id="modal"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>