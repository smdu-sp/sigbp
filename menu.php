<?php
    @session_start();
    include_once('header.php');
?>
<style>

</style>
<body>
    <div class="conteudo_menu">
        <nav class="menu-logout">
            <div>
                <img class="img-menu menu-button" onclick="menu()" src="./images/icon-menu.png" alt="Menu">
                <a href="./home.php"><img class="img-menu logocdsp" id="logocdsp" src="./images/logo-cdsp.png" alt="Logo Cidade de São Paulo"></a>
            </div>
            <a href="login.php"><img class="img-menu logout" id="logout" src="./images/logout.png" alt=""></a>
        </nav>
        <div class="menu-principal" id="menuPrincipal">
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
                <h3 class="nome-usuario"><?php echo $_SESSION['SesNome'] ?></h3>
                <p class="email-usuario"><?php echo $_SESSION['SesE-mail'] ?></p>
            </div>
        </div>
    </div>
</body>
<script>
    function menu() {
        let menuPrincipal = document.getElementById('menuPrincipal');
        menuPrincipal.classList.toggle('aparecer');
    }
</script>
</html>
