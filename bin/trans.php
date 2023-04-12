<?php
require './cfg.php';

system("clear");

print 'iniciando tradução...'.PHP_EOL;

// criar uma lista com todas as views a serem traduzidas
$rootStr=realpath(__DIR__.'/../');
$viewPathStr=$rootStr.'/view/'.$_ENV['THEME'];
$viewsArr=array_merge(
	glob($viewPathStr.'/*.html'),
	glob($viewPathStr.'/*/*.html')
);

// pegar a lista de lingaugens
$languagesArr=explode(',',trim($_ENV['LANGUAGES']));

// extrair as strings de tradução das views
foreach ($languagesArr as $languageStr) {
	foreach ($viewsArr as $viewStr) {
		$cmdStr='xgettext -o "';
		$folderStr=$rootStr.'/locale/'.$languageStr;
		$folderStr.='/LC_MESSAGES/';
		if(!file_exists($folderStr)){
			mkdir($folderStr, 0755, true);
		}
		$cmdStr.=$folderStr.'i18n.po" "';
		$cmdStr.=$viewStr.'" ';
		$cmdStr.='--from-code="UTF-8" --language=JavaScript';
		$cmdStr.=' 2>&1';// STDERR to STDOUT 
		@exec($cmdStr, $outputAndErrors, $return_value);
	}
	print '✔️ .po gerado para '.$languageStr.PHP_EOL;
}

print 'tradução concluída'.PHP_EOL;