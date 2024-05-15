<?php


session_start();
include_once('./conexoes/config.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');
include_once('header.php');

$usuario = '';
$nomefr = '';
$emailfr = '';
$permissaoCad = '';
$unidade = 'Selecionar';
$status = 'Selecionar';




if (isset($_GET['usuario'])) {
    $usuario = $_GET['usuario'];
    $query = "SELECT COUNT(*) FROM usuarios WHERE usuario = '$usuario'";
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    $resultado = mysqli_query($conexao, $query);
    $row = mysqli_fetch_assoc($resultado);
    $total = $row['COUNT(*)'];

    if ($total == 0) {
        include_once('componentes/env.php');
        $search = "samaccountname=" . $usuario;

        $ds = ldap_connect($server);
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        $r = ldap_bind($ds, $user, $psw);
        $sr = ldap_search($ds, $dn, $search);
        $data = ldap_get_entries($ds, $sr);

        for ($i = 0; $i < $data["count"]; $i++) {
            $nomefr = $data[$i]["givenname"][0] . " " . $data[$i]["sn"][0];
            $emailfr = strtolower($data[$i]["mail"][0]);
        }
    } else {
        $usuario = '';
        $nomefr = '';
        $emailfr = '';
        $permissaoCad = '';
        $unidade = 'Selecionar';
        $status = 'Selecionar';

        header('Location: cadastrodeusuario.php?notificacao=jaCadastrado');
    }
}

if (isset($_POST['submit'])) {
    $usuario = $_GET['usuario'];
    $query = "SELECT COUNT(*) FROM usuarios WHERE usuario = '$usuario'";
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    $resultado = mysqli_query($conexao, $query);
    $row = mysqli_fetch_assoc($resultado);
    $total = $row['COUNT(*)'];
    if ($total == 0) {
        $usuario = $_POST['loginRede'];
        $nome = $_POST['nome'];
        $permissao = $_POST['permissao'];
        $status = $_POST['status'];
        $email = $_POST['email'];
        $unidade = $_POST['unidade'];

        $result = mysqli_query($conexao, "INSERT INTO usuarios(usuario, nome, permissao, statususer, email, unidade) VALUES ('$usuario', '$nome', '$permissao', '$status', '$email', '$unidade')");

        header('Location: usuarios.php?notificacao=cadastrado');
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

    .swal2-title {
        color: #fff;
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
                <a href="./usuarios.php" class="text-muted ms-1 carrossel-text">Usuários</a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-avancar ms-1" alt="icon-avancar">
                <a href="./cadastrodeusuario.php" class="text-primary ms-1 carrossel-text">Cadastro de Usuários</a>
            </div>
            <div class="button-dark">
                <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
            </div>
        </div>
        <h3 class="mb-4 mt-4">Cadastro de Usuários</h3>
        <form method="POST" action="#">
            <div class="row">
                <div class="col-md-12 mb-1">
                    <label for="usuarioCadastro" class="form-label text-muted">Login de rede</label>
                    <div class="input-group">
                        <input value="<?php echo $usuario; ?>" type="text" name="loginRede" class="form-control" id="inputCadUsuario" placeholder="Buscar por login de rede" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" name="buscar" id="btn-CadUsuario" type="button" onclick="buscarUsuario()">Buscar</button>
                        </div>
                        <hr id="cdusuario">
                    </div>
                </div>
                <div class="col-md-12 mb-1">
                    <div>
                        <label for="exampleFormControlInput1" class="form-label text-muted">Nome</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" id="inputCadUsuario" placeholder="Nome" name="nome" value="<?php echo $nomefr != null ? $nomefr : '' ?>" required>
                        <hr id="cdusuario">
                    </div>
                </div>
                <div class="col-md-12 mb-1">
                    <label for="usuarioCadastro" class="form-label text-muted">Permissão</label>
                    <div class="input-group">
                        <div class="input-group-text" style="background-color: transparent;"><img src="./images/icon-cracha.png" alt="" class="imgCadastro"></div>
                        <select class="form-select" aria-label="Filter select" name="permissao" required>
                            <option value="" hidden="hidden">Selecionar</option>
                            <option value="2" <?php if ($permissaoCad == 2) echo 'selected' ?>>Usuário</option>
                            <option value="1" <?php if ($permissaoCad == 1) echo 'selected' ?>>Administrador</option>
                            <option value="3" <?php if ($permissaoCad == 3) echo 'selected' ?>>Sem permissão</option>
                        </select>
                        <hr id="cdusuario">
                    </div>
                </div>
                <div class="col-md-12 mb-1">
                    <label for="usuarioCadastro" class="form-label text-muted">Unidade</label>
                    <div class="input-group">
                        <div class="input-group-text" style="background-color: transparent;"><img src="./images/unidades.png" alt="" class="imgCadastro"></div>
                        <select class="form-select" name="unidade" required>
                            <option value="<?php echo $unidade ?>"><?php echo $unidade ?></option>
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
                        <hr id="cdusuario">
                    </div>
                </div>
                <div class="col-md-12 mb-1">
                    <label for="usuarioCadastro" class="form-label text-muted">Status</label>
                    <div class="input-group">
                        <div class="input-group-text" style="background-color: transparent;"><img src="./images/icon-status.png" alt="" class="imgCadastro"></div>
                        <select class="form-select" name="status" required>
                            <option value="<?php echo $status ?>"><?php echo $status != null ? $status : '' ?></option>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                        <hr id="cdusuario">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="usuarioCadastro" class="form-label text-muted">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" id="inputCadUsuario" placeholder="name@example.com" name="email" value="<?php echo $emailfr; ?>" required>
                </div>
                <div class="d-flex flex-row-reverse">
                    <input type="submit" class="btn btn-primary ml-3 pe-auto mr-2 " id="btn-cadUsuario" name="submit" value="Cadastrar"></input>
                </div>
        </form>
        <div class="hide" id="modal"></div>
</body>
<script>
    function buscarUsuario() {
        const usuario = document.getElementById("inputCadUsuario").value;
        var url_string = window.location.href;
        var url = new URL(url_string);
        url.searchParams.set('usuario', usuario);
        window.location.href = url;
    }

    function toast(num) {
        if (num == 1) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Usuario cadastrado com sucesso!",
                background: "green",
            });
        } else if (num == 2) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "warning",
                title: "Usuário já cadastrado!",
                titleColor: "#fff",
                background: "#104EEF",
                iconColor: "#ffffff"
            });
        }
    }

    window.addEventListener('load', function() {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var data = url.searchParams.get("notificacao");
        if (data == 'jaCadastrado') {
            toast(2);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'http://localhost/cadastrodeusuario.php');
        }
    })
</script>

</html>