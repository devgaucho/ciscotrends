<?php
code(404);
$data=[
	'_include'=>[
		'inc/head'=>[
			'_indent'=>2,
			'headerAssets'=>assetsDoSite('header'),
			'title'=>'Erro'
		],
		'inc/top'=>['_indent'=>5],
		'inc/footer'=>[
			'footerAssets'=>assetsDoSite('footer')
		],		
	],
	'language'=>linguagemDoSite()
];
mustache('404',$data);
die();