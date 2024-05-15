<?php
include_once 'conexoes/config.php';

$buscar_unidade = "SELECT unidades FROM unidades";
$query_lista = mysqli_query($conexao, $buscar_unidade);
?>

<select id="unidadeSelect" class="form-select" aria-label="Default select example">
  <option value="">Selecione unidades</option>
  <?php
  while ($row = mysqli_fetch_assoc($query_lista)) {
    echo '<option value="' . $row['unidades'] . '">' . $row['unidades'] . '</option>';
  }
  ?>
</select>