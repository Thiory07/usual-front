<?PHP
$destinatario = "matheus@dgoh.org";
$email = $destinatario;
$enctype = "text/html";
$assunto = "Contato Site";
$mensagem = "";

$campoVazio = 0;
foreach ($_POST as $key => $value) {
	$mensagem .= $key." : ".$value."<br>";
}

if ($mensagem != "" && $campoVazio <= 0) {
	//echo $mensagem;

	$header = "MIME-Version: 1.0\n"; 
	$header .= "Content-type: ".$enctype."; charset=utf-8\n"; 
	$header .= "From: ".$email."\n";
	$header .= "Reply-to: ".$email."\n";

	if (mail($destinatario, $assunto, $mensagem, $header,'-r'.$email) ){
		echo "email enviado com sucesso!";
	}else {
		echo "Erro email 001";
	}
}else {
	echo "Preencha todos os campos";
}
?>