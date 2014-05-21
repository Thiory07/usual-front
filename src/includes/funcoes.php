<?php
function ConverteData($Data){
	 if (strstr($Data, "/"))//verifica se tem a barra /
	 {
	   $d = explode ("/", $Data);//tira a barra
	   $rstData = "$d[2]-$d[1]-$d[0]";//separa as datas $d[2] = ano $d[1] = mes etc...
	   return $rstData;
	} elseif(strstr($Data, "-")){
	  $d = explode ("-", $Data);
	  $rstData = "$d[2]/$d[1]/$d[0]";
	  return $rstData;
	 }else{
	   return "Data invalida";
	 }
 }
 function msg_box($tipo, $mensagem){
		echo "<script type='text/javascript'>alert('".$mensagem."'); history.go(-1);</script>";
		exit;
 }
 function checado($valor1, $valor2){
 	if(utf8_encode($valor1) == utf8_encode($valor2)){
		echo "checked";
	}
 }
 function selecionado($valor1, $valor2){
 	if($valor1 == $valor2){
		echo "selected='true'";
	}
 }
 function scandirNoFolders($dir)
	{
	  $handle = opendir($dir);
	  if ( !$handle ) return array();
	  $contents = array();
	  while ( $entry = readdir($handle) )
	  {
	    if ( $entry=='.' || $entry=='..' ) continue;

	    //$entry = $dir.DIRECTORY_SEPARATOR.$entry;
	    if ( is_file($dir.DIRECTORY_SEPARATOR.$entry) )
	    {
	      $contents[] = $entry;
	    }
	    else if ( is_dir($entry) )
	    {
	      $contents = array_merge($contents, getDirContents($entry));
	    }
	  }
	  closedir($handle);
	  return $contents;
	}

function GerarGaleria($diretorio)
	//Lista as miniaturas com os links para o prettyphoto
	//$diretorio = pasta onde deve conter as imagens para listagem;
	{
		$arquivos = scandirNoFolders($diretorio);
		echo "<div class=\"masonry\" id=\"container\">";
		foreach ($arquivos as $arquivo) {
			$imgInfo = getimagesize($diretorio."/".$arquivo);
			echo '<div class="masonryImage masonry-brick">
						<img src="'.$diretorio.'/'.$arquivo.'">
					</div>';
		}
		echo "</div>";
}
function check_permissao($opcao, $quant, $string){

	$per = explode("|", $string);
	
	for($i=0;$i<$quant+2;$i++){
		if($opcao == $per[$i]){
			echo "checked";
		}
	}
}
function mes($m){
	switch($m){
		case "01":
			echo "JAN";
			break;
		case "02":
			echo "FEV";
			break;
		case "03":
			echo "MAR";
			break;
		case "04":
			echo "ABR";
			break;
		case "05":
			echo "MAI";
			break;
		case "06":
			echo "JUN";
			break;
		case "07":
			echo "JUL";
			break;
		case "08":
			echo "AGO";
			break;
		case "09":
			echo "SET";
			break;
		case "10":
			echo "OUT";
			break;
		case "11":
			echo "NOV";
			break;
		case "12":
			echo "DEZ";
			break;
	}
}

function trocaacento($texto){
	$texto = utf8_decode($texto);
	$array1 = array( "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
	, "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" );
	$array2 = array( "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
	, "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" );
	return str_replace( $array1, $array2, $texto);
}
function codificacao($string) {
    return mb_detect_encoding($string.'x', 'UTF-8, ISO-8859-1');
}
function utf8Fix($msg){

	if ( codificacao( $msg ) == 'UTF-8' ){
		$msg = utf8_decode($msg);
	}

	$accents = array("Ã¡","Ã ","Ã¢","Ã£","Ã¤","Ã©","Ã¨","Ãª","Ã«","Ã­","Ã¬","Ã®","Ã¯","Ã³","Ã²","Ã´","Ãµ","Ã¶","Ãº","Ã¹","Ã»","Ã¼","Ã§","Ã","Ã€","Ã‚","Ãƒ","Ã„","Ã‰","Ãˆ","ÃŠ","Ã‹","Ã","ÃŒ","ÃŽ","Ã","Ã“","Ã’","Ã”","Ã•","Ã–","Ãš","Ã™","Ã›","Ãœ","Ã‡");
	$utf8 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç");
	
	$accents = array();
	$utf8 = array();
	$fix = str_replace($utf8, $accents, $msg);
	return utf8_encode($fix);
}
function converteUrl($texto){

	$texto = trim($texto);
	$texto = trocaacento($texto);
	$texto = strtolower($texto);
	$texto = str_replace("   ", "-", $texto);
	$texto = str_replace("  ", "-", $texto);
	$texto = str_replace(" ", "-", $texto);
	$texto = str_replace("--", "-", $texto);
	$texto = str_replace("---", "-", $texto);
	$texto = str_replace("%", "", $texto);
	$texto = str_replace("&", "", $texto);
	$texto = str_replace("'", "", $texto);
	$texto = str_replace("!", "", $texto);
	$texto = str_replace(".", "", $texto);
	$texto = str_replace(",", "", $texto);
	$texto = str_replace("?", "", $texto);
	return $texto;
}


function pegaPagina($arquivo){
	$explode = explode("-", $arquivo);

	if(isset($explode[2])){

		return str_replace(".tpl", "", $explode[2]);
	}else{
		return '1';
	}
}

?>
