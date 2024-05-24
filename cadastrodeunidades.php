<?php
session_start();
include_once('header.php');
include_once('./conexoes/config.php');
include_once('componentes/verificacao.php');
include_once('componentes/permissao.php');

$sql = "SELECT * FROM item ORDER BY idbem ASC";
$result = $conexao->query($sql) or die($mysqli->error);

isset($_GET['id']) ? $id = $_GET['id'] : $id = null;

echo '' . $id . '';

if ($id) {

  if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $codigo = $_POST['codigo'];
    $sigla = $_POST['sigla'];
    $status = $_POST['status'];

    $result = mysqli_query($conexao, "UPDATE unidades SET unidades = '$nome', sigla = '$sigla', codigo = '$codigo', statusunidade = '$status' WHERE id = $id");

    header("Location: unidades.php?notificacao=alterado");
  } else {
    $buscar_unidade = "SELECT * FROM unidades WHERE id = $id;";
    $query_usuario = mysqli_query($conexao, $buscar_unidade);
    $row = mysqli_fetch_assoc($query_usuario);

    $unidade = $row['unidades'];
    $sigla = $row['sigla'];
    $codigo = $row['codigo'];
    $status = $row['statusunidade'];
  }
} else if (isset($_POST['submit'])) {
  $nome = $_POST['nome'];
  $codigo = $_POST['codigo'];
  $sigla = $_POST['sigla'];
  $status = $_POST['status'];

  $result = mysqli_query($conexao, "INSERT INTO unidades(unidades, sigla, codigo, statusunidade) VALUES ('$nome', '$sigla', '$codigo', '$status')");

  header("Location: unidades.php?notificacao=cadastrado");
}
?>
<style>
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

  .card {
    padding: 30px 20px;
    margin-bottom: 30px;
  }
</style>

<body>
  <?php
  include_once('menu.php');
  ?>
  <div class="p-4 p-md-4 pt-3 conteudo">
    <div class="carrossel-box mb-2">
      <div class="carrossel">
        <a href="./home.php" class="mb-3 me-1"><img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt=""></a>
        <img src="./images/icon-avancar.png" class="icon-carrossel-avancar" alt="icon-avancar">
        <a href="./unidades.php" class="text-muted ms-1 carrossel-text">Unidade</a>
        <img src="./images/icon-avancar.png" class="icon-carrossel-avancar ms-1" alt="icon-avancar">
        <a href="#" class="text-primary ms-1 carrossel-text">Cadastro de Unidade</a>
      </div>
      <div class="button-dark">
        <a href="#"><img src="./images/icon-sun.png" class="icon-sun" alt="#"></a>
      </div>
    </div>
    <h3 class="mb-4 mt-4">Cadastro de Unidades</h3>
    <form method="POST" action="#">
      <div class="row">
        <div class="col-md-12 mb-4">
          <label for="usuarioCadastro" class="form-label text-muted ml-2">Nome</label>
          <div class="input-group">
            <input value="<?php $id ? print_r($unidade) : '' ?>" type="text" name="nome" class="form-control" id="inputCadUsuario" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
          </div>
        </div>
        <div class="col-md-12 mb-4">
          <div>
            <label for="exampleFormControlInput1" class="form-label text-muted ml-2">Código</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" id="inputCadUsuario" name="codigo" value="<?php $id ? print_r($codigo) : '' ?>" required>
          </div>
        </div>
        <div class="col-md-12 mb-4">
          <div>
            <label for="exampleFormControlInput1" class="form-label text-muted ml-2">Sigla</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" id="inputCadUsuario"  name="sigla" value="<?php $id ? print_r($sigla) : '' ?>" required>
          </div>
        </div>
        <div class="col-md-12 mb-4">
          <div>
            <label for="exampleFormControlInput1" class="form-label text-muted ml-2">Status</label>
            <select class="form-select" name="status" required>
              <option value="Selecionar" hidden>Selecionar</option>
              <option value="Ativo">Ativo</option>
              <option value="Desativado">Desativado</option>
            </select>
          </div>
        </div>
        <div class="d-flex flex-row-reverse">
          <input type="submit" class="btn btn-primary ml-3 pe-auto mr-2 " id="btn-cadUsuario" name="submit" value="Cadastrar"></input>
        </div>
    </form>
    <div class="hide" id="modal"></div>
</body>