<?php
include('conexoes/config.php');
include('header.php');
include('componentes/permissao.php');
$sql_unidades_count_query = "SELECT sigla FROM unidades ORDER BY sigla ASC";

$sql_unidades_count_query_exec = $conexao->query($sql_unidades_count_query) or die($conexao->error);
$user_data = $sql_unidades_count_query_exec->fetch_all(MYSQLI_ASSOC);

?>

<?php
foreach ($user_data as $row) {
    echo '<option value="' . $row['sigla'] . '">' . $row['sigla'] . '</option>';
}
?>

