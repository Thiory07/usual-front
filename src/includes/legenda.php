<?php
$legenda = $arquivo;
$legenda = strtolower($legenda);
$legenda = ucfirst($legenda);
$legenda = str_replace("logistica", "logística", $legenda);
$legenda = str_replace("degustacao", " degustação", $legenda);
$legenda = str_replace("sustentavel", "sustentável", $legenda);
$legenda = str_replace("edificio", "edifício", $legenda);
$legenda = str_replace("locacao", "locação", $legenda);
$legenda = str_replace("andmax", "Andmax", $legenda);
$legenda = str_replace("metalico", "metálico", $legenda);
$legenda = str_replace("nr18", "NR18", $legenda);
$legenda = str_replace("colegio", "colégio", $legenda);
$legenda = str_replace("guarulhos", "Guarulhos", $legenda);
$legenda = str_replace("ibis", "Ibis", $legenda);
$legenda = str_replace("sao_paulo", "São Paulo", $legenda);
$legenda = str_replace("joao", "João", $legenda);
$legenda = str_replace("av_paulista", "Av Paulista", $legenda);
$legenda = str_replace("batista", "Batista", $legenda);
$legenda = str_replace("pindamonhagada", "Pindamonhagada", $legenda);
$legenda = str_replace("novelis", "Novelis", $legenda);
$legenda = str_replace("pedroso", "Pedroso", $legenda);
$legenda = str_replace("guaratingueta", "Guaratinguetá", $legenda);
$legenda = str_replace("campus_bom_pastor", "Campus Bom Pastor", $legenda);
$legenda = str_replace("agc_vidros", "AGC Vidros", $legenda);
$legenda = str_replace("ceunsp", "CEUNSP", $legenda);
$legenda = str_replace("bernardo", "Bernardo", $legenda);
$legenda = str_replace("good_year", "Good Year", $legenda);
$legenda = str_replace("brasil", "Brasil", $legenda);
$legenda = str_replace("odebrecht ", "Odebrecht ", $legenda);
$legenda = str_replace("sao_bernardo", "São Bernardo", $legenda);
$legenda = str_replace("porto_seguro", "Porto Seguro", $legenda);
$legenda = str_replace("sao", "São", $legenda);
$legenda = str_replace("regulavel", "regulável", $legenda);
$legenda = str_replace("ajustavel", "ajustável", $legenda);
$legenda = str_replace("metalico", "metálico", $legenda);
$legenda = str_replace("rodape", "rodape", $legenda);
$legenda = str_replace("sp", "- SP", "$legenda");

$legenda = str_replace("_", " ", "$legenda");
$legenda = substr($legenda, 0,-4);
$legenda = str_replace("-", " ", "$legenda");
$legenda = str_replace("+", "", "$legenda");
$legenda = str_replace(".", "", "$legenda");
$legenda = utf8_encode($legenda);
?>