<?php
function extrairZip($filename,$outDir=false){
	if (!class_exists('ZipArchive')) {
		$msg='você precisa instalar a extensão zip no php:'.PHP_EOL;
		$msg.='sudo apt install php-zip -y &&';
		$msg.=' sudo /etc/init.d/apache2 restart';
		erroFatal($msg);
	}
	$zip = new ZipArchive;
	if(!$zip->open($filename)){
		erroFatal('erro ao abrir o '.$filename.'para extração');
	}
	if(!$outDir){
		$outDir=sys_get_temp_dir();
	}
	if($zip->extractTo($outDir)){
		$zip->close();
		return true;
	}else{
		erroFatal('erro ao extrair');
	}	
}
