<?php
require_once("includes/funcoes.php");
require_once("includes/conexao.php");

class Noticias {

    private $paginacao;
    private $datas;
    private $onde;
    private $categoria;
    public $tamPagina;
    public $id;
    public $lista;
    public $erro;
    public $total;
    public $pasta;
    public $cat;
    public $numPaginas;
    public $numPosts;


    function set($prop,$value){
      $this->$prop = $value;
    }

    function consultarNoticias(){
		$this->where = isset($this->onde) ? "where 1 = 1 and id = ".$this->id : "where 1 = 1";
		$this->and = ($this->categoria > 0) ? "and categoria = ".$this->categoria : "";
    	$obj = new Conexao();

		$sql = "select * from projecto_noticias ".$this->where." ".$this->and." order by id desc limit ".$this->paginacao;	
		//echo $sql;
		$obj->set('sql', $sql);
		$res = $obj->query();

		$i=-1;
		while($rs = mysql_fetch_array($res)){
			$i++;

			$this->numero[$i] = $rs["id"];
			$this->titulo[$i] =$rs["titulo"];
			$this->subtitulo[$i] =$rs["subtitulo"];
			$this->texto[$i] = strip_tags(substr($rs["texto"], 0, 800));
			$this->texto[$i] = $this->texto[$i];
			$this->data[$i] = converteData($rs["data_entrada"]);
			$this->total = $i;
		}

		$this->pasta = "noticias";

		/*
		if($this->categoria != ""){
			$sql = "select * from projecto_categorias_noticias where id = ".$this->categoria;
			$obj->set('sql', $sql);
			$res = $obj->query();
			$rs = mysql_fetch_array($res);
			$this->cat = $rs["titulo"];
		}else{
			$this->cat = "Qualidade Sanipel";
		}
		*/

		$sql = "select id from projecto_noticias ".$this->where." ".$this->and;	

		$obj->set('sql', $sql);
		$res = $obj->query();
		
		$this->numPosts = mysql_num_rows($res);

		$this->numPaginas = ceil(($this->numPosts) / $this->tamPagina);
		

		if($this->total >= 0){
			return $this->numPaginas;
			return $this->numero;
			return $this->titulo;
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