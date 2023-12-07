<?php
$page_index = "<?php";

$modulos = json_decode(file_get_contents("modulos.json"), true);
if (isset($_GET["mod"])) {
	$d = json_decode(base64_decode($_GET["mod"]), true);
	$id = trim(strtolower($d["titulo"]), " ");
	$what = array('ä', 'ã', 'à', 'á', 'â', 'ê', 'ë', 'è', 'é', 'ï', 'ì', 'í', 'ö', 'õ', 'ò', 'ó', 'ô', 'ü', 'ù', 'ú', 'û', 'À', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ', 'ç', 'Ç', ' ', '-', '(', ')', ',', ';', ':', '|', '!', '"', '#', '$', '%', '&', '/', '=', '?', '~', '^', '>', '<', 'ª', 'º');
	$by   = array('a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'A', 'A', 'E', 'I', 'O', 'U', 'n', 'n', 'c', 'C', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_');
	$id = str_replace($what, $by, $id);
	$modulos[$id] = $d;
	file_put_contents("modulos.json", json_encode($modulos));
}
foreach ($modulos as $a => $value) {
	$page_index .= "\n$" . $a . " = json_decode(file_get_contents(\"json/" . $a . ".json\"),true);";
}
$page_index .= "\n?>";
$page_index .= "\n<!DOCTYPE html>";
$page_index .= "\n<html lang=\"pt\">";
$page_index .= "\n    <head>";
$page_index .= "\n       <title>Sistema\n</title>";
$page_index .= "\n        <meta charset=\"utf-8\" />";
$page_index .= "\n        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />";
$page_index .= "\n        <link rel=\"stylesheet\" href=\"css/bootstrap.min.css\" media=\"all\"/>";
$page_index .= "\n        <link rel=\"stylesheet\" href=\"css/bootstrap-select.min.css\" media=\"all\"/>";
$page_index .= "\n        <style  media=\"all\">";
$page_index .= "\n            tr.selected {";
$page_index .= "\n                outline:solid 2px rgba(16,205,206,1);";
$page_index .= "\n            }";
$page_index .= "\n        \n</style>";
$page_index .= "\n		<style  media=\"print\">";
$page_index .= "\n			.noprint{";
$page_index .= "\n				display:none";
$page_index .= "\n			}";
$page_index .= "\n		tr.selected {";
$page_index .= "\n                outline:none;";
$page_index .= "\n            }";
$page_index .= "\n		legend{";
$page_index .= "\n			text-align:center;";
$page_index .= "\n		}";
$page_index .= "\n		\n</style>";
$page_index .= "\n        <script src=\"js/jquery.min.js\">\n</script>";
$page_index .= "\n        <script src=\"js/base64.js\">\n</script>";
$page_index .= "\n        <script src=\"js/gerador.palavras.js\">\n</script>";
$page_index .= "\n        <script src=\"js/bootstrap.min.js\">\n</script>";
$page_index .= "\n        <script src=\"js/bootstrap-select.min.js\">\n</script>";
$page_index .= "\n        <script src=\"js/defaults-pt_BR.js\">\n</script>";
$page_index .= "\n        <script src=\"js/jquery.tablesorter.min.js\">\n</script>";
$page_index .= "\n       <script>";
$page_index .= "\n            mf = {";
foreach ($modulos as $a => $value)
	$page_index .= "\n        " . $a . ": <?php echo json_encode($" . $a . ") ;?>,";
$page_index .= "\n}";
$page_index .= "\n</script>";
foreach ($modulos as $a => $value)
	$page_index .= "\n<script src=\"modulos\\" . $a . "\\js\\index.js\"></script>";
$page_index .= "\n\n</head>\n\n";
$page_index .= "<body><div id=\"container\" class=\"container\">	";

$page_index .= "<!-- navbar-->";
$page_index .= "\n<div class=\"painel \"><ul class=\"nav nav-tabs navbar-inverse noprint\">";
foreach ($modulos as $a => $value) {
	if ($value)
		$page_index .= "\n<li><a data-toggle=\"tab\" href=\"#" . $a . "\">" . $value["titulo"] . "\n</a>\n</li>";
}

$page_index .= "<!-- tab content-->";
$page_index .= "\n\n</ul><div class=\"tab-content\">";
foreach ($modulos as $a => $value) {
	$page_index .= "\n<div id=\"" . $a . "\" class=\"tab-pane fade \">";
	$page_index .= "\n<form class=\"form-horizontal\"><fieldset><legend>" . $value["titulo"] . "\n</legend>";
	$page_index .= "\n<div class=\"btn-group noprint\" role=\"group\" aria-label=\"Controles\"><div class=\"btn btn-primary\" data-target=\"#form_" . $a . "_modal\" data-toggle=\"modal\">Novo<span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\">\n</span>\n</div>\n";
	$page_index .= "\n<div class=\"btn btn-default\" onclick=\"alterar_" . $a . "()\">Editar<span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\">\n</span>\n</div>\n";
	$page_index .= "\n<div class=\"btn btn-default\" onclick=\"window.print()\">Imprimir <span class=\"glyphicon glyphicon-print\" aria-hidden=\"true\">\n</span>\n</div>\n\n</div>\n";
	$page_index .= "\n<div class=\"table-responsive\">";
	$page_index .= "\n<input type=\"text\" class=\"search form-control noprint\" placeholder=\"Filtro de pesquisa\" target=\"#" . $a . "_lst\" />";
	$page_index .= "\n<table id=\"" . $a . "_lst\" class=\"table table-striped table-hover\">";
	$page_index .= "\n<thead><tr>";
	foreach ($value["campos"] as $cv => $c) {
		$page_index .= "\n<th>" . $c["titulo"] . "\n</th>";
	}
	$page_index .= "\n\n</tr>\n</thead><tbody class=\"" . $a . "_table_list\">";
	$page_index .= "\n<?php foreach($" . $a . " as $" . "linha){";
	$page_index .= "\necho \"<tr ind=\".$" . "linha['id'].\">\";";
	foreach ($value["campos"] as $cv => $c) {
		$page_index .= "\necho \"<td>\"";
		if (isset($c["tipo"]) && $c["tipo"] == "referencia") {
			$page_index .= ".$" . $c["referencia"] . "[$" . "linha[\"" . $cv . "\"]][\"" . $c["campo"] . "\"].";
		} else {
			$page_index .= ".$" . "linha[\"" . $cv . "\"].";
		}
		$page_index .= "\"\n</td>\";";
	}
	$page_index .= "\n}?>";
	$page_index .= "\n\n</tr>";
	$page_index .= "\n\n</tbody>\n</table>\n</div>\n";
	$page_index .= "\n\n</fieldset>\n</form>\n</div>\n";
}




$page_index .= "<!-- modal content -->";


foreach ($modulos as $a => $value) {
	$page_index .= "<div id=\"form_" . $a . "_modal\" class=\"modal fade\" role=\"dialog\">";
	$page_index .= "<div class=\"modal-dialog modal-lg\">";
	$page_index .= "        <div class=\"modal-content\">";
	$page_index .= "            <div class=\"modal-header\">";
	$page_index .= "                <div type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;\n</div>\n";
	$page_index .= "                <h4 class=\"modal-title\">" . $value["titulo"] . "\n</h4>";
	$page_index .= "            \n</div>\n";
	$page_index .= "            <div class=\"modal-body\">";
	$page_index .= "                <form class=\"form-horizontal\">";
	$page_index .= "                    <fieldset>";
	$page_index .= "                        <input type=\"hidden\" id=\"id\" name=\"id\" />";
	foreach ($value["campos"] as $cv => $c) {
		$page_index .= "<div class=\"form-group\"><label class=\"col-md-4 control-label\" for=\"" . $cv . "\">" . $c["titulo"] . "\n</label><div class=\"col-md-4\">";

		switch (isset($c["tipo"]) ? ($c["tipo"]) : "text") {
			case "referencia":
				$page_index .= " <div class=\"input-group\">";
				$page_index .= "<div class=\"input-group-addon btn\" data-toggle=\"modal\" data-target=\"#form_" . $c["referencia"] . "_modal\" aria-expanded=\"true\">";
				$page_index .= "<div ><span class=\"glyphicon glyphicon-plus\"></span></div></div>";
				$page_index .= "<select id=\"" . $cv . "\" data-live-search=\"true\" name=\"" . $cv . "\" campo=\"" . $c["campo"] . "\"";
				$page_index .= "class=\"form-control show-tick selectpicker\" variavel=\"" . $c["referencia"] . "_select_list\" required=\"\" >";
				$page_index .= "						<?php";
				$page_index .= "						if(!count($" . $c["referencia"] . ")){\n";
				$page_index .= "						} else foreach($" . $c["referencia"] . " as $" . "s){\n";
				$page_index .= "echo \"<option value='\".$" . "s[\"id\"].\"'>";
				$page_index .= "\".$" . "s[\"";
				$page_index .= $c["campo"] . "\"].\"\n</option>\";\n";
				$page_index .= "} ?>\n</select></div>";
				break;
			case "textarea":
				$page_index .= "<textarea class=\"form-control\" id=\"" . $cv . "\" name=\"" . $cv . "\">\n</textarea>";
				break;
			case "referencia_multipla":
				$page_index .= " <div class=\"input-group\">";
				$page_index .= "<div class=\"input-group-addon btn\" data-toggle=\"modal\" data-target=\"#form_" . $c["referencia"] . "_modal\" aria-expanded=\"true\">";
				$page_index .= "<div ><span class=\"glyphicon glyphicon-plus\"></span></div></div>";
				$page_index .= "<select campo='" . $c["campo"] . "' multiple id=\"" . $cv . "\" data-live-search=\"true\" name=\"" . $cv . "\" value=\"\"";
				$page_index .= "class=\"form-control show-tick selectpicker\" variavel=\"" . $cv . "_select_list\" required=\"\" >";
				$page_index .= "						<?php";
				$page_index .= "						if(!count($" . $c["referencia"] . ")){\n";
				$page_index .= "						} else foreach($" . $c["referencia"] . " as $" . "s){\n";
				$page_index .= "echo \"<option value='\".$" . "s[\"id\"].\"'>";
				$page_index .= "\".$" . "s[\"";
				$page_index .= $c["campo"] . "\"].\"\n</option>\";\n";
				$page_index .= "} ?>\n</select></div>";
				break;
			default:
				$page_index .= "<input id=\"" . $cv . "\" name=\"" . $cv . "\" type=\"" . (isset($c["tipo"]) ? ($c["tipo"]) : "text") . "\" placeholder=\"" . $c["titulo"] . "\" class=\"form-control input-md\" />";
				break;
		}
		$page_index .= "";
		$page_index .= "\n</div>\n\n</div>\n";
	}
	$page_index .= "     \n</fieldset>\n</form> \n</div>\n <div class=\"modal-footer\">";
	$page_index .= "                        <div type=\"button\" class=\"btn btn-primary\"  onclick=\"grava_" . $a . "()\">Gravar\n</div>\n ";
	$page_index .= "                        <div type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Fechar\n</div>\n\n</div>\n \n</div>\n\n</div>\n\n</div>\n";
}
$page_index .= "\n</div>\n</div>\n</div>";
$page_index .= "<script>";
$page_index .= "\n function send(a){def={url:\"rule.php\",method:\"get\",format:\"json\",data:{},cache:false};$.extend(true, def, a);def.complete = function(e){};$.ajax(def).done(a.complete);}";
$page_index .= "\n$(document).ready(function() {";
$page_index .= "\n  $" . "(\".search\").keyup(function() {target_id = $(this).attr(\"target\");if (target_id == \"\") {return false};if ('' != this.value) {var reg = new RegExp(this.value, 'i');$(target_id + ' tbody').find('tr').each(function() {var $" . "me = $(this);if (!$";
$page_index .= "me.children('td').text()";
$page_index .= ".match(reg)) {" . "$" . "me.hide();} else {" . "$";
$page_index .= "me.show();}});} else {" . "$(target_id + ' tbody').find('tr').show();}})";
$page_index .= "\n $(\"table\").tablesorter()\n";

foreach ($modulos as $a => $value) {
	$page_index .= "$('#" . $a . "_lst').on('click', 'tbody tr', function() {
\n		$('#" . $a . "_lst').find(\"tbody tr\").removeClass(\"selected\");
\n		$(this).addClass(\"selected\");
\n  });";
}
$page_index .= "})";
foreach ($modulos as $a => $value) {

	$page_index .= "\nalterar_" . $a . " = function(){
\n	id = $('#" . $a . "_lst').find(\".selected\").attr(\"ind\")
\n	if(id==undefined)return false;
\n	sr = mf." . $a . "[id]
\n	for(a in sr)
\n	$(\"#form_" . $a . "_modal\").find(\"[name=\"+a+\"]\").val(sr[a])
\n	$(\"#form_" . $a . "_modal\").modal(\"show\")}";

	$page_index .= "\ngrava_" . $a . " = function(){
\n	var j = {}
\n	d = $(\"#form_" . $a . "_modal\").find(\"form\").serializeArray()
\n	
\n	for(a in d){
\n		j[d[a].name] = d[a].value;
\n	}
";
	foreach ($value["campos"] as $cv => $c) {
		if (isset($c["required"]) && $c["required"])
			$page_index .= "\n	if(j." . $cv . " == \"\") return false;";
	}
	$page_index .= "
\n	save({
\n		local:\"" . $a . "\",
\n		dados:j,
\n		callback:function(b){
\n			var a  =JSON.parse(b);
\n			if(a.erro){
\n				console.log(a)
\n			} else {
\n				mf." . $a . "[a.id] = a;
\n				linha = $(\"<tr/>\").attr(\"ind\",a.id);";

	foreach ($value["campos"] as $cv => $c) {
		if (isset($c["tipo"]) && $c["tipo"] == "referencia") {
			$page_index .= "\n$(\"<td />\").text(mf." . $c["referencia"] . "[a." . $cv . "]." . $c["campo"] . ").appendTo(linha);";
		} else {
			$page_index .= "\n$(\"<td />\").text(\"\"+a." . $cv . ").appendTo(linha);";
		}
	};
	$page_index .= "\nvar campo = $(\"[variavel=" . $a . "_select_list]\").attr(\"campo\");";
	$page_index .= "\nlinha_s = $(\"<option />\").text(a[campo]).val(a.id);";
	$page_index .= "
\n				if($(\"." . $a . "_table_list\").find(\"[ind=\"+a.id+\"]\").length){
\n					$(\"." . $a . "_table_list\").find(\"[ind=\"+a.id+\"]\").replaceWith( linha )
\n					$(\"[variavel=" . $a . "_select_list]\").find(\"[value=\"+a.id+\"]\").replaceWith(linha_s)
\n				} else {
\n					$(\"." . $a . "_table_list\").append(linha)
\n					$(\"[variavel=" . $a . "_select_list]\").append(linha_s);
\n				}
\n				$(\"[variavel=" . $a . "_select_list]\").selectpicker('refresh');
\n				$(\"." . $a . "_table_list\").trigger(\"update\")
\n				$(\"#form_" . $a . "_modal\").modal('hide').find(\"input,textarea\").val(\"\");
\n				
\n			}
\n		}
\n	})
\n}";
}

$page_index .= "\n\nsave = function(options){
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
}";

$page_index .= "</script>";


$page_index .= "\n</body>\n</html>";
file_put_contents("page/index.php", $page_index);
foreach ($modulos as $a => $value) {
	if (!file_exists("page/json/" . $a . ".json")) {
		file_put_contents("page/json/" . $a . ".json", "{}");
	}
}

?>
<a href="page/index.php">Verifique se ocorreu tubo bem</a>