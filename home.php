<?php
    include_once('menu.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/home.css">
</head>
<body>
    <section class="home">
        <label for="Servidor">Servidor:</label>
        <input type="text" class="filtro-text" name="filtro-text" id="filtro-text">
        <select name="outros-filtro" id="filtro" class="filtro-text">
            <option value="Nº Patrimônio">Número do Patrimônio</option>
            <option value="Nome Item">Nome Item</option>
            <option value="Descrição do Bem">Descrição do Bem</option>
            <option value="Localização">Localização</option>
            <option value="Servidor">Servidor</option>
            <option value="Responsável">Responsável</option>
            <option value="CIMBPM">CIMBPM</option>
        </select>
        <button type="button" class="btn-filtro home-botoes">Filtrar<img class="img-filtro" src="./images/icon-filtro.png" alt="Filtro"></button>   
        <button type="button" class="limpar-filtro home-botoes">Limpar Filtro<img class="img-filtro" src="./images/icon-limpar.png" alt=""></button>  
    </section>
</body>
</html>