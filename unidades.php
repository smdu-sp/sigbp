<?php
session_start();
include_once('conexoes/config.php');
include_once('header.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    setcookie('recordsPerPage_unidade', $limit, time() + (86400 * 30), "/");
} else if (isset($_COOKIE['recordsPerPage_unidade'])) {
    $limit = $_COOKIE['recordsPerPage_unidade'];
} else {
    $limit = 10;
}

if (isset($_GET['nome']) && isset($_GET['inativo'])) {
    if (isset($_GET['limit'])) {
        $limit = $_GET['limit'];
    } else {
        $limit = 10;
    }

    $nome = $_GET['nome'];
    $inativo = $_GET['inativo'];

    $result = mysqli_query($conexao, "UPDATE unidades SET statusunidade = '$inativo' WHERE sigla = '$nome'");

    header("Location: unidades.php?limit=" . $limit . "&notificacao=alterado&status=Ativo&permissao=4&unidade=&pesquisar=");
}

if (isset($_GET['nome']) && isset($_GET['reativar'])) {
    if (isset($_GET['limit'])) {
        $limit = $_GET['limit'];
    } else {
        $limit = 10;
    }

    $nome = $_GET['nome'];
    $reativar = $_GET['reativar'];

    $result = mysqli_query($conexao, "UPDATE unidades SET statusunidade = '$reativar' WHERE sigla = '$nome'");

    header("Location: unidades.php?limit=" . $limit . "&notificacao=alterado&status=Ativo&permissao=4&unidade=&pesquisar=");
}

$condicoes = [];

if (isset($_GET['nome']) && $_GET['nome'] !== '') {
    $condicoes[] = "unidades = '{$_GET['nome']}'";
}

if (isset($_GET['pesquisar']) && $_GET['pesquisar'] !== '') {
    $valor_pesquisar = $_GET['pesquisar'];
    $condicoes[] = "(unidades LIKE '%$valor_pesquisar%' OR sigla LIKE '%$valor_pesquisar%' OR codigo LIKE '%$valor_pesquisar%' OR statusunidade LIKE '%$valor_pesquisar%')";
}

if (isset($_GET['status']) && $_GET['status'] !== '') {
    if ($_GET['status'] != 'TODOS') {
        $condicoes[] = "statusunidade = '{$_GET['status']}'";
    }
}

if (isset($_GET['sigla']) && $_GET['sigla'] !== '') {
    $condicoes[] = "sigla = '{$_GET['sigla']}'";
}

$where = '';
if (!empty($condicoes)) {
    $where = " WHERE " . implode(" AND ", $condicoes);
}

$busca = "SELECT * FROM unidades $where ORDER BY sigla ASC";

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$sql_unidades_query = "$busca LIMIT {$limit} OFFSET {$offset}";
$sql_unidades_query_exec = $conexao->query($sql_unidades_query) or die($conexao->error);

$sql_unidades_count_query = "SELECT COUNT(*) as c FROM unidades $where";
$sql_unidades_count_query_exec = $conexao->query($sql_unidades_count_query) or die($conexao->error);

$sql_unidades_count = $sql_unidades_count_query_exec->fetch_assoc();
$unidades_count = $sql_unidades_count['c'];

