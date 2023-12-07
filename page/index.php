<?php
$equipamento = json_decode(file_get_contents("json/equipamento.json"),true);
$fabricantes = json_decode(file_get_contents("json/fabricantes.json"),true);
$tipos = json_decode(file_get_contents("json/tipos.json"),true);
$memorias_ram = json_decode(file_get_contents("json/memorias_ram.json"),true);
$slotsram = json_decode(file_get_contents("json/slotsram.json"),true);
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
       <title>Sistema
</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="css/bootstrap.min.css" media="all"/>
        <link rel="stylesheet" href="css/bootstrap-select.min.css" media="all"/>
        <style  media="all">
            tr.selected {
                outline:solid 2px rgba(16,205,206,1);
            }
        
</style>
		<style  media="print">
			.noprint{
				display:none
			}
		tr.selected {
                outline:none;
            }
		legend{
			text-align:center;
		}
		
</style>
        <script src="js/jquery.min.js">
</script>
        <script src="js/base64.js">
</script>
        <script src="js/gerador.palavras.js">
</script>
        <script src="js/bootstrap.min.js">
</script>
        <script src="js/bootstrap-select.min.js">
</script>
        <script src="js/defaults-pt_BR.js">
</script>
        <script src="js/jquery.tablesorter.min.js">
</script>
       <script>
            mf = {
        equipamento: <?php echo json_encode($equipamento) ;?>,
        fabricantes: <?php echo json_encode($fabricantes) ;?>,
        tipos: <?php echo json_encode($tipos) ;?>,
        memorias_ram: <?php echo json_encode($memorias_ram) ;?>,
        slotsram: <?php echo json_encode($slotsram) ;?>,
}
</script>
<script src="modulos\equipamento\js\index.js"></script>
<script src="modulos\fabricantes\js\index.js"></script>
<script src="modulos\tipos\js\index.js"></script>
<script src="modulos\memorias_ram\js\index.js"></script>
<script src="modulos\slotsram\js\index.js"></script>

</head>

<body><div id="container" class="container">	<!-- navbar-->
<div class="painel "><ul class="nav nav-tabs navbar-inverse noprint">
<li><a data-toggle="tab" href="#equipamento">Equipamento
</a>
</li>
<li><a data-toggle="tab" href="#fabricantes">Fabricantes
</a>
</li>
<li><a data-toggle="tab" href="#tipos">Tipos
</a>
</li>
<li><a data-toggle="tab" href="#memorias_ram">Memorias Ram
</a>
</li>
<li><a data-toggle="tab" href="#slotsram">Slots Ram
</a>
</li><!-- tab content-->

</ul><div class="tab-content">
<div id="equipamento" class="tab-pane fade ">
<form class="form-horizontal"><fieldset><legend>Equipamento
</legend>
<div class="btn-group noprint" role="group" aria-label="Controles"><div class="btn btn-primary" data-target="#form_equipamento_modal" data-toggle="modal">Novo<span class="glyphicon glyphicon-plus" aria-hidden="true">
</span>
</div>

<div class="btn btn-default" onclick="alterar_equipamento()">Editar<span class="glyphicon glyphicon-edit" aria-hidden="true">
</span>
</div>

<div class="btn btn-default" onclick="window.print()">Imprimir <span class="glyphicon glyphicon-print" aria-hidden="true">
</span>
</div>

</div>

<div class="table-responsive">
<input type="text" class="search form-control noprint" placeholder="Filtro de pesquisa" target="#equipamento_lst" />
<table id="equipamento_lst" class="table table-striped table-hover">
<thead><tr>
<th>Modelo
</th>
<th>Fabricante
</th>
<th>Tipo
</th>

</tr>
</thead><tbody class="equipamento_table_list">
<?php foreach($equipamento as $linha){
echo "<tr ind=".$linha['id'].">";
echo "<td>".$linha["modelo"]."
</td>";
echo "<td>".$fabricantes[$linha["fabricante"]]["nome"]."
</td>";
echo "<td>".$tipos[$linha["tipo"]]["tipo"]."
</td>";
}?>

