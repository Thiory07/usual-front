<?php 
require_once 'src/config/config.php';
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo(TOKEN_ANALYTICS); ?>', 'ocm.br');
  ga('send', 'pageview');

</script>

<?php

$rota = isset($_GET["rota"]) ? $_GET["rota"] : "";
$explode = explode("/", $rota);
$rota = isset($explode[1]) ? $explode[1] : "";

switch ($rota){
	case "":
		$titulo = " | ".NOME;
		$description = "";
		$keywords = "";
		$cannonical = DOMINIO."/".$rota;
	break;

	case URL_NOTICIA:
		if (TEM_NOTICIAS) {
			require_once 'includes/conexao.php';

			$id = explode("-", $_SERVER['REQUEST_URI']);
			$query = "SELECT titulo,texto FROM projecto_noticias WHERE id = ".$id[2];
			$obj->set('sql', $query);
			$res = $obj->query();

			$i=0;
			
			while($rs = mysql_fetch_array($res)){
				$i++;
				$titulo = $rs["titulo"]." | ".NOME;
				$description = trim(strip_tags(substr($rs["texto"], 0, 180)));
				$keywords = $rs["titulo"];
				$cannonical = DOMINIO.$_SERVER['REQUEST_URI'];
			}
		}
	break;

	default:
		$titulo = NOME;
		$description = "";
		$keywords = "";
		$cannonical = DOMINIO."/";
}
?>