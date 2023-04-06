<?php
function assetsDoSite(){
	$assets=[
		'style.css',
	];
	return asset($assets,false);
}