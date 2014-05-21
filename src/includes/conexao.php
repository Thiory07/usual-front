<?php
class Conexao {

   /* Declaração das variáveis (propriedades) da classe*/
   
   public $host; // Host (Servidor) que executa o banco de dados
   public $user; // Usuário que se conecta ao servidor de banco de dados
   public $pass; // Senha do usuário para conexão ao banco de dados
   public $db; // Nome do banco de dados a ser utilizado
   public $sql; // String da consulta SQL a ser executada
   
   function conectar(){

	$con = mysql_connect($this->host,$this->user,$this->pass) or die($this->erro("Não foi possível Conectar."));
	mysql_set_charset('utf8', $con);
    return $con;
	
   }
   
   function selecionarDB(){
      
      $sel = mysql_select_db($this->db) or die($this->erro("Não Foi Possível selecionar o BD."));
      if($sel){
         return true;
      }else{
         return false;
      }
   }
   
   function query(){
      $qry = mysql_query($this->sql) or die ($this->sql);
      return $qry;
   }
   
   function set($prop,$value){
      $this->$prop = $value;
   }
   
   function getSQL(){
      return $this->sql;
   }
   
   function erro($erro){
      echo $erro;
   }
}

$obj = new Conexao; // Instanciando a classe

if(strlen($_SERVER["REMOTE_ADDR"]) < 12){
	// Atribuindo valores às propriedades da classe
	$obj->set('db','nosfilmes');
	$obj->set('host','localhost');
	$obj->set('user','root');
	$obj->set('pass','usbw');
	$obj->conectar(); // Realiza a conexão
	$obj->selecionarDB(); // Seleciona o banco de dados
}else{
	// Atribuindo valores às propriedades da classe
	$obj->set('db','site1387801154');
	$obj->set('host','186.202.152.106');
	$obj->set('user','site1387801154');
	$obj->set('pass','nos14filmes');
	$obj->conectar(); // Realiza a conexão
	$obj->selecionarDB(); // Seleciona o banco de dados
}
?>
