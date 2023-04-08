<?php
$q=$_GET['q'];
$domain=mb_strtolower(trim($q));

// extrair apenas o domínio
$parse = parse_url($q);
if(isset($parse['host'])){
	$domain=$parse['host'];
}

// verifica se existe
$unix_time=xDiasAtras(1)['unix_time'];
$domainMD5=md5($domain);
$rank=ramRead($unix_time.'_domain_'.$domainMD5);
if($rank){
	$url='/s/'.$domain;
	redirect($url);
}else{
	require '404.php';
}
