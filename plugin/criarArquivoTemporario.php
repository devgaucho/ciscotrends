<?php
function criarArquivoTemporario($data){
	$filename=tempnam("/tmp","FOO");
	file_put_contents($filename,$data);
	return $filename;
}