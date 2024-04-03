<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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
                <button class="btn-menu botoes"><img id="icon-casa" src="./images/icon-casa.png" alt="Icon Casa">Página Inicial</button>
                <button class="btn-menu botoes"><img id="icon-ferramenta" src="./images/icon-ferramenta.png" alt="Icon Ferramentas">Chamados</button>
                <div class="centralizar-linha"><hr></div>
                <p class="title-menu">Administração</p>
                <button class="btn-menu botoes"><img id="icon-usuario" src="./images/usuario.png" alt="Icon Usuario">Usuários</button>
                <button class="btn-menu botoes unidades"><img id="icon-unidades" src="./images/unidades.png" alt="Icon Unidades">Unidades</button>
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