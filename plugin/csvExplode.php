<?php
function csvExplode($line_str){
	$separador_str=',';
	$regex_str='/'.$separador_str.'(?=(?:[^\"])*(?![^\"]))/';
	$flag_str=PREG_SPLIT_DELIM_CAPTURE;
	return preg_split($regex_str,$line_str,-1,$flag_str);
}