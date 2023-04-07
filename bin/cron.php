<?php
system('clear');
$startTimeStr=require './cfg.php';

// pegar o dia anterior
$diaAnteriorArr=xDiasAtras(1);

// ver se o sistema já foi atualizado
$dataDirStr=realpath('./csv');
$csvArquivadoStr=$dataDirStr.'/'.$diaAnteriorArr['unix_time'].'.csv';
if(file_exists($csvArquivadoStr)){
	if($_ENV['MODO_DEBUG']){
		sucesso('atualizando novamente no modo debug');
	}else{
		erroFatal('o sistema já está atualizado');		
	}
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
$csvStr=file_get_contents($csvArquivadoStr);
$m=memcached();
$code=salvarNaRam($diaAnteriorArr['unix_time'],$csvStr,$m);
if($code['ok']){
	sucesso('csv salvo na ram');
}else{
	erroFatal($code['error']);	
}

// fazer o mapa das linhas do csv na ram
$linesArr=mapaDoCsv($csvStr);

// salva o mapa das linhas na ram
$code=salvarNaRam($diaAnteriorArr['unix_time'].'_map',$linesArr,$m);
if($code['ok']){
	sucesso("mapa do csv gerado na ram");
}else{	
	erroFatal($code['error']);
}

// salvar as tuplas rank => domain na ram
// salvar as tuplas domain => rank na ram
// remover da ram o último csv

print PHP_EOL;
$status=dadosDaRam($m);
print $status['curr_items'].' item(s) na ram'.PHP_EOL;
$size=tamanhoBonito($status['bytes']);
$available=tamanhoBonito($status['limit_maxbytes']);
print $size.' bytes de '.$available.' na ram (total)'.PHP_EOL;
print 'o script consumiu '.picoDeMemoria().' de memória'.PHP_EOL;
print 'script executado em ';
print end_time($startTimeStr).' segundo(s)'.PHP_EOL;