</tr>

</tbody>
</table>
</div>


</fieldset>
</form>
</div>

<div id="fabricantes" class="tab-pane fade ">
<form class="form-horizontal"><fieldset><legend>Fabricantes
</legend>
<div class="btn-group noprint" role="group" aria-label="Controles"><div class="btn btn-primary" data-target="#form_fabricantes_modal" data-toggle="modal">Novo<span class="glyphicon glyphicon-plus" aria-hidden="true">
</span>
</div>

<div class="btn btn-default" onclick="alterar_fabricantes()">Editar<span class="glyphicon glyphicon-edit" aria-hidden="true">
</span>
</div>

<div class="btn btn-default" onclick="window.print()">Imprimir <span class="glyphicon glyphicon-print" aria-hidden="true">
</span>
</div>

</div>

<div class="table-responsive">
<input type="text" class="search form-control noprint" placeholder="Filtro de pesquisa" target="#fabricantes_lst" />
<table id="fabricantes_lst" class="table table-striped table-hover">
<thead><tr>
<th>Nome
</th>

</tr>
</thead><tbody class="fabricantes_table_list">
<?php foreach($fabricantes as $linha){
echo "<tr ind=".$linha['id'].">";
echo "<td>".$linha["nome"]."
</td>";
}?>

</tr>

</tbody>
</table>
</div>


</fieldset>
</form>
</div>

<div id="tipos" class="tab-pane fade ">
<form class="form-horizontal"><fieldset><legend>Tipos
</legend>
<div class="btn-group noprint" role="group" aria-label="Controles"><div class="btn btn-primary" data-target="#form_tipos_modal" data-toggle="modal">Novo<span class="glyphicon glyphicon-plus" aria-hidden="true">
</span>
</div>

<div class="btn btn-default" onclick="alterar_tipos()">Editar<span class="glyphicon glyphicon-edit" aria-hidden="true">
</span>
</div>

<div class="btn btn-default" onclick="window.print()">Imprimir <span class="glyphicon glyphicon-print" aria-hidden="true">
</span>
</div>

</div>

<div class="table-responsive">
<input type="text" class="search form-control noprint" placeholder="Filtro de pesquisa" target="#tipos_lst" />
<table id="tipos_lst" class="table table-striped table-hover">
<thead><tr>
<th>Tipo
</th>
<th>Descrição
</th>

</tr>
</thead><tbody class="tipos_table_list">
<?php foreach($tipos as $linha){
echo "<tr ind=".$linha['id'].">";
echo "<td>".$linha["tipo"]."
</td>";
echo "<td>".$linha["descricao"]."
</td>";
}?>

</tr>

</tbody>
</table>
</div>


</fieldset>
</form>
</div>

<div id="memorias_ram" class="tab-pane fade ">
<form class="form-horizontal"><fieldset><legend>Memorias Ram
</legend>
<div class="btn-group noprint" role="group" aria-label="Controles"><div class="btn btn-primary" data-target="#form_memorias_ram_modal" data-toggle="modal">Novo<span class="glyphicon glyphicon-plus" aria-hidden="true">
</span>
</div>

<div class="btn btn-default" onclick="alterar_memorias_ram()">Editar<span class="glyphicon glyphicon-edit" aria-hidden="true">
</span>
</div>

<div class="btn btn-default" onclick="window.print()">Imprimir <span class="glyphicon glyphicon-print" aria-hidden="true">
</span>
</div>

</div>

<div class="table-responsive">
<input type="text" class="search form-control noprint" placeholder="Filtro de pesquisa" target="#memorias_ram_lst" />
<table id="memorias_ram_lst" class="table table-striped table-hover">
<thead><tr>
<th>Fabricante
</th>
<th>Capacidade
</th>
<th>Velocidade (Clock)
</th>
<th>Slot
</th>

