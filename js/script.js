new DataTable('#example', {
  lengthMenu: [
      [6, 12, 24],
      [6, 12, 24, 'All']
  ],
  
  language: {
     "info" : "Mostrar a página _PAGE_ de _PAGES_",
     "lengthMenu": "_MENU_ listas por página",
     "sSearch" : "Filtrar:"
  },

  "columnDefs": [
    {
      "orderable": false, 
      "targets": [0,10]
    }
  ]
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


