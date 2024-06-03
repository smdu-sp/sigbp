
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
