<?php

if (isset($_POST['submit'])) {
    include_once('./conexoes/ldap.php');
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