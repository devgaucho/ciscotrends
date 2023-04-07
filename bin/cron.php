<?php
system('clear');
require './cfg.php';

// pegar o dia anterior
$diaAnteriorArr=xDiasAtras(1);

// ver se o sistema já foi atualizado
$dataDirStr=realpath('./data');
$csvArquivadoStr=$dataDirStr.'/'.$diaAnteriorArr['unix_time'].'.csv';
if(file_exists($csvArquivadoStr)){
	erroFatal('o sistema já está atualizado');
}else{
	sucesso('inciando atualização');
}

// gerar a url para baixar o último csv disponível
$urlStr=gerarUrlDaCisco($diaAnteriorArr['csv']);

// verificar se o zip já está disponível pra download
if(urlExiste($urlStr)){
	sucesso('baixando o novo csv');
}else{	
	erroFatal('o novo csv ainda não está disponível');
}

// baixar o último zip com o csv
$zipStr=baixarUrl($urlStr);
if($zipStr){
	sucesso('novo csv baixado com sucesso!');
}else{	
	erroFatal('erro ao baixar o zip com o csv');
}

// salva o último csv em um arquivo remporário
$nomeDoArquivoTemporarioStr=criarArquivoTemporario($zipStr);

// extrair o último csv, renomear e salvar no disco
extrairZip($nomeDoArquivoTemporarioStr);
sucesso('novo csv extraído com sucesso!');
$csvFilenameStr=sys_get_temp_dir().'/top-1m.csv';

// mover o csv
if(rename($csvFilenameStr,$csvArquivadoStr)){
	sucesso('arquivo csv arquivado com sucesso!');
}else{
	erroFatal('erro ao salvar o csv');
}

// ler e salvar o csv na ram
// fazer o mapa das linhas do csv
// salvar as tuplas rank => domain na ram
// salvar as tuplas domain => rank na ram
// remover da ram o último csv