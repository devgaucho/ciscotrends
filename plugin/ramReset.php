<?php
function ramReset($m=false){
	if(!$m){
		$m=memcached();
	}
	$m->flush();
	return memcachedCode($m);
}