</tr>
</thead><tbody class="memorias_ram_table_list">
<?php foreach($memorias_ram as $linha){
echo "<tr ind=".$linha['id'].">";
echo "<td>".$fabricantes[$linha["fabricante"]]["nome"]."
</td>";
echo "<td>".$linha["capacidade"]."
</td>";
echo "<td>".$linha["Velocidade"]."
</td>";
echo "<td>".$slotsram[$linha["Slot"]]["tipo"]."
</td>";
}?>

</tr>

</tbody>
</table>
</div>


</fieldset>
</form>
</div>

<div id="slotsram" class="tab-pane fade ">
<form class="form-horizontal"><fieldset><legend>Slots Ram
</legend>
<div class="btn-group noprint" role="group" aria-label="Controles"><div class="btn btn-primary" data-target="#form_slotsram_modal" data-toggle="modal">Novo<span class="glyphicon glyphicon-plus" aria-hidden="true">
</span>
</div>

<div class="btn btn-default" onclick="alterar_slotsram()">Editar<span class="glyphicon glyphicon-edit" aria-hidden="true">
</span>
</div>

<div class="btn btn-default" onclick="window.print()">Imprimir <span class="glyphicon glyphicon-print" aria-hidden="true">
</span>
</div>

</div>

<div class="table-responsive">
<input type="text" class="search form-control noprint" placeholder="Filtro de pesquisa" target="#slotsram_lst" />
<table id="slotsram_lst" class="table table-striped table-hover">
<thead><tr>
<th>Tipo
</th>

</tr>
</thead><tbody class="slotsram_table_list">
<?php foreach($slotsram as $linha){
echo "<tr ind=".$linha['id'].">";
echo "<td>".$linha["tipo"]."
</td>";
}?>

</tr>

</tbody>
</table>
</div>


</fieldset>
</form>
</div>
<!-- modal content --><div id="form_equipamento_modal" class="modal fade" role="dialog"><div class="modal-dialog modal-lg">        <div class="modal-content">            <div class="modal-header">                <div type="button" class="close" data-dismiss="modal">&times;
</div>
                <h4 class="modal-title">Equipamento
</h4>            
</div>
            <div class="modal-body">                <form class="form-horizontal">                    <fieldset>                        <input type="hidden" id="id" name="id" /><div class="form-group"><label class="col-md-4 control-label" for="modelo">Modelo
</label><div class="col-md-4"><input id="modelo" name="modelo" type="text" placeholder="Modelo" class="form-control input-md" />
</div>

</div>
<div class="form-group"><label class="col-md-4 control-label" for="fabricante">Fabricante
</label><div class="col-md-4"> <div class="input-group"><div class="input-group-addon btn" data-toggle="modal" data-target="#form_fabricantes_modal" aria-expanded="true"><div ><span class="glyphicon glyphicon-plus"></span></div></div><select id="fabricante" data-live-search="true" name="fabricante" campo="nome"class="form-control show-tick selectpicker" variavel="fabricantes_select_list" required="" >						<?php						if(!count($fabricantes)){
						} else foreach($fabricantes as $s){
echo "<option value='".$s["id"]."'>".$s["nome"]."
</option>";
} ?>
</select></div>
</div>

</div>
<div class="form-group"><label class="col-md-4 control-label" for="tipo">Tipo
</label><div class="col-md-4"> <div class="input-group"><div class="input-group-addon btn" data-toggle="modal" data-target="#form_tipos_modal" aria-expanded="true"><div ><span class="glyphicon glyphicon-plus"></span></div></div><select id="tipo" data-live-search="true" name="tipo" campo="tipo"class="form-control show-tick selectpicker" variavel="tipos_select_list" required="" >						<?php						if(!count($tipos)){
						} else foreach($tipos as $s){
echo "<option value='".$s["id"]."'>".$s["tipo"]."
</option>";
} ?>
</select></div>
</div>

</div>
     
</fieldset>
</form> 
</div>
 <div class="modal-footer">                        <div type="button" class="btn btn-primary"  onclick="grava_equipamento()">Gravar
</div>
                         <div type="button" class="btn btn-default" data-dismiss="modal">Fechar
</div>

</div>
 
</div>

</div>

