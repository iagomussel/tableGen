
function send(a /*= configurações */){
	def={
		url:"rule.php",
		method:"get",
		format:"json",
		data:{},
		cache:false,		
	}
	$.extend(true, def, a);
	def.complete = function(e){}
	$.ajax(def).done(a.complete);
}

$(document).ready(function() {

  /*-- criando eventos --*/

  $('#servicos_lst').on('click', 'tbody tr', function() {
		$('#servicos_lst').find("tbody tr").removeClass("selected");
		$(this).addClass("selected");
  });
  $('#clientes_lst').on('click', 'tbody tr', function() {
		$('#clientes_lst').find("tbody tr").removeClass("selected");
		$(this).addClass("selected");
  });
  $('#veiculos_lst').on('click', 'tbody tr', function() {
		$('#veiculos_lst').find("tbody tr").removeClass("selected");
		$(this).addClass("selected");	 
  });
    $('#funcionarios_lst').on('click', 'tbody tr', function() {
		$('#funcionarios_lst').find("tbody tr").removeClass("selected");
		$(this).addClass("selected");	 
  });
    /* pesquisa em tabelas*/
  $(".search").keyup(function() {
    target_id = $(this).attr("target")
    if (target_id == "") {
      return false
    }
    // When value of the input is not blank
    if ('' != this.value) {
      var reg = new RegExp(this.value, 'i'); // case-insesitive
      $(target_id + ' tbody').find('tr').each(function() {
        var $me = $(this);
        if (!$me.children('td').text().match(reg)) {
          $me.hide();
        } else {
          $me.show();
        }
      });
    } else {
      $(target_id + ' tbody').find('tr').show();
    }
  })
  
  $("table").tablesorter()
});


alterar_servico = function(){
	id = $('#servicos_lst').find(".selected").attr("ind")
	if(id==undefined)return false;
	sr = mf.servicos[id]
	for(a in sr)
	$("#form_servicos_modal").find("[name="+a+"]").val(sr[a])
	$("#form_servicos_modal").modal("show")
}
alterar_cliente = function(){
	id = $('#clientes_lst').find(".selected").attr("ind")
	if(id==undefined)return false;
	sr = mf.clientes[id]
	for(a in sr)
	$("#form_clientes_modal").find("[name="+a+"]").val(sr[a])
	$("#form_clientes_modal").modal("show")
}
alterar_veiculo = function(){
	id = $('#veiculos_lst').find(".selected").attr("ind")
	if(id==undefined)return false;
	sr = mf.veiculos[id]
	for(a in sr)
	$("#form_veiculos_modal").find("[name="+a+"]").val(sr[a])
	$("#form_veiculos_modal").modal("show")
}
alterar_funcionario = function(){
	id = $('#funcionarios_lst').find(".selected").attr("ind")
	if(id==undefined)return false;
	sr = mf.funcionarios[id]
	for(a in sr)
	$("#form_funcionarios_modal").find("[name="+a+"]").val(sr[a])
	$("#form_funcionarios_modal").modal("show")
}

