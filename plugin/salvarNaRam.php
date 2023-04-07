<?php
function salvarNaRam($key,$mixed=null,$m=false,$ttl=null){
	if(!is_int($ttl)){
		$diaEmSegundos=24*60*60;
		$ttl=$diaEmSegundos*2;//salva por 2 dias
	}
	if(!$m){
		$m=memcached();
	}
	if(is_array($key)){
		foreach ($key as $key_m => $value_m) {
			$m->set($key_m,$value_m,$ttl);
		}
	}else{
		$m->set($key,$mixed,$ttl);
	}
	return memcached_code($m);
}