</div>
<div id="form_fabricantes_modal" class="modal fade" role="dialog"><div class="modal-dialog modal-lg">        <div class="modal-content">            <div class="modal-header">                <div type="button" class="close" data-dismiss="modal">&times;
</div>
                <h4 class="modal-title">Fabricantes
</h4>            
</div>
            <div class="modal-body">                <form class="form-horizontal">                    <fieldset>                        <input type="hidden" id="id" name="id" /><div class="form-group"><label class="col-md-4 control-label" for="nome">Nome
</label><div class="col-md-4"><input id="nome" name="nome" type="text" placeholder="Nome" class="form-control input-md" />
</div>

</div>
     
</fieldset>
</form> 
</div>
 <div class="modal-footer">                        <div type="button" class="btn btn-primary"  onclick="grava_fabricantes()">Gravar
</div>
                         <div type="button" class="btn btn-default" data-dismiss="modal">Fechar
</div>

</div>
 
</div>

</div>

</div>
<div id="form_tipos_modal" class="modal fade" role="dialog"><div class="modal-dialog modal-lg">        <div class="modal-content">            <div class="modal-header">                <div type="button" class="close" data-dismiss="modal">&times;
</div>
                <h4 class="modal-title">Tipos
</h4>            
</div>
            <div class="modal-body">                <form class="form-horizontal">                    <fieldset>                        <input type="hidden" id="id" name="id" /><div class="form-group"><label class="col-md-4 control-label" for="tipo">Tipo
</label><div class="col-md-4"><input id="tipo" name="tipo" type="text" placeholder="Tipo" class="form-control input-md" />
</div>

</div>
<div class="form-group"><label class="col-md-4 control-label" for="descricao">Descrição
</label><div class="col-md-4"><input id="descricao" name="descricao" type="text" placeholder="Descrição" class="form-control input-md" />
</div>

</div>
     
</fieldset>
</form> 
</div>
 <div class="modal-footer">                        <div type="button" class="btn btn-primary"  onclick="grava_tipos()">Gravar
</div>
                         <div type="button" class="btn btn-default" data-dismiss="modal">Fechar
</div>

</div>
 
</div>

</div>

</div>
<div id="form_memorias_ram_modal" class="modal fade" role="dialog"><div class="modal-dialog modal-lg">        <div class="modal-content">            <div class="modal-header">                <div type="button" class="close" data-dismiss="modal">&times;
</div>
                <h4 class="modal-title">Memorias Ram
</h4>            
</div>
            <div class="modal-body">                <form class="form-horizontal">                    <fieldset>                        <input type="hidden" id="id" name="id" /><div class="form-group"><label class="col-md-4 control-label" for="fabricante">Fabricante
</label><div class="col-md-4"> <div class="input-group"><div class="input-group-addon btn" data-toggle="modal" data-target="#form_fabricantes_modal" aria-expanded="true"><div ><span class="glyphicon glyphicon-plus"></span></div></div><select id="fabricante" data-live-search="true" name="fabricante" campo="nome"class="form-control show-tick selectpicker" variavel="fabricantes_select_list" required="" >						<?php						if(!count($fabricantes)){
						} else foreach($fabricantes as $s){
echo "<option value='".$s["id"]."'>".$s["nome"]."
</option>";
} ?>
</select></div>
</div>

</div>
<div class="form-group"><label class="col-md-4 control-label" for="capacidade">Capacidade
</label><div class="col-md-4"><input id="capacidade" name="capacidade" type="number" placeholder="Capacidade" class="form-control input-md" />
</div>

</div>
<div class="form-group"><label class="col-md-4 control-label" for="Velocidade">Velocidade (Clock)
</label><div class="col-md-4"><input id="Velocidade" name="Velocidade" type="number" placeholder="Velocidade (Clock)" class="form-control input-md" />
</div>

