<?php
include_once('header.php');
include_once('componentes/verificacao.php');

$permissao = $_SESSION['Perm'];

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
        <div class="menu-principal " id="menuPrincipal">
            <div class="menu-paginas">
                <p class="title-menu">Menu</p>
                <a href="./home.php" value="/home.php" id="botao1" class="btn-menu botoes admin"><img id="icon-casa" src="./images/icon-casa.png" alt="Icon Casa">Home</a>
                <a href="./usuarios.php?status=Ativo&permissao=4" value="/usuarios.php" id="botao5" class="btn-menu botoes admin"><img id="icon-usuario" src="./images/usuario.png" alt="Icon Usuario">Usuários</a>
                <a href="./unidades.php?status=Ativo" value="/unidades.php" id="botao6" class="btn-menu botoes admin"><img id="icon-dashboard" src="./images/unidades.png" alt="Icon Usuario">Unidades</a>
                <a href="./cadastrarbens.php" value="/cadastrarbens.php" id="botao2" class="btn-menu botoes admin"><img id="icon-computador" src="./images/icon-computador.png" alt="Icon Computador">Cadastro de Bens</a>
                <a href="./tiposdebens.php" value="/tiposdebens.php" id="botao7" class="btn-menu botoes admin"><img id="icon-dashboard" src="./images/icon-tipos.png" alt="Icon Usuario">Tipos de Bens</a>
                <a href="./inventario.php?ano=2024" value="/inventario.php" id="botao8" class="btn-menu botoes admin"><img id="icon-dashboard" src="./images/icons-inventory.png" alt="Icon Usuario">Inventário</a>
                <a href="./listaremovimentar.php?status=Ativo" value="/listaremovimentar.php" id="botao4" class="btn-menu botoes admin"><img id="icon-lista" src="./images/icon-lista.png" alt="Icon Lista">Listar/Movimentar Bens</a>
                <a href="./termo.php" value="/termo.php" id="botao3" class="btn-menu botoes mb-2"><img id="icon-termo" src="./images/icon-termo.png" alt="Icon Ferramentas">Termo Entrega/Retirada</a>
                <a href="./dashboard.php" value="/dashboard.php" id="botao9" class="btn-menu botoes admin"><img id="icon-dashboard" src="./images/icon-dashboard.png" alt="Icon Usuario">Dashboard</a>
            </div>
            <div class="info-usuario">
                <h3 class="nome-usuario"><?php
                    $nome = explode(' ', $_SESSION['SesNome']);
                    echo $nome[0] . " " . end($nome);
                    ?>
                </h3>
                <p class="email-usuario"><?php echo $_SESSION['SesE-mail'] ?></p>
                <div class="rf">
                    <p class="rf-usuario"><?php echo $_SESSION['SesID'] ?></p>
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
<script>
    var permissao = <?php echo json_encode($permissao); ?>;
    if (permissao == 2) {
        var botoes = document.querySelectorAll('.admin');
        botoes.forEach(function(botao) {
            botao.style.display = 'none';
        });
    }


    var url = window.location.href;
    var match = url.match(/\/([^\/]+)\.php$/);
    var nomePagina = match ? match[1] : null;
    var botoes = document.querySelectorAll('.btn-menu');

    var urlString = new URL(url);
    var pathName = urlString.pathname;
    console.log(pathName);

    botoes.forEach(function(botao) {
        var valorBotao = botao.getAttribute('value');
        if (pathName == '/pesquisar-item.php') {
            document.getElementById('botao4').style.background = '#DDE7EE';
        }

        if (pathName == '/pesquisar-home.php') {
            document.getElementById('botao1').style.background = '#DDE7EE';
        }

        if (pathName == '/pesquisar-usuario.php') {
            document.getElementById('botao5').style.background = '#DDE7EE';
        }

        if (pathName == '/pesquisar-unidades.php') {
            document.getElementById('botao6').style.background = '#DDE7EE';
        }

        if (pathName == '/pesquisar-inventario.php') {
            document.getElementById('botao8').style.background = '#DDE7EE';
        }

        if (pathName == '/alteracaodeusuario.php') {
            document.getElementById('botao5').style.background = '#DDE7EE';
        }

        if (pathName == '/cadastrodeunidades.php') {
            document.getElementById('botao6').style.background = '#DDE7EE';
        }

        if (pathName == '/historicodoitem.php') {
            document.getElementById('botao1').style.background = '#DDE7EE';
        }

        if (pathName == '/resultadodash.php') {
            document.getElementById('botao9').style.background = '#DDE7EE';
        }

        if (pathName === valorBotao) {
            botao.style.background = '#DDE7EE';
        }
    });
</script>

</html>