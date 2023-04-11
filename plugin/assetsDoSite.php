<?php
function assetsDoSite($section){
	if($section=='header'){
		$assets=[
			'css/style.css'
		];
	}else{
		$assets=[
			'js/jquery.jscroll.js',
			'js/ProBar.js',
			'js/main.js'
		];
	}
	return asset($assets,false);
}