</div>
<div class="form-group"><label class="col-md-4 control-label" for="Slot">Slot
</label><div class="col-md-4"> <div class="input-group"><div class="input-group-addon btn" data-toggle="modal" data-target="#form_slotsram_modal" aria-expanded="true"><div ><span class="glyphicon glyphicon-plus"></span></div></div><select id="Slot" data-live-search="true" name="Slot" campo="tipo"class="form-control show-tick selectpicker" variavel="slotsram_select_list" required="" >						<?php						if(!count($slotsram)){
						} else foreach($slotsram as $s){
echo "<option value='".$s["id"]."'>".$s["tipo"]."
</option>";
} ?>
</select></div>
</div>

</div>
     
</fieldset>
</form> 
</div>
 <div class="modal-footer">                        <div type="button" class="btn btn-primary"  onclick="grava_memorias_ram()">Gravar
</div>
                         <div type="button" class="btn btn-default" data-dismiss="modal">Fechar
</div>

</div>
 
</div>

</div>

</div>
<div id="form_slotsram_modal" class="modal fade" role="dialog"><div class="modal-dialog modal-lg">        <div class="modal-content">            <div class="modal-header">                <div type="button" class="close" data-dismiss="modal">&times;
</div>
                <h4 class="modal-title">Slots Ram
</h4>            
</div>
            <div class="modal-body">                <form class="form-horizontal">                    <fieldset>                        <input type="hidden" id="id" name="id" /><div class="form-group"><label class="col-md-4 control-label" for="tipo">Tipo
</label><div class="col-md-4"><input id="tipo" name="tipo" type="text" placeholder="Tipo" class="form-control input-md" />
</div>

</div>
     
</fieldset>
</form> 
</div>
 <div class="modal-footer">                        <div type="button" class="btn btn-primary"  onclick="grava_slotsram()">Gravar
</div>
                         <div type="button" class="btn btn-default" data-dismiss="modal">Fechar
</div>

</div>
 
</div>

</div>

</div>

</div>
</div>
</div><script>
 function send(a){def={url:"rule.php",method:"get",format:"json",data:{},cache:false};$.extend(true, def, a);def.complete = function(e){};$.ajax(def).done(a.complete);}
$(document).ready(function() {
  $(".search").keyup(function() {target_id = $(this).attr("target");if (target_id == "") {return false};if ('' != this.value) {var reg = new RegExp(this.value, 'i');$(target_id + ' tbody').find('tr').each(function() {var $me = $(this);if (!$me.children('td').text().match(reg)) {$me.hide();} else {$me.show();}});} else {$(target_id + ' tbody').find('tr').show();}})
 $("table").tablesorter()
$('#equipamento_lst').on('click', 'tbody tr', function() {

		$('#equipamento_lst').find("tbody tr").removeClass("selected");

		$(this).addClass("selected");

  });$('#fabricantes_lst').on('click', 'tbody tr', function() {

		$('#fabricantes_lst').find("tbody tr").removeClass("selected");

		$(this).addClass("selected");

  });$('#tipos_lst').on('click', 'tbody tr', function() {

		$('#tipos_lst').find("tbody tr").removeClass("selected");

		$(this).addClass("selected");

  });$('#memorias_ram_lst').on('click', 'tbody tr', function() {

		$('#memorias_ram_lst').find("tbody tr").removeClass("selected");

		$(this).addClass("selected");

  });$('#slotsram_lst').on('click', 'tbody tr', function() {

		$('#slotsram_lst').find("tbody tr").removeClass("selected");

		$(this).addClass("selected");

  });})
alterar_equipamento = function(){

	id = $('#equipamento_lst').find(".selected").attr("ind")

	if(id==undefined)return false;

	sr = mf.equipamento[id]

	for(a in sr)

	$("#form_equipamento_modal").find("[name="+a+"]").val(sr[a])

	$("#form_equipamento_modal").modal("show")}
