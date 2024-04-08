<?php
    include_once('header.php');
?>
<body>
    <div class="conteudo_menu">
        <nav class="menu-logout">
            <img class="img-menu logocdsp" id="logocdsp" src="./images/logo-cdsp.png" alt="Logo Cidade de São Paulo">
            <a href="login.php"><img class="img-menu logout" id="logout" src="./images/logout.png" alt=""></a>
        </nav>
        <div class="menu-principal">
            <div class="menu-paginas">
                <p class="title-menu">Menu</p>
                <a href="./home.php" class="btn-menu botoes btn-pg-inicial"><img id="icon-casa" src="./images/icon-casa.png" alt="Icon Casa">Home</a>
                <a href="./cadastrarbens.php" class="btn-menu botoes"><img id="icon-computador" src="./images/icon-computador.png" alt="Icon Computador">Cadastro de Bens</a>
                <a href="./cadastrodeusuario.php" class="btn-menu botoes"><img id="icon-usuario" src="./images/usuario.png" alt="Icon Usuario">Cadastro de Usuários</a>

                <div class="centralizar-linha">
                    <hr style="opacity: 1;">
                </div>
                <p class="title-menu">Administração</p>
                <a href="./listaremovimentar.php" class="btn-menu botoes"><img id="icon-lista" src="./images/icon-lista.png" alt="Icon Lista">Listar/Movimentar Bens</a>
                <a href="./termo.php" class="btn-menu botoes"><img id="icon-termo" src="./images/icon-termo.png" alt="Icon Ferramentas">Termo Entrega/Retirada</a>
                <a href="#" class="btn-menu botoes"><img id="icon-dashboard" src="./images/icon-dashboard.png" alt="Icon Usuario">Dashboard</a>
            </div>
            <div class="info-usuario">
                <h3 class="nome-usuario">João Costa</h3>
                <p class="email-usuario">jvcosta@prefeitura.sp.gov.br</p>
                <div class="informacao-adicional">
                    <div class="atic">ATIC</div>
                    <div class="desenvolvedor">Desenvolvedor</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>