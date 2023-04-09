<?php
function assetsDoSite(){
	$assets=[
		'css/style.css',
		'js/jquery.jscroll.js',
		'js/main.js'
	];
	return asset($assets,false);
}