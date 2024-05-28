<?php
include('conexoes/config.php');
include('header.php');

$sql_unidades_count_query = "SELECT tipo FROM tipos ORDER BY tipo ASC";

$sql_unidades_count_query_exec = $conexao->query($sql_unidades_count_query) or die($conexao->error);
$user_data = $sql_unidades_count_query_exec->fetch_all(MYSQLI_ASSOC);

?>
<?php

foreach ($user_data as $row) {
  echo '<option value="' . $row['tipo'] . '">' . $row['tipo'] . '</option>';
}
?>


