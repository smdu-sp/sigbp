<?php

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

?>