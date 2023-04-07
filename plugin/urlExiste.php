<?php
function urlExiste($url){
	$headers = @get_headers($url);
	if(
		!$headers or
		$headers[0] == 'HTTP/1.1 404 Not Found'
	){
		return false;
	}else{
		return true;
	}
}