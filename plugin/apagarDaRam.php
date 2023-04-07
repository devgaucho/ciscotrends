<?php
function apagarDaRam($key,$m=false){
	if(!$m){
		$m=memcached();
	}
	$m->delete($key);
	return memcachedCode($m);
}
