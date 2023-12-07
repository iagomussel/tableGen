<?php	
	if(!isset($_GET["local"])) 
		exit("{\"error\":true}");
	$local = "json/".$_GET["local"].".json";
	$dados = isset($_GET["dados"])?json_decode(base64_decode($_GET['dados']),true):array();
	$lendo = json_decode(file_get_contents($local),true);
	$id = (isset($dados["id"])?$dados["id"]:"");
	
	if(isset($lendo[$id]["id"])){
		$lendo[$id] = $dados;
	} else {	
		$id = "COD".count($lendo);
		$lendo[$id] = $dados;
		$lendo[$id]["id"] = $id;
	}
	echo json_encode($lendo[$id],JSON_PRETTY_PRINT);	
	file_put_contents($local,json_encode($lendo,JSON_PRETTY_PRINT))
?>
