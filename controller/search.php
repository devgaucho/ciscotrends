<?php
$q=$_GET['q'];
$q=mb_strtolower(trim($q));

// extrair apenas o domínio
$parse = parse_url($q);
if(isset($parse['host'])){
	$q=$parse['host'];
}

// verifica se existe
$domainMD5=md5($q);
$unix_time=xDiasAtras(2)['unix_time'];
$rank=false;
$domain=false;
if(is_numeric($q)){
	$domain=ramRead($unix_time.'_rank_'.$q);
	if($domain){
		$rank=$q;
	}
}else{
	$rank=ramRead($unix_time.'_domain_'.$domainMD5);
	if($rank){
		$domain=$q;
	}
}
if($domain and $rank){
	$url='/s/'.$domain;
	redirect($url);
}else{
	require '404.php';
}
