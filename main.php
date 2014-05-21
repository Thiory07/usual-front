<?php
function carregaPagina ( $rota ){
	$arquivo = desmembraUrl($_GET[$rota]);
	if ( testaGet ( $rota ) ) {
		require_once($arquivo);
	}else {
		echo "Error 404 - " . $arquivo;
	}
}

function testaGet ( $get ) {
	$arquivo = desmembraUrl($_GET[$get]);
	if (isset($arquivo)) {
	    if(file_exists($arquivo)){
	        return true;
	    }else{
	        return false;
	    }
	} else {
	    return false;
	}
}

function desmembraUrl($arquivo){
	$explode = explode("-", $arquivo);
	if(isset($explode[2])){

		return $explode[0]."-".$explode[1].".tpl";
	}else{
		return $arquivo;
	}
	return $arquivo;
}

carregaPagina ( 'rota' );
?>