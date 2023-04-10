<?php
system('clear');
$startTimeStr=require './cfg.php';
//http://s3-us-west-1.amazonaws.com/umbrella-static/index.html
$m=memcached();
$start=1;
$end=$_ENV['NUMBER_OF_DAYS_IN_RAM'];
while($start<=$end){
	baixarDiasAtras($start,$m);
	$start=$start+1;
	print PHP_EOL;
}
$status=dadosDaRam($m);
print $status['curr_items'].' item(s) na ram'.PHP_EOL;
$size=tamanhoBonito($status['bytes']);
$available=tamanhoBonito($status['limit_maxbytes']);
print $size.' bytes de '.$available.' na ram (total)'.PHP_EOL;
print 'o script consumiu '.picoDeMemoria().' de memória'.PHP_EOL;
print 'script executado em ';
print end_time($startTimeStr).' segundo(s)'.PHP_EOL;