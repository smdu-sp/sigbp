<?php
include_once('header.php');
?>

<body>
    <div class="conteudo_menu z-3">
        <nav class="menu-logout">
            <div>
                <img class="img-menu menu-button" onclick="menu()" src="./images/icon-menu.png" alt="Menu">
                <a href="./home.php"><img class="img-menu logocdsp" id="logocdsp" src="./images/logo-cdsp.png" alt="Logo Cidade de São Paulo"></a>
            </div>
            <a href="#" id="tooltip" onclick="sair()">
                <span id="tooltipText">Sair</span>
                <img class="img-menu logout" id="logout" src="./images/logout.png" alt="">
            </a>
        </nav>
        <div class="menu-principal" id="menuPrincipal">
            <div class="menu-paginas">
                <p class="title-menu">Menu</p>
                <a href="./home.php" id="botaoHome" class="btn-menu botoes"><img id="icon-casa" src="./images/icon-casa.png" alt="Icon Casa">Home</a>
                <a href="./cadastrarbens.php" id="botao2" class="btn-menu botoes"><img id="icon-computador" src="./images/icon-computador.png" alt="Icon Computador">Cadastro de Bens</a>
                <a href="./termo.php" id="botao5" class="btn-menu botoes"><img id="icon-termo" src="./images/icon-termo.png" alt="Icon Ferramentas">Termo Entrega/Retirada</a>
                
                <div class="centralizar-linha">
                    <hr style="opacity: 0.7; border: 0.1px solid #DDDFE2; margin-right: 12px">
                </div>
                <p class="title-menu">Administração</p>
                <a href="./listaremovimentar.php" id="botao4" class="btn-menu botoes"><img id="icon-lista" src="./images/icon-lista.png" alt="Icon Lista">Listar/Movimentar Bens</a>
                <a href="./cadastrodeusuario.php" id="botao3" class="btn-menu botoes"><img id="icon-usuario" src="./images/usuario.png" alt="Icon Usuario">Cadastro de Usuários</a>
                <a href="./dashboard.php" id="botao6" class="btn-menu botoes"><img id="icon-dashboard" src="./images/icon-dashboard.png" alt="Icon Usuario">Dashboard</a>
            </div>
            <div class="info-usuario">
                <h3 class="nome-usuario"><?php 
                $nome = explode(' ', $_SESSION['SesNome']);
                echo $nome[0] . " " . end($nome);
                ?></h3>
                <p class="email-usuario"><?php echo $_SESSION['SesE-mail'] ?></p>
                <div class="rf">
                    <p class="email-usuario"><?php echo $_SESSION['SesID'] ?></p>
                </div>
            </div>
        </div>
        <div class="container-msg-logout">
            <div class="msg-sair msg" id="box-sair">
                <h2>Você está saindo.</h2>
                <p>Tem certeza de que deseja sair?</p>
                <div class="box-msg-sair">
                    <a href="?sair" class="btn-msg-sair sim">Sim</a>
                    <a onclick="fecharMsg()" class="btn-msg-sair">Não</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>