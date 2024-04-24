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
        unset ($_SESSION['SesID']);
        unset ($_SESSION['SesNome']);
        unset ($_SESSION['SesE-mail']);
        unset ($_SESSION['Perm']);
        unset ($_SESSION['Status']);
        header('location: index?m=erro');
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
<style>
    #modal {
        position: relative;
        width: 100%;
    }
    
    #absolute {
        position: absolute;
        bottom: 270px;
        right: 30px;
        width: 330px;
        height: 112px;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: msg-erro 0.8s ease;
    }

    @keyframes msg-erro {
        from {
            transform: translateY(-100%);
        }
        
        to {
            transform: translateY(0);
        }
    }
    
    #none {
        display: none;
    }
    
    #erro {
        position: fixed;
        height: 40px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 20px;
        color: #fff;
    }

    .erro {
        background-color: #C41C1C;
    }
    
    .sucess {
        background-color: #1F7A1F;
    }
    
    .text-msg > h4 {
        font-size: 20px;
    }
    
    .text-msg > p {
        font-size: 16px;
        margin-top: 10px;
    }

    .img-x {
      width: 30px;
      height: 30px;
      margin-right: 20px;
    }
</style>

<body>
    <div id="modal">
        <main class="container">
            <form class="login" method="post">
            <?php
            $token = uniqid();
            $_SESSION['token'] = $token;
            ?>
            <input type="hidden" name="token" value="<?php echo $token; ?>" />
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
        <div id="absolute none" class="erro">
            <div id="erro">
                <img src="./images/icon-x.png" alt="" class="img-x">
                <div class="text-msg">
                    <h4>Credenciais incorretas!</h4>
                    <p>Tente novamente!</p>
                </div>
            </div>
        </div>
        <div id="absolute none" class="sucess">
            <div id="erro">
                <img src="./images/icon-check.png" alt="" class="img-x">
                <div class="text-msg">
                    <h4>Bem-vindo!</h4>
                    <p>Login efetuado com sucesso.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>