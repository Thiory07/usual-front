<?php
require_once 'src/includes/funcoes.php';
require_once 'src/config/config.php';

//$arquivos = scandirNoFolders($pastaCss);

$arquivos = array(
	'default.css'
);

$css_content = '';
foreach ($arquivos as $arquivo) { 
$css_content .= compress(file_get_contents('src/css/'.$arquivo));
}
function compress($buffer) {
	/* remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	/* remove tabs, spaces, newlines, etc. */
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}
$fp = fopen('src/css/css.min.css',"wb");
fwrite($fp,$css_content);
fclose($fp);
?>
<link rel="stylesheet" href="<?php echo $pastaCss.'/css.min.css'; ?>">