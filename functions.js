var operation       = "c";
var item_id         = -1;
var tableCliente    = localStorage.getItem("tableCliente");
tableCliente        = JSON.parse(tableCliente);

$( document ).ready(function() {
    
    // verificando se tabela nao esta criada
    if (tableCliente == null) {
        tableCliente = [];
    }
    
    $("#form_data").on("submit", function(){
        if (operation == "c") {
            
            return create();
        }else{
            alert('funcao para editar...');
            return false;
        }
    });
});

function create() {
    
    // funcao para salvar os dados do formulario no localStorage
    var data = JSON.stringify({
        id      : $('#id').val(),
        name    : $('#name').val(),
        email   : $('#email').val()
    });
    
    tableCliente.push(data);
    localStorage.setItem("tableCliente", JSON.stringify(tableCliente));
    alert("Registro Salvo com sucesso!");
}