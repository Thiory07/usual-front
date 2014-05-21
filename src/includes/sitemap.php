<?php
	require_once '../includes/conexao.php';
	require_once '../includes/funcoes.php';
	require_once '../config/config.php';
	header("Content-Type: text/xml");

	$data = "2014-01-16";
   	$ignorar = array('.',
   					'..',
   					'main.tpl',
   					URL_NOTICIA.'.tpl',
   					'topo.tpl',
   					'footer.tpl');
   	$arquivos = array_diff(scandirNoFolders("../view/"), $ignorar);

	
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
	<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
    
    if (TEM_NOTICIAS) {
    	$query = "SELECT titulo,id FROM projecto_noticias";
		$obj->set('sql', $query);
		$res = $obj->query();

		$i=0;
		
		while($rs = mysql_fetch_array($res)){
			echo "<url> 
				<loc>".DOMINIO.URL_NOTICIA."-".$rs["id"]."-".converteUrl($rs["titulo"])."</loc> 
				<lastmod>".$data."</lastmod> 
			</url>";
		}
    }

    foreach ($arquivos as $arquivo) {
    	echo "<url> 
				<loc>".DOMINIO.str_replace(".tpl", "", $arquivo)."</loc> 
				<lastmod>".$data."</lastmod> 
			</url>";
    }
   
    echo "</urlset>";
?>