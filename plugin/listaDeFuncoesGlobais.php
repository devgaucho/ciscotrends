<?php
function listaDeFuncoesGlobais(){
	$arr=get_defined_functions();
	return @$arr['user'];
}