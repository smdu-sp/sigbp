<?php

session_start();

if (isset($_POST['submit'])) {
    $server = "ldap://10.10.65.242";
    $user = $_POST['usuario'] . "@rede.sp";
    $psw = $_POST['senha'];
    $inicial = $_POST['usuario'];
    $dn = "OU=Users,OU=SMUL,DC=rede,DC=sp";
    $search = "samaccountname=" . $_POST['usuario'];

    $ds = ldap_connect($server);
    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    $r = ldap_bind($ds, $user, $psw);

    if (!$r) {
        header('Location: index.php?m=erro');
        exit;
    }

    $sr = ldap_search($ds, $dn, $search);
    $data = ldap_get_entries($ds, $sr);

    session_start();

    require_once('./conexoes/config.php');


    $buscar_cadastros = "SELECT permissao, statususer FROM usuarios WHERE `usuario`='" . strtolower($inicial) . "';";
    $query_cadastros = mysqli_query($conexao, $buscar_cadastros);

    if (mysqli_num_rows($query_cadastros) == 3) {
        header("location: index.php?erropermissao");
    } else {
        $resultado = mysqli_fetch_assoc($query_cadastros);
    }


    $buscar_usuario = "SELECT usuario FROM usuarios WHERE `usuario`='" . strtolower($inicial) . "';";
    $query_usuario = mysqli_query($conexao, $buscar_usuario);

    $buscar_permisao = "SELECT permissao FROM usuarios WHERE `usuario`='" . strtolower($inicial) . "';";
    $query_usuario = mysqli_query($conexao, $buscar_permisao);
    $row = mysqli_fetch_assoc($query_usuario);
    $permissao = $row['permissao'];


    if (mysqli_num_rows($query_usuario) == 1 && $permissao !=3) {
        if ($data["count"] > 0) {
            for ($i = 0; $i < $data["count"]; $i++) {
                $nomefr = mysqli_real_escape_string($conexao, $data[$i]["givenname"][0]) . " " . mysqli_real_escape_string($conexao, $data[$i]["sn"][0]);
                $emailfr = mysqli_real_escape_string($conexao, strtolower($data[$i]["mail"][0]));
            }
    
            $_SESSION['SesID'] = $inicial;
            $_SESSION['SesNome'] = $nomefr;
            $_SESSION['SesE-mail'] = $emailfr;
            $_SESSION['Perm'] =  $resultado['permissao'];
            $_SESSION['Status'] =  $resultado['statususer'];
    
            header('Location: index.php?m=entrou');
            $_SESSION['logado'] = true;
            exit;
        } else {
            $_SESSION = array();
            header('Location: index.php?m=erro');
            exit;
        }
    } else {
        $buscar_login = "SELECT * FROM usuarios WHERE usuario = '" . $_SESSION['SesID'] . "'; ";
        if(mysqli_num_rows($query_usuario) == 1) {
            header('Location: index.php?m=erroPermissao');
            exit;
        } else {
            $_SESSION = array();
            $nome = $_SESSION['SesNome'];
            $result = mysqli_query($conexao, "INSERT INTO usuarios(usuario, nome, statususer) VALUES ('$inicial', '$nome', 'ativo')");
            header('Location: index.php?m=erroPermissao');
            exit;
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SisGP - Sistema de Gerenciamento de Patrimônio</title>
    <link rel="shortcut icon" href="./images/logo-cdsp.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div id="modal">
        <main class="container">
            <form id="loginForm" class="login" method="post">
                <img src="./images/logo.jpg" class="logo" alt="Logo">
                <div class="input-box first">
                    <img src="./images/usuario.png" class="input-img" id="logo-usuario" alt="Usuario">
                    <input type="text" name="usuario" id="usuario" class="text-pass" placeholder="Usuário de rede" required>
                </div>
                <div class="input-box">
                    <img src="./images/chave.png" class="input-img" id="chave" alt="Chave">
                    <input type="password" name="senha" id="senha" class="text-pass" placeholder="Senha de rede" required>
                </div>
                <input type="submit" name="submit" class="btn-login" value="Entrar" id="button">
            </form>
        </main>
    </div>
</body>
<script>
    function alert(num) {
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
                customClass: ({
                    title: 'swal2-title'
                }),
                icon: "error",
                title: "Credenciais incorretas!",
                titleColor: '#ffffff',
                background: 'red',
                iconColor: '#ffffff'
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
                customClass: ({
                    title: 'swal2-title'
                }),
                icon: "success",
                title: "Seja bem-vindo!",
                background: 'green',
                iconColor: '#ffffff'
            });
        } else if (num == 3) {
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
                title: "Por favor, inserir usuário e senha!",
                background: "#104EEF",
                iconColor: '#ffffff'
            });
        } else if (num == 4) {
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
                icon: "error",
                title: "Você não tem permissão para acessar esse sistema!",
                background: "#104EEF",
                iconColor: '#ffffff'
            });
        }
    }

    window.addEventListener('load', function() {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var data = url.searchParams.get("m");
        if (data == 'erro') {
            alert(1);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'http://localhost/index.php');
        } else if (data == 'entrou') {
            alert(2);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'http://localhost/home.php');
            setInterval(function() {
                window.location.href = 'home.php';
            }, 1100);
        } else if (data == 'faltaLogar') {
            alert(3);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'http://localhost/index.php');
        } else if (data == 'erroPermissao') {
            alert(4);
            window.history.replaceState({}, document.title, window.location.pathname);
            history.pushState({}, '', 'http://localhost/index.php');
        }
    })
</script>

</html>