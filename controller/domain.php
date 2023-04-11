<?php
$unix_time=xDiasAtras(2)['unix_time'];
$m=memcached();
$domainMD5=md5($domain);
$rank=ramRead($unix_time.'_domain_'.$domainMD5,$m);
if(!$rank){
	require '404.php';
}
$trend=upAndDown($domain,$m);
$data=[
	'domain'=>$domain,
	'hits'=>123,
	'_include'=>[
		'inc/head'=>[
			'_indent'=>2,
			'headerAssets'=>assetsDoSite('header'),
			'title'=>$domain.' | '.$_ENV['SITE_NAME']
		],		
		'inc/top'=>['_indent'=>5],
		'inc/footer'=>[
			'footerAssets'=>assetsDoSite('footer')
		],
	],
	'language'=>linguagemDoSite(),
	'rank'=>$rank,
	'trend'=>$trend
];
mustache('domain',$data);