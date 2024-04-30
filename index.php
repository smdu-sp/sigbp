<?php
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

    require_once('./conexoes/conexao.php');


    $buscar_cadastros = "SELECT permissao, statususer FROM usuarios WHERE `usuario`='" . strtolower($inicial) . "';";
    $query_cadastros = mysqli_query($conn, $buscar_cadastros);

    if (mysqli_num_rows($query_cadastros) != 1) {
        header("location: erropermissao.php");
    } else {
        $resultado = mysqli_fetch_assoc($query_cadastros);
    }

    if ($data["count"] > 0) {
        for ($i = 0; $i < $data["count"]; $i++) {
            $nomefr = mysqli_real_escape_string($conn, $data[$i]["givenname"][0]) . " " . mysqli_real_escape_string($conn, $data[$i]["sn"][0]);
            $emailfr = mysqli_real_escape_string($conn, strtolower($data[$i]["mail"][0]));
        }

        $_SESSION['SesID'] = $inicial;
        $_SESSION['SesNome'] = $nomefr;
        $_SESSION['SesE-mail'] = $emailfr;
        $_SESSION['Perm'] =  $resultado['permissao'];
        $_SESSION['Status'] =  $resultado['statususer'];

        header('Location: index.php?m=entrou');
        exit;
    } else {
        $_SESSION = array();
        header('Location: index.php?m=erro');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    .swal2-title {
        color: #fff;
        font-size: 30px;
    }
</style>

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
        } else {
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
                titleColor: '#ffffff',
                background: 'green',
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
        }
    })
</script>

</html>