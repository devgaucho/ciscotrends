<?php
function dadosDaRam($m=false){
	if(!$m){
		$m=memcached();
	}
	return $m->getStats()['127.0.0.1:11211'];
}