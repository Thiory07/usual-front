<?php 
require_once("model/noticiaCompleta.class.php");

function pegaId($arquivo){
	$explode = explode("-", $arquivo);
	if(isset($explode[2])){
		return str_replace(".tpl", "", $explode[2]);
	}else{
		return '';
	}
}

$id = pegaId($_GET["rota"]);

if($id == ""){
	$id = isset($_GET["id"]) ? mysql_real_escape_string($_GET["id"]) : "";
}

$noticia = new Noticia;
$noticia->set("id", $id);

$noticia->consultarNoticia();
?>