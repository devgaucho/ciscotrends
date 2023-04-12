<?php
system('clear');
require './cfg.php';

$langs=explode(',',trim($_ENV['LANGUAGES']));

$converterMoParaJson=function($langs){
	print 'gerando arquivo i18n.json...'.PHP_EOL;
	$translations=[];
	$root=realpath(__DIR__.'/./');
	foreach ($langs as $lang) {
		$str=ecmd($root.'/locale/'.$lang.'/LC_MESSAGES/i18n.mo');
		$cache = new PhpMyAdmin\MoTranslator\Cache\InMemoryCache(new PhpMyAdmin\MoTranslator\MoParser($str));
		$translator = new PhpMyAdmin\MoTranslator\Translator($cache);
		$translations[$lang]=$translator->getTranslations();
		unset($translations[$lang]['']);
	}
	$str=json_encode($translations,JSON_PRETTY_PRINT);
	$filename=ecmd($root.'/locale/i18n.json');
	file_put_contents($filename,$str);
};
$criarTraduções=function($langs){
	system('clear');
	$root=realpath(__DIR__.'/../');
	foreach ($langs as $langCode) {
		$folderStr=ecmd($root.'/locale');
		if (!file_exists($folderStr)) {
			mkdir($folderStr, 0777, true);
		}
		$folderStr=ecmd($root.'/locale/'.$langCode);
		if (!file_exists($folderStr)) {
			mkdir($folderStr, 0777, true);
		}
		$folderStr=ecmd($root.'/locale/'.$langCode.'/LC_MESSAGES');
		if (!file_exists($folderStr)) {
			mkdir($folderStr, 0777, true);
		}
		$filename=ecmd($root.'/locale/pt/LC_MESSAGES/i18n.po');
		$prefixo='criando';
		if(file_exists($filename)){
			$prefixo='atualizando';
		}
		print $prefixo.' tradução para '.$langCode.'...'.PHP_EOL;
		$cmdStr='xgettext --sort-output --omit-header -o ';
		if(file_exists($filename)){
			$cmdStr.='--join-existing ';
		}else{
			print $filename.PHP_EOL;
		}
		$str=ecmd($root.'/locale/'.$langCode.'/LC_MESSAGES/i18n.po');
		$cmdStr.=$str.' ';
		$cmdStr.=ecmd($root.'/view/'.$_ENV['THEME'].'/*.html').' ';
		$cmdStr.=ecmd($root.'/view/'.$_ENV['THEME'].'/*/*.html').' ';
		$cmdStr.=' --from-code="UTF-8" --language=JavaScript';
		system($cmdStr);
		die();
	}
};
$criarTraduções($langs);
$converterMoParaJson();