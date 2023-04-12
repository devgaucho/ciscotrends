<?php
function linguagemDoBrowser($raw=false){
	$str=@$_SERVER["HTTP_ACCEPT_LANGUAGE"];
	$str=@strtolower(substr($str,0,2));
	$linguagensSuportadas=explode(',',trim($_ENV['LANGUAGES']));
	if(in_array($str,$linguagensSuportadas)){
		return $str;
	}else{
		if($raw){
			return $str;
		}else{
			return 'en';
		}
	}
}