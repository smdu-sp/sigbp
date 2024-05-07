new DataTable("#example", {
  lengthMenu: [
    [6, 12, 24],
    [6, 12, 24, "All"],
  ],
  language: {
    sEmptyTable: "Nenhum registro encontrado",
    sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
    sInfo: "Página _PAGE_ de _PAGES_",
    sLengthMenu: "_MENU_ resultados por página",
    sSearch: "Pesquisar:",
    sZeroRecords: "Nenhum registro encontrado",
    sProcessing: "Processando...",
    sLoadingRecords: "Carregando...",
    sInfoFiltered: "(Filtrados de _MAX_ registros)",
    sInfoThousands: ".",
    sInfoPostFix: "",
    order: [[0, "desc"]],
  },
});

$(document).ready(function () {
  $("#example").DataTable();
  var opts = { aaSorting: [] };
  $("#example").DataTable().destroy();
  $("#example").DataTable(opts);
});

new DataTable("#home", {
  lengthMenu: [
    [6, 9],
    [6, 9],
  ],
  language: {
    sEmptyTable: "Nenhum registro encontrado",
    sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
    sInfo: "Página _PAGE_ de _PAGES_",
    sLengthMenu: "_MENU_ resultados por página",
    sSearch: "Pesquisar:",
    sZeroRecords: "Nenhum registro encontrado",
    sProcessing: "Processando...",
    sLoadingRecords: "Carregando...",
    sInfoFiltered: "(Filtrados de _MAX_ registros)",
    sInfoThousands: ".",
    sInfoPostFix: "",
  },

  order: [[-1, "asc"]],
});

const ativar = (elemento) => {
  let itens = document.getElementsByClassName("page-item");
  for (i = 0; i < itens.length; i++) {
    itens[i].classList.remove("active");
  }
  elemento.classList.add("active");
};

const toggleModal = () => {
  const modal = document.getElementById("modal");
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

let serieInput = document.getElementById("numPatriSerie");
let descBem = document.getElementById("descBem");
let btn = document.getElementById("btn-adc-item");

function verificacao() {
  if (serieInput.value != '' && descBem.value != '') {
    btn.removeAttribute("disabled");
  }
}

var campos = document.getElementsByClassName("campos");

for (let i = 0; i < campos.length; i++) {
  campos[i].addEventListener("keypress", verificacao);
}

var arrayNumSerie = [];
var arrayDescBem = [];

// MOSTRAR ITENS ADICIONADOS NO TERMO
function adicionarItem() {
  let nPatriSerie = document.getElementById("numPatriSerie").value;
  let descBem = document.getElementById("descBem").value;
  if (nPatriSerie != "" && descBem != "") {
    var textareaNumSerie = (document.getElementById("textareaNumSerie").value +=
      nPatriSerie + "\n");
    var textareaDescBem = (document.getElementById("textareaDescBem").value +=
      descBem + "\n");
    document.getElementById("numPatriSerie").value = "";
    document.getElementById("descBem").value = "";

    arrayDescBem.push(descBem);
    arrayNumSerie.push(nPatriSerie);
  }
}

btnSairCadUsuario = document.getElementById("btnSair-cadUsuario");
btnSairCadUsuario.addEventListener("click", () => {
  location.reload();
});
