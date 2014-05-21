<?php
require_once("includes/conexao.php");
require_once("includes/funcoes.php");

class Noticia {

    public $data;
    public $categoria;
    public $id;
    public $lista;
    public $erro;
    public $total;
    public $pasta;
    public $tipo;
    public $token;
    public $titulo;
    private $where;
    private $and;

    function set($prop,$value){
      $this->$prop = $value;
    }



    function consultarNoticia(){

		$this->where = "where 1 = 1 and projecto_noticias.id = ".$this->id;
		$this->and = ($this->categoria > 0) ? "and categoria = ".$this->categoria : "";

    	$obj = new Conexao();

		$sql = "select projecto_noticias.*, projecto_categorias_noticias.titulo as nomeCategoria from projecto_noticias 
					inner join projecto_categorias_noticias
						on projecto_noticias.categoria = projecto_categorias_noticias.id
					" .$this->where." ".$this->and;	

		$obj->set('sql', $sql);
		$res = $obj->query();
		$total = mysql_num_rows($res);

		$i=-1;
		$rs = mysql_fetch_array($res);

		$this->numero = $rs["id"];
		$this->titulo = $rs["titulo"];
		$this->subtitulo = $rs["subtitulo"];
		$this->texto = $rs["texto"];
		$this->data = converteData($rs["data_entrada"]);
		$this->pasta = "noticias";
		$this->categoria = $rs["nomeCategoria"];

		if($total >= 0){
			if (strpos($this->texto,'watch?v=') !== false) {
				$this->token = explode("watch?v=", $this->texto);
				$this->token = str_replace("</p>", "", $this->token[1]);
				return $this->token;
			}
			return $this->numero;
			return $this->titulo;
			return $this->subtitulo;
			return $this->texto;
			return $this->data;
			return $this->pasta;
		}else{
			return $this->erro = "Não há registros para essa consulta";
			return $this->total = 0;
		}
	}
}
?>