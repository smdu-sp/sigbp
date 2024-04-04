<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SisGP - Sistema de Gerenciamento de Patrimônio</title>
    <link rel="shortcut icon" href="./images/logo-cdsp.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/menu.css">
</head>
<body>
    <div class="container">
        <nav class="menu-logout">
            <img class="img-menu logocdsp" id="logocdsp" src="./images/logo-cdsp.png" alt="Logo Cidade de São Paulo" >
            <a href="login.php"><img class="img-menu logout" id="logout" src="./images/logout.png" alt=""></a>
        </nav>
        <menu class="menu-principal">
            <div class="menu-paginas">
                <p class="title-menu">Menu</p>
                <a href="./home.php" class="btn-menu botoes btn-pg-inicial"><img id="icon-casa" src="./images/icon-casa.png" alt="Icon Casa">Home</a>
                <a href="./cadastrarbens.php" class="btn-menu botoes"><img id="icon-ferramenta" src="./images/icon-computador.png" alt="Icon Ferramentas">Cadastro de Bens</a>
                <a href="#" class="btn-menu botoes"><img id="icon-ferramenta" src="./images/usuario.png" alt="Icon Ferramentas">Cadastro de Usuários</a>

                <div class="centralizar-linha"><hr></div>
                <p class="title-menu">Administração</p>
                <a href="#" class="btn-menu botoes"><img id="icon-ferramenta" src="./images/icon-lista.png" alt="Icon Ferramentas">Listar/Movimentar Bens</a>
                <a href="#" class="btn-menu botoes"><img id="icon-ferramenta" src="./images/icon-usuarios.png" alt="Icon Ferramentas">Listar Usuários</a>
                <a href="#" class="btn-menu botoes"><img id="icon-usuario" src="./images/icon-dashboard.png" alt="Icon Usuario">Dashboard</a>
            </div>
            <div class="info-usuario">
                <h3 class="nome-usuario">João Costa</h3>
                <p class="email-usuario">jvcosta@prefeitura.sp.gov.br</p>
                <div class="informacao-adicional">
                    <div class="atic">ATIC</div>
                    <div class="desenvolvedor">Desenvolvedor</div>
                </div>
            </div>
        </menu>
    </div>
</body>
</html>