<?php 
require_once("model/listaNoticias.class.php");
require_once("includes/funcoes.php");

if ($tamanhoPagina == ""){
	$tamanhoPagina = 2;
}

$pagina = isset($_GET["rota"]) ? pegaPagina(str_replace("/nosFilmes/", "", $_SERVER['REQUEST_URI'])) : 0;
	
$inicioPagina = (($pagina * $tamanhoPagina) - $tamanhoPagina);

if($inicioPagina < 0){
    $inicioPagina = 0;
}

$noticia = new Noticias;

$noticia->set("categoria", $id);
$noticia->set("tamPagina", $tamanhoPagina);
$noticia->set("paginacao", $inicioPagina.", ".$tamanhoPagina);

$noticia->consultarNoticias();
?>