grava_servico = function(){
	var j = {}
	d = $("#form_servicos_modal").find("form").serializeArray()
	
	for(a in d){
		j[d[a].name] = d[a].value;
	}
	if(j.cliente == "") return false;
	if(j.veiculo == "") return false;
	if(j.funcionario == "") return false;
	if(j.data == ""){
		t = new Date();
		j.data = t.getDate()+"/"+t.getMonth()+"/"+t.getFullYear();
	}
	save({
		local:"servicos",
		dados:j,
		callback:function(b){
			var a  =JSON.parse(b);
			if(a.erro){
				console.log(a)
			} else {
				mf.servicos[a.id] = a;
				linha = $("<tr/>").attr("ind",a.id);
				$("<td />").text(""+a.data).appendTo(linha);
				$("<td />").text(mf.clientes[a.cliente].nome).appendTo(linha);
				$("<td />").text(mf.veiculos[a.veiculo].placa).appendTo(linha);
				$("<td />").text(mf.funcionarios[a.funcionario].nome).appendTo(linha);
				$("<td />").text(a.valor).appendTo(linha);
				$("<td />").text(a.diagnostico).appendTo(linha);
				if($(".servicos_table_list").find("[ind="+a.id+"]").length){
					$(".servicos_table_list").find("[ind="+a.id+"]").replaceWith( linha )
				} else {
					$(".servicos_table_list").append(linha)
				}
				$("#form_servicos_modal").modal('hide').find("input,textarea").val("");
				
			}
		}
	})
}
grava_cliente = function(){
	var j = {}
	d = $("#form_clientes_modal").find("form").serializeArray()
	for(a in d){
		j[d[a].name] = d[a].value;
	}
	
	save({
		local:"clientes",
		dados:j,
		callback:function(b){
			var a=JSON.parse(b);
			console.log(a)
			if(a.erro){
				console.log(a)
			} else {
				mf.clientes[a.id] = a;
				linha = $("<tr/>").attr("ind",a.id);
				$("<td />").text(a.nome).appendTo(linha);
				$("<td />").text(a.cidade).appendTo(linha);
				$("<td />").text(a.uf).appendTo(linha);
				$("<td />").text(a.cnpj).appendTo(linha);
				linha_s = $("<option />").text(a.nome+" , "+a.cidade).val(a.id);
				if($(".clientes_table_list").find("[ind="+a.id+"]").length){
					$(".clientes_table_list").find("[ind="+a.id+"]").replaceWith( linha )
					$("[variavel=clientes_select_list]").find("[value="+a.id+"]").replaceWith(linha_s)
					$("[variavel=clientes_select_list]").selectpicker('refresh')
				} else {
					$(".clientes_table_list").append(linha)
					$("[variavel=clientes_select_list]").append(linha_s).selectpicker('refresh')
				}
				
				$("#form_clientes_modal").modal("hide").find("input,textarea").val("");
				
			}
		}
	})
	
}
grava_veiculo = function(){
	var j = {}
	d = $("#form_veiculos_modal").find("form").serializeArray()
	for(a in d){
		j[d[a].name] = d[a].value;
	}
	save({
		local:"veiculos",
		dados:j,
		callback:function(b){
			var a  =JSON.parse(b);
			if(a.erro){
				console.log(a)
			} else {
				console.log(a)
				mf.veiculos[a.id] = a;
				linha = $("<tr/>").attr("ind",a.id);
				$("<td />").text(a.placa).appendTo(linha);
				$("<td />").text(a.modelo).appendTo(linha);
				$("<td />").text(a.fabricante).appendTo(linha);
				$("<td />").text(a.ano).appendTo(linha);
				linha_s = $("<option />").text(a.placa+" , "+a.fabricante).val(a.id);
				if($(".veiculos_table_list").find("[ind="+a.id+"]").length){
					$(".veiculos_table_list").find("[ind="+a.id+"]").replaceWith( linha )
					$("[variavel=veiculos_select_list]").find("[value="+a.id+"]").replaceWith(linha_s)
					$("[variavel=veiculos_select_list]").selectpicker('refresh')
				} else {
					$(".veiculos_table_list").append(linha)
					$("[variavel=veiculos_select_list]").append(linha_s).selectpicker('refresh')
				}
				
				$("#form_veiculos_modal").modal("hide").find("input,textarea").val("");
				
			}
		}
	})
}
grava_funcionario = function(){
	var j = {}
	d = $("#form_funcionarios_modal").find("form").serializeArray()
	for(a in d){
		j[d[a].name] = d[a].value;
	}
	save({
		local:"funcionarios",
		dados:j,
		callback:function(b){
			var a  =JSON.parse(b);
			if(a.erro){
				console.log(a)
			} else {
				console.log(a)
				mf.funcionarios[a.id] = a;
				linha = $("<tr/>").attr("ind",a.id);
				$("<td />").text(a.nome).appendTo(linha);
				$("<td />").text(a.telefone1).appendTo(linha);
				$("<td />").text(a.telefone2).appendTo(linha);
				$("<td />").text(a.telefone3).appendTo(linha);
				linha_s = $("<option />").text(a.nome).val(a.id);
				if($(".funcionarios_table_list").find("[ind="+a.id+"]").length){
					$(".funcionarios_table_list").find("[ind="+a.id+"]").replaceWith( linha )
					$("[variavel=funcionarios_select_list]").find("[value="+a.id+"]").replaceWith(linha_s)
					$("[variavel=funcionarios_select_list]").selectpicker('refresh')
				} else {
					$(".funcionarios_table_list").append(linha)
					$("[variavel=funcionarios_select_list]").append(linha_s).selectpicker('refresh')
				}
				$("#form_funcionarios_modal").modal("hide").find("input,textarea").val("");
				
			}
		}
	})

}

/*Envia os dados para gravar no servidor*/
save = function(options){
	if(options.dados===undefined) return false;
	if(options.local===undefined) return false;
	_dados = Base64.encode(JSON.stringify(options.dados))
	if(options.callback===undefined) callback = function(e){}; else	callback = options.callback;
	send({
	data:{
		acao:options.acao,
		local:options.local,
		dados:_dados
		},
	success:callback})	
}
