$(document).ready(function () {
  $("#myInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});

$(document).ready(function () {
  $("#myInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});

const ativar = (elemento) => {
  let itens = document.getElementsByClassName("page-item");
  for (i = 0; i < itens.length; i++) {
    itens[i].classList.remove("active");
  }
  elemento.classList.add("active");
};

const toggleModal = () => {
  const modal = document.querySelector("#modal");
  modal.classList.toggle("hide");
};

function menu() {
  let menuPrincipal = document.getElementById("menuPrincipal");
  menuPrincipal.classList.toggle("aparecer");
  menuPrincipal.style.backgroundColor = "#fff";
  toggleModal();
}

function sair() {
  let msgSair = document.getElementById("box-sair");
  msgSair.style.display = "block";
}

function fecharMsg() {
  let msgSair = document.getElementById("box-sair");
  msgSair.style.display = "none";
}

const dominio = window.location.pathname;
let botao = document.getElementById('botaoHome');
if (dominio == "//cadastrarbens.php") {
  console.log(botao);
  botao.style.backgroundColor = "#000"
}