grava_equipamento = function(){

	var j = {}

	d = $("#form_equipamento_modal").find("form").serializeArray()

	

	for(a in d){

		j[d[a].name] = d[a].value;

	}


	save({

		local:"equipamento",

		dados:j,

		callback:function(b){

			var a  =JSON.parse(b);

			if(a.erro){

				console.log(a)

			} else {

				mf.equipamento[a.id] = a;

				linha = $("<tr/>").attr("ind",a.id);
$("<td />").text(""+a.modelo).appendTo(linha);
$("<td />").text(mf.fabricantes[a.fabricante].nome).appendTo(linha);
$("<td />").text(mf.tipos[a.tipo].tipo).appendTo(linha);
var campo = $("[variavel=equipamento_select_list]").attr("campo");
linha_s = $("<option />").text(a[campo]).val(a.id);

				if($(".equipamento_table_list").find("[ind="+a.id+"]").length){

					$(".equipamento_table_list").find("[ind="+a.id+"]").replaceWith( linha )

					$("[variavel=equipamento_select_list]").find("[value="+a.id+"]").replaceWith(linha_s)

				} else {

					$(".equipamento_table_list").append(linha)

					$("[variavel=equipamento_select_list]").append(linha_s);

				}

				$("[variavel=equipamento_select_list]").selectpicker('refresh');

				$(".equipamento_table_list").trigger("update")

				$("#form_equipamento_modal").modal('hide').find("input,textarea").val("");

				

			}

		}

	})

}
alterar_fabricantes = function(){

	id = $('#fabricantes_lst').find(".selected").attr("ind")

	if(id==undefined)return false;

	sr = mf.fabricantes[id]

	for(a in sr)

	$("#form_fabricantes_modal").find("[name="+a+"]").val(sr[a])

	$("#form_fabricantes_modal").modal("show")}
grava_fabricantes = function(){

	var j = {}

	d = $("#form_fabricantes_modal").find("form").serializeArray()

	

	for(a in d){

		j[d[a].name] = d[a].value;

	}


	save({

		local:"fabricantes",

		dados:j,

		callback:function(b){

			var a  =JSON.parse(b);

			if(a.erro){

				console.log(a)

			} else {

				mf.fabricantes[a.id] = a;

				linha = $("<tr/>").attr("ind",a.id);
$("<td />").text(""+a.nome).appendTo(linha);
var campo = $("[variavel=fabricantes_select_list]").attr("campo");
linha_s = $("<option />").text(a[campo]).val(a.id);

				if($(".fabricantes_table_list").find("[ind="+a.id+"]").length){

					$(".fabricantes_table_list").find("[ind="+a.id+"]").replaceWith( linha )

					$("[variavel=fabricantes_select_list]").find("[value="+a.id+"]").replaceWith(linha_s)

				} else {

					$(".fabricantes_table_list").append(linha)

					$("[variavel=fabricantes_select_list]").append(linha_s);

				}

				$("[variavel=fabricantes_select_list]").selectpicker('refresh');

				$(".fabricantes_table_list").trigger("update")

				$("#form_fabricantes_modal").modal('hide').find("input,textarea").val("");

				

			}

		}

	})

}
alterar_tipos = function(){

	id = $('#tipos_lst').find(".selected").attr("ind")

	if(id==undefined)return false;

	sr = mf.tipos[id]

	for(a in sr)

	$("#form_tipos_modal").find("[name="+a+"]").val(sr[a])

	$("#form_tipos_modal").modal("show")}
grava_tipos = function(){

	var j = {}

	d = $("#form_tipos_modal").find("form").serializeArray()

	

	for(a in d){

		j[d[a].name] = d[a].value;

	}


	save({

		local:"tipos",

		dados:j,

		callback:function(b){

			var a  =JSON.parse(b);

			if(a.erro){

				console.log(a)

			} else {

				mf.tipos[a.id] = a;

				linha = $("<tr/>").attr("ind",a.id);
$("<td />").text(""+a.tipo).appendTo(linha);
$("<td />").text(""+a.descricao).appendTo(linha);
var campo = $("[variavel=tipos_select_list]").attr("campo");
linha_s = $("<option />").text(a[campo]).val(a.id);

				if($(".tipos_table_list").find("[ind="+a.id+"]").length){

					$(".tipos_table_list").find("[ind="+a.id+"]").replaceWith( linha )

					$("[variavel=tipos_select_list]").find("[value="+a.id+"]").replaceWith(linha_s)

				} else {

					$(".tipos_table_list").append(linha)

					$("[variavel=tipos_select_list]").append(linha_s);

				}

				$("[variavel=tipos_select_list]").selectpicker('refresh');

				$(".tipos_table_list").trigger("update")

				$("#form_tipos_modal").modal('hide').find("input,textarea").val("");

				

			}

		}

	})

}
alterar_memorias_ram = function(){

	id = $('#memorias_ram_lst').find(".selected").attr("ind")

	if(id==undefined)return false;

	sr = mf.memorias_ram[id]

	for(a in sr)

	$("#form_memorias_ram_modal").find("[name="+a+"]").val(sr[a])

	$("#form_memorias_ram_modal").modal("show")}
