<?php
$unix_time=xDiasAtras(1)['unix_time'];
$rank=ramRead($unix_time.'_domain_'.$domain);
if(!$rank){
	require '404.php';
}
$data=[
	'assets'=>assetsDoSite(),
	'domain'=>$domain,
	'hits'=>123,
	'_include'=>[
		'inc/top'=>['_indent'=>5]
	],
	'language'=>linguagemDoSite(),
	'rank'=>$rank,
	'title'=>$domain
];
mustache('site',$data);