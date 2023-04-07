<?php
// retorna um array com o offset inicial da linha e o tamanho dela
function mapaDoCsv($str){
	$i=0;
	$str_length_int=strlen($str);
	if(bin2hex(substr($str, -1))<>'0a'){
		$str=$str.PHP_EOL;	
	}
	$arr=[];
	$start_offset_int=$i;
	$end_offset_int=null;
	$line_number_int=1;
	while($i<=$str_length_int){
		$hex_str=bin2hex(substr($str,$i,1));
		if($hex_str=='0a'){
			$key=$i+1;
			$end_offset_int=$i;
			$arr[$line_number_int]=[
				'start_offset'=>$start_offset_int,
				'end_offset'=>$end_offset_int
			];			
			$start_offset_int=$end_offset_int+1;
			$line_number_int++;			
		}else{
			$end_offset_int=$str_length_int;
		}
		$i++;
	}
	return $arr;
}