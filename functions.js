var operation       = "c";
var item_id         = -1;
var tableCliente    = localStorage.getItem("tableCliente");
tableCliente        = JSON.parse(tableCliente);

$( document ).ready(function() {
    
    // verificando se tabela nao esta criada
    if (tableCliente == null) {
        tableCliente = [];
    }
    
    // listar os resultados
    list();
    
    $("#form_data").on("submit", function(){
        if (operation == "c") {
            return create();
        }else{
            return update();
        }
    });
    
    $(".edit").on("click", function(){
        
        operation   = "u";
        item_id     = parseInt($(this).attr("id"));
        var cli     = JSON.parse(tableCliente[item_id]);
        
        $('#name').val(cli.name);
        $('#email').val(cli.email);
        $("#name").focus();
    });
});

function create()
{    
    // funcao para salvar os dados do formulario no localStorage
    var data = JSON.stringify({
        name    : $('#name').val(),
        email   : $('#email').val()
    });
    
    tableCliente.push(data);
    localStorage.setItem("tableCliente", JSON.stringify(tableCliente));
    alert("Registro Salvo com sucesso!");
    return true;
}

function update()
{
    tableCliente[item_id] = JSON.stringify({
        name    : $('#name').val(),
        email   : $('#email').val()
    });
    
    localStorage.setItem("tableCliente", JSON.stringify(tableCliente));
    alert("Dados editado com sucesso");
    operation = "c";
    return true;
}

function list()
{
    $("#list_data").html("");
    $("#list_data").html(
        "<thead>"+
        "<tr>"+
        "<th>Nome</th>"+
        "<th>Email</th>"+
        "<th>Ações</th>"+
        "</tr>"+
        "</thead>"+
        "<tbody>"+
        "</tbody>"
    );
    
    for(var i in tableCliente){
        
        var cli = JSON.parse(tableCliente[i]);
        
        $("#list_data tbody").append("<tr>");
        $("#list_data tbody").append("<td>"+cli.name+"</td>");
        $("#list_data tbody").append("<td>"+cli.email+"</td>");
        $("#list_data tbody").append("<td><a href='javascript:' id='"+i+"' class='edit'>Editar</a>&nbsp;<a href='javascript:' id='"+i+"' class='delete'>Apagar</a></td>");
        $("#list_data tbody").append("</tr>");
    }
}