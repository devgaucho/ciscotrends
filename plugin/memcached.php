<?php
use \Memcached;
function memcached(){
	$m=new Memcached();	
	$m->addServer('127.0.0.1',11211);
	return $m;
}