grava_memorias_ram = function(){

	var j = {}

	d = $("#form_memorias_ram_modal").find("form").serializeArray()

	

	for(a in d){

		j[d[a].name] = d[a].value;

	}


	save({

		local:"memorias_ram",

		dados:j,

		callback:function(b){

			var a  =JSON.parse(b);

			if(a.erro){

				console.log(a)

			} else {

				mf.memorias_ram[a.id] = a;

				linha = $("<tr/>").attr("ind",a.id);
$("<td />").text(mf.fabricantes[a.fabricante].nome).appendTo(linha);
$("<td />").text(""+a.capacidade).appendTo(linha);
$("<td />").text(""+a.Velocidade).appendTo(linha);
$("<td />").text(mf.slotsram[a.Slot].tipo).appendTo(linha);
var campo = $("[variavel=memorias_ram_select_list]").attr("campo");
linha_s = $("<option />").text(a[campo]).val(a.id);

				if($(".memorias_ram_table_list").find("[ind="+a.id+"]").length){

					$(".memorias_ram_table_list").find("[ind="+a.id+"]").replaceWith( linha )

					$("[variavel=memorias_ram_select_list]").find("[value="+a.id+"]").replaceWith(linha_s)

				} else {

					$(".memorias_ram_table_list").append(linha)

					$("[variavel=memorias_ram_select_list]").append(linha_s);

				}

				$("[variavel=memorias_ram_select_list]").selectpicker('refresh');

				$(".memorias_ram_table_list").trigger("update")

				$("#form_memorias_ram_modal").modal('hide').find("input,textarea").val("");

				

			}

		}

	})

}
alterar_slotsram = function(){

	id = $('#slotsram_lst').find(".selected").attr("ind")

	if(id==undefined)return false;

	sr = mf.slotsram[id]

	for(a in sr)

	$("#form_slotsram_modal").find("[name="+a+"]").val(sr[a])

	$("#form_slotsram_modal").modal("show")}
grava_slotsram = function(){

	var j = {}

	d = $("#form_slotsram_modal").find("form").serializeArray()

	

	for(a in d){

		j[d[a].name] = d[a].value;

	}


	save({

		local:"slotsram",

		dados:j,

		callback:function(b){

			var a  =JSON.parse(b);

			if(a.erro){

				console.log(a)

			} else {

				mf.slotsram[a.id] = a;

				linha = $("<tr/>").attr("ind",a.id);
$("<td />").text(""+a.tipo).appendTo(linha);
var campo = $("[variavel=slotsram_select_list]").attr("campo");
linha_s = $("<option />").text(a[campo]).val(a.id);

				if($(".slotsram_table_list").find("[ind="+a.id+"]").length){

					$(".slotsram_table_list").find("[ind="+a.id+"]").replaceWith( linha )

					$("[variavel=slotsram_select_list]").find("[value="+a.id+"]").replaceWith(linha_s)

				} else {

					$(".slotsram_table_list").append(linha)

					$("[variavel=slotsram_select_list]").append(linha_s);

				}

				$("[variavel=slotsram_select_list]").selectpicker('refresh');

				$(".slotsram_table_list").trigger("update")

				$("#form_slotsram_modal").modal('hide').find("input,textarea").val("");

				

			}

		}

	})

}

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
}</script>
</body>
</html>