<?php
$user = $_POST['usuario'] . "@rede.sp";
$psw = $_POST['senha'];
$dn = "OU=Users,OU=SMUL,DC=rede,DC=sp";
$search = "samaccountname=" . $_POST['usuario'];
?>