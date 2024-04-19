new DataTable('#example', {
  lengthMenu: [
      [6, 12, 24],
      [6, 12, 24, 'All']
  ],

  language: {
    "sEmptyTable" : "Nenhum registro encontrado",
    "sInfoEmpty" : "Mostrando 0 até 0 de 0 registros",
     "sInfo" : "Mostrando _PAGE_ de _PAGES_",
     "sLengthMenu": "_MENU_ resultados por página",
     "sSearch" : "Pesquisar:",
     "sZeroRecords" : "Nenhum registro encontrado",
     "sProcessing" : "Processando...",
     "sLoadingRecords" : "Carregando...",
     "sInfoFiltered" : "(Filtrados de _MAX_ registros)",
     "sInfoThousands": ".",
     "sInfoPostFix": "",
     "order": [[0,'desc']]
  },
});

$(document).ready(function() {
  $('#example').DataTable(); // inicializa
  var opts = { "aaSorting": [] }; // insere a opção
  $('#example').DataTable().destroy(); // destrói
  $('#example').DataTable(opts); // reinicializa com as novas opções
});

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

// MOSTRAR ITENS ADICIONADOS NO TERMO
function adicionarItem() {
  let nPatriSerie = document.getElementById('numPatriSerie').value;
  let descBem = document.getElementById('descBem').value;
  if(nPatriSerie != '' && descBem != '') {
    document.getElementById('textareaid').value += "Item " + ': '+ nPatriSerie + " / " + descBem + " " + " " + " " + " " + " ";
  }
}


