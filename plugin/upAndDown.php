<?php
function upAndDown($domain,$m){
	$domainMD5=md5($domain);
	$unix2d=xDiasAtras(2)['unix_time'];
	$rank2d=ramRead($unix2d.'_domain_'.$domainMD5,$m);
	$unix3d=xDiasAtras(3)['unix_time'];
	$rank3d=ramRead($unix3d.'_domain_'.$domainMD5,$m);
	if(!empty($rank3d)){
		$trend=($rank2d-$rank3d);
		if($trend>0){
			$class='badge rounded-pill text-bg-success';
			return '<strong class="'.$class.'">+'.$trend.'</strong>';
		}
		if($trend<0){
			$class='badge rounded-pill text-bg-danger';
			return '<strong class="'.$class.'">'.$trend.'</strong>';
		}
	}
	return null;
}