<?php
include_once('header.php');
?>
<style>
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-5 pt-5 conteudo">
        <div>
        <h4 class="mb-3">Movimentação</h4>

        </div>
        <hr class="mb-4 w" style="opacity: 1;">
        <h5 class="mb-3">Dados do Item</h4>
            <form method="POST" action="cadastraitem.php">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id" class="form-label text-muted">ID:</label>
                        <input type="text" class="form-control" id="id" name="id">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="numPatrimonio" class="form-label text-muted">Número do Patrimônio PMSP:</label>
                        <input type="text" class="form-control" id="numPatrimonio" name="numPatrimonio">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tipo" class="form-label text-muted">Tipo:</label>
                        <input type="text" class="form-control" id="tipo" name="tipo">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="modelo" class="form-label text-muted">Modelo:</label>
                        <input type="text" class="form-control" id="modelo" name="modelo">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="numSerie" class="form-label text-muted">Número de Série:</label>
                        <input type="text" class="form-control" id="numSerie" name="numSerie">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="marca" class="form-label text-muted">Marca:</label>
                        <input type="text" class="form-control" id="marca" name="marca">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="servidorAtual" class="form-label text-muted">Servidor Atual:</label>
                        <input type="text" class="form-control" id="servidorAtual" name="servidorAtual">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="localAtual" class="form-label text-muted">Localização Atual:</label>
                        <input type="text" class="form-control" id="localAtual" name="localAtual">
                    </div>
                </div>
                <h5 class="mb-3">Dados da Transferência</h4>
                <hr class="mb-4 w" style="opacity: 1;">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nomeServidor" class="form-label text-muted">Nome do Servidor:</label>
                        <input type="text" class="form-control" id="nomeServidor" name="nomeServidor">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="localNova" class="form-label text-muted">Localização Nova:</label>
                        <select class="form-select" id="localNovo" required name="localNovo" required>
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
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cimbpm" class="form-label text-muted">CIMBPM:</label>
                        <input type="text" class="form-control" id="cimbpm" name="cimbpm">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="responsavelTransferencia" class="form-label text-muted">Responsável pela Transferência:</label>
                        <input type="text" class="form-control" id="responsavelTransferencia" name="responsavelTransferencia">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="login" class="form-label text-muted">Login:</label>
                        <input type="text" class="form-control" id="login" name="login">
                    </div>
                </div>
                <div class="box-btn-voltar">
                    <button type="submit" class="btn btn-primary" name="salvar">Salvar</button>
                    <a href="./listaremovimentar.php"><img src="./images/icon-voltar.png" alt="seta-sair" class="seta-voltar"></a>
                </div>
            </form>
            <div class="hide" id="modal"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>