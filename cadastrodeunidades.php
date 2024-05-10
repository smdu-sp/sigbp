<?php
session_start();
include_once('verificacao.php');
include_once('header.php');
include_once('./conexoes/config.php');

$sql = "SELECT * FROM item ORDER BY idbem ASC";
$result = $conexao->query($sql) or die($mysqli->error);

isset($_GET['id']) ? $id = $_GET['id'] : $id = null;

if ($id != null && isset($_POST['submit'])) {
  $nome = $_POST['nome'];
  $codigo = $_POST['codigo'];
  $sigla = $_POST['sigla'];
  $status = $_POST['status'];

  $result = mysqli_query($conexao, "UPDATE unidades SET unidades = '$nome', sigla = '$sigla', codigo = '$codigo', statusunidade = $status WHERE id = '$id'");
} else {
  if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $codigo = $_POST['codigo'];
    $sigla = $_POST['sigla'];
    $status = $_POST['status'];

    $result = mysqli_query($conexao, "INSERT INTO unidades(unidades, sigla, codigo, statusunidade) VALUES ('$nome', '$sigla', '$codigo', $status)");
  }
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
  <div class="p-4 p-md-4 pt-3 conteudo container">
    <div class="carrossel mb-2">
      <a href="./home.php" class="mb-3 me-1">
        <img src="./images/icon-casa.png" class="icon-carrossel mt-3" alt="">
      </a>
      <img src="./images/icon-avancar.png" class="icon-carrossel-i" alt="icon-avancar">
      <a href="./cadastrarbens.php" class="text-primary ms-1 carrossel-text">Cadastro de Usuários</a>
    </div>

    <h3 class="mb-4 mt-4">Cadastro de Unidades</h3>
    <form method="POST" action="#">
      <div class="card" style="width: 1400px">
        <div class="row">
          <div class="col-md-6 mb-1">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label text-muted">Nome</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" id="inputCadUsuario" placeholder="Nome" name="nome" required>
            </div>
          </div>
          <div class="col-md-6 mb-1">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label text-muted">codigo</label>
              <input type="number" class="form-control" id="exampleFormControlInput1" id="inputCadUsuario" placeholder="código" name="codigo" min="0" required>
            </div>
          </div>
          <hr id="cdusuario" style="width: 97%;" class="mb-2">
          <div class="col-md-6 mb-1">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label text-muted">Sigla</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" id="inputCadUsuario" placeholder="código" name="sigla" min="0" required>
            </div>
          </div>
          <div class="col-md-6 mb-1">
            <label for="usuarioCadastro" class="form-label text-muted">Status</label>
            <div class="input-group">
              <div class="input-group-text" style="background-color: transparent;"><img src="./images/icon-status.png" alt="" class="imgCadastro"></div>
              <select class="form-select" name="status" required>
                <option value="" hidden="hidden">Selecionar</option>
                <option value="0">Ativo</option>
                <option value="1">Desativado</option>
              </select>
            </div>
          </div>
        </div>
        <div class="d-flex flex-row-reverse">
          <input type="submit" class="btn btn-primary ml-3 pe-auto mr-2 " id="btn-cadUsuario" name="submit" value="<?php echo isset($_GET['id']) ? 'Atualizar' : 'Cadastrar' ?>"></input>
          <a type="button" class="btn btn-light bnt-cadastrar" href="tabela-unidades.php">Cancelar</a>
        </div>
    </form>
</body>
<script>
  function buscarUsuario() {
    const usuario = document.getElementById("inputCadUsuario").value;
    var url_string = window.location.href;
    var url = new URL(url_string);
    url.searchParams.set('usuario', usuario);
    window.location.href = url;
  }

  function toast() {
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
    Toast.fire({
      icon: "success",
      title: "Usuario cadastrado com sucesso!"
    });
  }
  window.addEventListener('load', function() {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var data = url.searchParams.get("notificacao");
    if (data == 'true') {
      toast();
      window.history.replaceState({}, document.title, window.location.pathname);
      history.pushState({}, '', 'http://localhost/cadastrarbens.php');
    }
  })
</script>

</html>