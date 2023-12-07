<?php
if (!file_exists("modulos.json")) {
	file_put_contents("modulos.json", "{}");
}
$modulos = json_decode(file_get_contents("modulos.json"), true);

?>
<!DOCTYPE html>
<html lang="pt">

<head>
	<title>Gerador de Modulos</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="css/bootstrap.min.css" media="all" />
	<link rel="stylesheet" href="css/bootstrap-select.min.css" media="all" />

	<script src="js/jquery.min.js"></script>
	<script src="js/base64.js"></script>
	<script src="js/gerador.palavras.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/defaults-pt_BR.js"></script>
	<script src="js/jquery.tablesorter.min.js"></script>
	<script src="js/vue.min.js"></script>
	<script>
		function send(a /*= configurações */ ) {
			def = {
				url: "index.php",
				method: "get",
				format: "json",
				data: {},
				cache: false,
			}
			$.extend(true, def, a);
			def.complete = function(e) {}
			$.ajax(def).done(a.complete);
		}

		view = {
			titulo: "",
			_campos: [],
			campos: {}
		}
		$(document).ready(function() {
			vue = new Vue({
				el: "#container",
				data: {
					view: view
				}
			})
		})

		function novocampo() {
			view._campos.push({
				"id": "",
				"titulo": "",
				"tipo": "",
				"referencia": "",
				"campo": ""
			})
		}

		function gravarcampo() {
			for (a in view._campos) {
				view.campos[view._campos[a].id] = view._campos[a];
			}
			delete(view._campos);
			$("#result").val(JSON.stringify(view))
			send({
				data: {
					mod: Base64.encode(JSON.stringify(view))
				}
			})
			location.reload()
		}
	</script>
</head>

<body>
	<div id="container" class="container">
		<form class="form-horizontal">
			<fieldset>
				<legend>Modulos</legend>
			</fieldset>
			<div class="table-responsive">
				<table id="servicos_lst" class="table table-striped table-hover">
					<?php
					foreach ($modulos as $a => $value) {
						echo "<tr><td>" . $value["titulo"] . "</td></tr>";
					}
					?>
				</table>
			</div>
			<div class="row">
				<div class="form-group">
					<label class="col-md-4 control-label" for="nome">titulo</label>
					<div class="col-md-4">
						<input id="nome" name="nome" type="text" placeholder="Nome" v-model="view.titulo" class="form-control input-md" />
					</div>
				</div>
			</div>
			<div class="row" v-for="a in view._campos">

				<div class="col-md-4">
					<div class="form-group">
						<label class="col-md-4 control-label" for="nome">id</label>
						<div class="col-md-4">
							<input id="nome" name="nome" type="text" placeholder="Nome" v-model="a.id" class="form-control input-md" />
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="col-md-4 control-label" for="nome">Titulo</label>
						<div class="col-md-4">
							<input id="nome" name="nome" type="text" placeholder="Nome" v-model="a.titulo" class="form-control input-md" />
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="col-md-4 control-label" for="nome">Tipo</label>
						<div class="col-md-4">
							<select id="nome" name="nome" type="text" placeholder="Nome" v-model="a.tipo" class="form-control input-md">
								<option value="text">Text</option>
								<option value="password">Senha</option>
								<option value="number">Numero</option>
								<option value="textarea">Textarea</option>
								<option value="referencia">Referencia</option>
								<option value="referencia_multipla">Referencia Multipla</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="col-md-4 control-label">Referencia</label>
						<div class="col-md-4">
							<input type="text" placeholder="Nome" v-model="a.referencia" class="form-control input-md" />
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="col-md-4 control-label">Campo</label>
						<div class="col-md-4">
							<input type="text" placeholder="Nome" v-model="a.campo" class="form-control input-md" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="btn btn-primary" onclick="novocampo()">Novo campo</div>
				<div class="btn btn-primary" onclick="gravarcampo()">Gravar</div>
			</div>
			<div class="row">
				<textarea id="result"></textarea>
			</div>
		</form>
	</div>
</body>

</html>