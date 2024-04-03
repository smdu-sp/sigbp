<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <main class="container">
        <form class="login">
            <img src="./images/logo.jpg" class="logo" alt="Logo">
            <div class="input-box first">
                <img src="./images/usuario.png" class="input-img" id="logo-usuario" alt="Usuario">
                <input type="text" name="usuario" id="usuario" class="text-pass" placeholder="Usuário de rede">
            </div>
            <div class="input-box">
                <img src="./images/chave.png" class="input-img" id="chave" alt="Chave">
                <input type="password" name="senha" id="senha" class="text-pass" placeholder="Senha de rede">
            </div>
            <button type="submit"  class="btn-login">Entrar</button>
        </form>
    </main>
</body>
</html>