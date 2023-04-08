<?php
function ramRead($key,$m=false,$return_code=false){
	if(!$m){
		$m=memcached();
	}
	$value=$m->get($key);
	if($return_code){
		$code=memcachedCode($m);
		return [
			'value'=>$value,
			'code'=>$code
		];
	}else{
		return $value;
	}
}
