<?php
function subOff($input_str,$start_offset_int,$end_offset_int){
	$len_int=$end_offset_int-$start_offset_int;
	return substr($input_str,$start_offset_int,$len_int);
}