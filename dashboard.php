<?php
include_once('./conexoes/config.php');
include_once('header.php');
?>
<style>
    .icon-carrossel {
        width: 18px;
    }

    .icon-carrossel-i {
        width: 16px;
    }

    hr {
        opacity: 0.7;
        border: 0.1px solid #DDDFE2;
        width: 97%;
        margin-left: 12px;
    }

    .carrossel>a {
        font-size: 15px;
    }

    .carrossel>a:hover {
        text-decoration: none;
    }

    .carrossel {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .carrossel-text {
        text-decoration: none;
    }

    .carrossel-text:hover {
        text-decoration: none;
    }
</style>

<body>
    <?php
    include_once('menu.php');
    ?>
    <div class="p-4 p-md-4 pt-3 conteudo">
        <div class="carrossel mb-2">
            <a href="./home.php" class="mb-3 me-1">
                <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
            </a>
            <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
            <a href="./cadastrarbens.php" class="text-primary ms-1 carrossel-text">Dashboard</a>
        </div>
        <div class="d-flex">
            <div class="card d-flex text-center align-items-center mb-3 me-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title mb-3">Computador(Total)</h5>
                    <p class="card-text mb-3">1126</p>
                </div>
            </div>
