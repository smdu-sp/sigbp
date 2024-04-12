<?php
 
    if (isset($_POST['submit'])) {
     
        $server = "ldap://10.10.65.242";
        $ID_Usuario = mb_strtolower($_POST['usuario'], 'UTF-8');
        $user = $_POST['usuario'] . "@rede.sp";
        $psw = $_POST['senha'];
        $inicial = $_POST['usuario'];
        $permissao = substr($inicial, -6);
        $dn = "OU=Users,OU=SMUL,DC=rede,DC=sp";
     
        $search = "samaccountname=" . $_POST['usuario'];  //"samaccountname=".$user; ou userprincipalname //
     
        $ds = ldap_connect($server);
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3); // Corrige problema com "ç"
        $r = ldap_bind($ds, $user, $psw);
        $sr = ldap_search($ds, $dn, $search);
        $data = ldap_get_entries($ds, $sr);
     
        session_start();
     
        require_once './conexoes/conexao.php';
     
        mysqli_set_charset($conn, "utf8");
     
        $buscar_cadastros = "SELECT permissao, statususer FROM usuarios WHERE `usuario`='" . strtolower($inicial) . "';";
        $query_cadastros = mysqli_query($conn, $buscar_cadastros);
     
        if (mysqli_num_rows($query_cadastros) != 1) {
            header("location: erropermissao.php");
        } else {
            $resultado = mysqli_fetch_assoc($query_cadastros);
        }
     
        if ($data["count"] == 0) {
            $_SESSION = array(); // Limpa todas as variáveis de sessão
            header('location:index.php?m=erro');
        } else {
        for ($i = 0; $i < $data["count"]; $i++) {
            $nomefr = mysqli_real_escape_string($conn, $data[$i]["givenname"][0]) . " " . mysqli_real_escape_string($conn, $data[$i]["sn"][0]);
            $emailfr = mysqli_real_escape_string($conn, strtolower($data[$i]["mail"][0]));
        }
        $_SESSION['SesID'] = "yourdata";
        echo '<script> sessionStorage.setItem("user", "' . $_SESSION['data'] . '");</script>';
     
        $_SESSION['SesID'] = $inicial;
        $_SESSION['SesNome'] = $nomefr;
        $_SESSION['SesE-mail'] = $emailfr;
        $_SESSION['Perm'] =  $resultado['permissao'];
        $_SESSION['Status'] =  $resultado['statususer'];
     
        header('Location: http://localhost/home.php');
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
</head>
<body>
    <main class="container">
        <form class="login" method="post">
            <img src="./images/logo.jpg" class="logo" alt="Logo">
            <div class="input-box first">
                <img src="./images/usuario.png" class="input-img" id="logo-usuario" alt="Usuario">
                <input type="text" name="usuario" id="usuario" class="text-pass" placeholder="Usuário de rede">
            </div>
            <div class="input-box">
                <img src="./images/chave.png" class="input-img" id="chave" alt="Chave">
                <input type="password" name="senha" id="senha" class="text-pass" placeholder="Senha de rede">
            </div>
            <input type="submit" name="submit" class="btn-login" value="Entrar" id="button">
        </form>
    </main>
</body>
</html>