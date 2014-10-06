// iniciando as variaveis
var operation       = "c";
var item_id         = '';
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
        item_id     = $(this).attr("id");
        
        $.each(tableCliente, function(key, val){
            var data = JSON.parse(val);
            
            if (data.id == item_id) {
                //code
                $('#name').val(data.name);
                $('#email').val(data.email);
                $("#name").focus();
            }
            
        });
    });
    
    $(".delete").on("click", function(){
        item_id     = $(this).attr("id");
        delete_data();
        list();
    });
    
    $("#sync").on("click", function(event){
        
        event.preventDefault();
        
        var to_sync = [];
        
        var count = 0;
        
        $.each(tableCliente, function(key, val){
            
            var data = JSON.parse(val);
            
            if (data.sync == 0) {
                
                to_sync[count] = data;
                
                count++;
                
                tableCliente[key] = JSON.stringify({
                    id      : data.id,
                    name    : data.name,
                    email   : data.email,
                    sync    : 1
                });
            }
        });
        
        // verificar se esse array nao esta vazio, se nao estiver, postar para server e sync...
        if (to_sync.length > 0) {
            
            $.ajax({
				type: 'POST',
				dataType: 'json',
                crossDomain: true,
				url: 'http://local.websql.com.br/server/index.php/dashboard/sync',
				async: false,
				data: {'data' : to_sync},
				success: function(response) {
					if(response.retorno == 'sucess'){
                        
                        // atualizando os dados na tabela local...
                        localStorage.setItem("tableCliente", JSON.stringify(tableCliente));
						alert('Dados sincronizados com sucesso!');
                        console.log('Dados sincronizados com sucesso!');
                        
					}else{
						alert('Erro ao sicronizar, tente novamente mais tarde');
                        console.log('Erro ao sicronizar, tente novamente mais tarde');
					}
				},
                error: function(){
					alert("Encontramos algum erro, tente novamente");
					console.log('Erro ao sicronizar, tente novamente mais tarde');
				}
			});
            
        }else{
            alert('Sem dados para sincronizar!');
        }
    });
    
});

$(document).bind( "mobileinit", function() {
	$.mobile.allowCrossDomainPages = true;
});

// funcao para salvar os dados do formulario no localStorage
function create()
{    
    var data = JSON.stringify({
        id      : $.md5(Date($.now())),
        name    : $('#name').val(),
        email   : $('#email').val(),
        sync    : 0
    });
    
    tableCliente.push(data);
    localStorage.setItem("tableCliente", JSON.stringify(tableCliente));
    alert("Registro Salvo com sucesso!");
    return true;
}

// funcao para atualizar os dados no localStorage
function update()
{
    $.each(tableCliente, function(key, val){
        var data = JSON.parse(val);
        
        if (data.id == item_id) {
            
            tableCliente[key] = JSON.stringify({
                id      : item_id,
                name    : $('#name').val(),
                email   : $('#email').val(),
                sync    : 0
            });
        }
    });
    
    localStorage.setItem("tableCliente", JSON.stringify(tableCliente));
    alert("Dados editado com sucesso");
    operation = "c";
    return true;
}

// funcao para apagar dados no localStorage
function delete_data()
{
    var status = false;
    
    $.each(tableCliente, function(key, val){
        var data = JSON.parse(val);
        
        if(data.id == item_id) {
            tableCliente.splice(key, 1);
            localStorage.setItem("tableCliente", JSON.stringify(tableCliente));
            status = true;
        }
    });
    
    if (status) {
        alert("Registro Excluído com sucesso");
    }else{
        alert("Erro ao Excluír Registro");
    }
    
    return true;
}

// funcao para listar dados salvos no localStorage
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
        $("#list_data tbody").append("<td><a href='javascript:' id='"+cli.id+"' class='edit'>Editar</a>&nbsp;<a href='javascript:' id='"+cli.id+"' class='delete'>Apagar</a></td>");
        $("#list_data tbody").append("</tr>");
    }
}