$page_number = ceil($unidades_count / $limit);
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$unidade = isset($_GET['unidade']) ? $_GET['unidade'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
?>
<style>
    .container-msg-inativo,
    .container-msg-reativar {
        width: 100%;
        display: flex;
        justify-content: center;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 10000;
    }

    .msg-inativo,
    .msg-reativar {
        width: 340px;
        height: 170px;
        background-color: #104EEF;
        color: #fff;
        border-radius: 8px;
        padding: 20px 35px 20px 20px;
        margin-top: 20px;
        animation: msg-inativo 1s ease;
    }

    .msg-trocar,
    .msg-reativar {
        display: none;
    }

    @keyframes msg-inativo {
        from {
            transform: translateY(-100%);
        }

        to {
            transform: translateY(0%);
        }
    }

    .msg-inativo>h3,
    .msg-reativar>h3 {
        font-size: 20px;
        font-family: 'Lato', sans-serif;
        font-weight: bolder;
    }

    .msg-inativo>p,
    .msg-reativar>p {
        font-size: 18px;
        font-family: 'Lato', sans-serif;
        font-weight: 500;
        margin: 10px 0px 18px;
    }

    .btn-msg-inativo,
    .btn-msg-reativar {
        font-size: 16px;
        font-weight: bold;
        font-family: 'Lato', sans-serif;
        padding: 8px 16px;
        color: white;
        background-color: #104EEF;
        border: 1px solid #4B7AF3;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-msg-inativo:hover,
    .btn-msg-reativar:hover {
        text-decoration: none;
    }

    .btn-msg-inativo.inativo,
    .btn-msg-reativar.reativar {
        background-color: #fff;
        color: #104EEF;
        margin-right: 5px;
        border: none;
    }

    @media (max-width: 1600px) {
        .conteudo {
            margin-left: 75px;
            width: 95%;
        }

        .conteudo_menu {
            width: 70px;
        }

        .menu-principal {
            position: fixed;
            top: 0;
            left: -187px;
            z-index: 999999 !important;
            transition: all .5s ease;
        }

        .menu-logout {
            z-index: 1000000 !important;
        }

        .aparecer {
            left: 70px !important;
        }

        .menu-button {
            display: block;
            cursor: pointer;
        }
    }

    #img-recarregar {
        width: 22px;
        height: 22px;
    }

    .btn-filtrar {
        width: 40px;
        height: 40px;
        margin-bottom: 7px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-filtrar>img {
        width: 25px;
        height: 25px;
    }

    .records-per-page_unidade {
        margin-top: 10px;
    }

    .records-per-page_unidade>label {
        margin-right: 10px;
    }

    #recordsPerPage_unidade {
        border: none;
        margin-right: 2px;
        font-size: 14px;
    }
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="container-msg-inativo">
        <div class="msg-inativo msg-trocar" id="box-inativo">
            <h3>Você está trocando o usuário para Inativo.</h3>
            <p>Tem certeza de que deseja trocar?</p>
            <div class="box-msg-inativo">
                <a onclick="trocarInativo()" href="#" class="btn-msg-inativo inativo">Sim</a>
                <a onclick="fecharMsgInativo()" class="btn-msg-inativo">Não</a>
            </div>
        </div>
    </div>
    <div class="container-msg-reativar">
        <div class="msg-inativo msg-trocar" id="box-reativar">
            <h3>Você está trocando o usuário para Ativo.</h3>
            <p>Tem certeza de que deseja trocar?</p>
            <div class="box-msg-reativar">
                <a onclick="trocarReativar()" href="#" class="btn-msg-reativar reativar">Sim</a>
                <a onclick="fecharMsgReativar()" class="btn-msg-reativar">Não</a>
            </div>
        </div>
    </div>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel-box mb-4">
            <div class="carrossel">
                <a href="./home.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
                <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
                <a href="./unidades.php" class="text-primary ms-1 carrossel-text">Unidades</a>
            </div>
        </div>
        <h2 class="mb-3 mt-4">Unidades</h2>
        <div class="conteudo ml-1 mt-4" style="width: 100%;">
            <div class="d-flex justify-content-center flex-column" style="width: 100%;">
                <div class="d-flex justify-content-end align-items-end" action="unidades.php" method="GET" style="width: 100%;">
                    <input type="hidden" name="limit" value="<?php echo $limit; ?>">
                    <a href="#" onclick="recarregar()" class="mb-2 mr-2 usuario-img" id="recarregar" style="cursor: pointer;">
                        <img src="./images/icon-recarregar.png" alt="#" id='img-recarregar'>
                    </a>
                    <a class="mb-2 mr-2 usuario-img" onclick='limparInput()' id="limpar" style="cursor: pointer;">
                        <img src="./images/limpar.png" alt="#" id='img-recarregar'>
                    </a>
                    <div class="col-2 ml-2 mb-2">
                        <p class="mb-1 text-muted">Status:</p>
                        <select id="statusSelect" class="form-select" onchange="filtrar()" aria-label="Default select example" name="status">
                            <option value="<?php echo empty($status) ? 'ATIVO' : htmlspecialchars(strtoupper($status)); ?>" hidden><?php echo empty($status) ? 'ATIVO' : htmlspecialchars(strtoupper($status)); ?></option>
                            <option value="ATIVO">ATIVO</option>
                            <option value="INATIVO">INATIVO</option>
                            <option value="TODOS">TODOS</option>
                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <p class="mb-1 text-muted">Sigla:</p>
                        <select id="siglaSelect" class="form-select" onchange="filtrar()" aria-label="Default select example" name="sigla">
                            <option value="<?php echo empty($_GET['sigla']) ? '' : strtoupper($_GET['sigla']); ?>" hidden><?php echo empty($_GET['sigla']) ? 'Selecionar' : strtoupper($_GET['sigla']); ?></option>
                            <?php
                            include 'query-unidades.php'
                            ?>
                        </select>
                    </div>
                    <div class="col-6 mb-2">
                        <p class="mb-1 text-muted">Buscar:</p>
                        <input class="form-control buscar" onchange="filtrar()" id="myInput" name="pesquisar" type="text" placeholder="Procurar..." value="<?php echo isset($_GET['pesquisar']) ? htmlspecialchars($_GET['pesquisar']) : ''; ?>">
                    </div>
                </div>
                <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Sigla</th>
                            <th>Codigo</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id='myTable'>
                        <?php
                        while ($user_data = $sql_unidades_query_exec->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>" . $user_data['unidades'] . "</td>";
                            echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>" . $user_data['sigla'] . "</td>";
                            echo "<td style=' cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>" . $user_data['codigo'] . "</td>";
                            echo "<td style='cursor: pointer; background-color:hover: grey;' onclick=location.href='cadastrodeunidades.php?id=$user_data[id]'>" . $user_data['statusunidade'] . "</td>";
                            echo "<td>";
                            if ($user_data['statusunidade'] == 'INATIVO' || $user_data['statusunidade'] == 'Inativo') {
                                echo "<a class='x-imageReativar' id='tooltip2' onclick='mostrarMsgReativar(\"{$user_data['sigla']}\")'><span id='tooltipText2'>Reativar</span><img class='img-reativar' src='./images/icon-reativar.png' alt='inativo'></a>";
                            } else {
                                echo "<a class='x-image' id='tooltip2' onclick='mostrarMsgInativo(\"{$user_data['sigla']}\")'><span id='tooltipText2'>Excluir</span><img class='img-usuario' src='./images/icons-x.png' alt='x'></a>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class='pagination-controls'>
                <div class='records-per-page_unidade'>
                    <label for='recordsPerPage_unidade'>Registros por página:</label>
                    <select id='recordsPerPage_unidade' onchange="filtrar()">
                        <option value='<?php echo $limit ?>' selected hidden> <?php echo $limit ?></option>
                        <option value='5'>5</option>
                        <option value='10'>10</option>
                    </select>
                </div>
                <div class='page-info'>Página <?php echo $page; ?> de <?php echo $page_number; ?></div>
                <?php
                $opacidade_esquerda = ($page == 1) ? '0.5' : '1';
                $opacidade_direita = ($page == $page_number) ? '0.5' : '1';
                $disabled_esquerda = ($opacidade_esquerda == '0.5') ? 'disabled' : '';
                $disabled_direita = ($opacidade_direita == '0.5') ? 'disabled' : '';

                $status = isset($_GET['status']) ? $_GET['status'] : '';
                $pesquisar =  isset($_GET['pesquisar']) ? $_GET['pesquisar'] : '';
                $sigla = isset($_GET['sigla']) ? $_GET['sigla'] : '';

                echo "<a href='?page=" . ($page - 1) . "&limit=" . $limit . "&status=" . $status . "&sigla=" . $sigla  . "&pesquisar=" . $pesquisar . "' class='arrow-button esquerda" . ($disabled_esquerda ? ' disabled' : '') . "' id='esquerda" . ($disabled_esquerda ? '-disabled' : '') . "' style='opacity: {$opacidade_esquerda}' {$disabled_esquerda} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoE.png' alt='#' class='arrow-icon'></a>";
                echo "<a href='?page=" . ($page + 1) . "&limit=" . $limit . "&status=" . $status . "&sigla=" . $sigla  . "&pesquisar=" . $pesquisar . "' class='arrow-button direita" . ($disabled_direita ? ' disabled' : '') . "' id='direita" . ($disabled_direita ? '-disabled' : '') . "' style='opacity: {$opacidade_direita}' {$disabled_direita} onclick='passarValorBuscar()'><img src='./images/icon-paginacaoD.png' alt='#' class='arrow-icon'></a>";

                ?>
            </div>
            <div class="d-flex justify-content-end mt-4 mr-2">
                <a href="./cadastrodeunidades.php" id="btn-adc-usuario">
                    <img src="./images/icons-adcUsuario.png" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="hide" id="modal"></div>
</body>
<script>
    function mostrarMsgInativo(nome) {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        var paramValue = urlParams.get('limit');
        if (paramValue == null) {
            paramValue = '10';
        }
        let newUrl = 'unidades.php?nome=' + nome + '&limit=' + paramValue;
        window.history.pushState({
            path: newUrl
        }, '', newUrl);
        let msgSair = document.getElementById("box-inativo");
        msgSair.style.display = "block";
    }

    function mostrarMsgReativar(nome) {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        var paramValue = urlParams.get('limit');
        if (paramValue == null) {
            paramValue = '10';
        }
        let newUrl = 'unidades.php?nome=' + nome + '&limit=' + paramValue;
        window.history.pushState({
            path: newUrl
        }, '', newUrl);
        let msgSair = document.getElementById("box-reativar");
        msgSair.style.display = "block";
    }

    function filtrar() {
        var selectElement = document.getElementById('recordsPerPage_unidade');
        var selectedValue = selectElement.value;
        var selectedStatus = document.getElementById('statusSelect').value;
        var selectedSigla = document.getElementById('siglaSelect').value;
        var selectedPesquisar = document.getElementById('myInput').value;
        localStorage.setItem('recordsPerPage_unidade', selectedValue);
        window.location.href = '?limit=' + selectedValue + '&status=' + selectedStatus + '&sigla=' + selectedSigla + '&pesquisar=' + selectedPesquisar;
    }

    function trocarReativar() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const paramValue = urlParams.get('nome');
        window.location.href = '?nome=' + paramValue + '&reativar=' + 'Ativo';

        let msgSair = document.getElementById("box-reativar");
        msgSair.style.display = "none";
    }

    function trocarInativo() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const paramValue = urlParams.get('nome');
        window.location.href = '?nome=' + paramValue + '&inativo=' + 'Inativo';

        let msgSair = document.getElementById("box-inativo");
        msgSair.style.display = "none";
    }

    function fecharMsgInativo() {
        let msgSair = document.getElementById("box-inativo");
        msgSair.style.display = "none";
    }

    function fecharMsgReativar() {
        let msgSair = document.getElementById("box-reativar");
        msgSair.style.display = "none";
    }


    function limparInput() {
        window.location.href = 'unidades.php?status=Ativo';
    }

    function recarregar() {
        window.location.reload(true);
    }

    document.addEventListener('DOMContentLoaded', function() {
        var storedLimit = localStorage.getItem('recordsPerPage_unidade');
        if (storedLimit) {
            document.getElementById('recordsPerPage_unidade').value = storedLimit;
        }

        document.querySelectorAll('.arrow-button.disabled').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
            });
        });
    });

    function alert(num) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            if (num == 1) {
                Toast.fire({
                    customClass: {
                        title: 'swal2-title'
                    },
                    icon: "success",
                    title: "Unidade alterada com sucesso!",
                    background: 'green',
                    iconColor: '#ffffff'
                });
                setTimeout(() => {
                    window.history.replaceState({}, document.title, window.location.pathname);
                    window.location.href = 'unidades.php?status=ATIVO';
                }, 1800); 
            } else if (num == 3) {
                Toast.fire({
                    customClass: {
                        title: 'swal2-title'
                    },
                    icon: "success",
                    title: "Unidade cadastrada com sucesso!",
                    background: 'green',
                    iconColor: '#ffffff'
                });
                setTimeout(() => {
                    window.history.replaceState({}, document.title, window.location.pathname);
                    window.location.href = 'unidades.php?status=ATIVO';
                }, 1800); 
            }
        }

        window.addEventListener('load', function () {
            var url_string = window.location.href;
            var url = new URL(url_string);
            var data = url.searchParams.get("notificacao");
            console.log(data); 
            if (data == 'alterado') {
                alert(1);
            } else if (data == 'cadastrado') {
                alert(3);
            }
        });
</script>