<?php
$start=require './cfg.php';

system("clear");
$arr=listaDeFuncoesGlobais();
sort($arr);
print_r($arr);
$m=memcached();
$status=dadosDaRam($m);
print $status['curr_items'].' item(s) na ram'.PHP_EOL;
$size=tamanhoBonito($status['bytes']);
$available=tamanhoBonito($status['limit_maxbytes']);
print $size.' bytes de '.$available.' na ram (total)'.PHP_EOL;
print 'o script consumiu '.picoDeMemoria().' de memória'.PHP_EOL;
print 'script executado em ';
print end_time($start).' segundo(s)'.PHP_EOL;