<?php
function baixarDiasAtras($diasAtras,$m){
	print 'baixando dados de '.$diasAtras.' dias atrás'.PHP_EOL;

	// pegar o dia anterior
	$diaAnteriorArr=xDiasAtras($diasAtras);
	$unixInt=$diaAnteriorArr['unix_time'];

	$domain=ramRead($unixInt.'_rank_1');
	if($domain){
		sucesso('esse dia já está na memória');
		return true;
	}

	// ver se o sistema já foi atualizado
	$dataDirStr=realpath('./csv');
	$csvArquivadoStr=$dataDirStr.'/'.$unixInt.'.csv';
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
	sucesso($urlStr);

	// verificar se o zip já está disponível pra download
	if(urlExiste($urlStr)){
		sucesso('baixando o novo csv');
	}else{	
		sucesso('o novo csv ainda não está disponível');
		return true;
	}

	// baixar o último zip com o csv
	if(!file_exists($csvArquivadoStr)){
		$zipStr=baixarUrl($urlStr);
		if($zipStr){
			sucesso('novo csv baixado com sucesso!');
		}else{	
			erroFatal('erro ao baixar o zip com o csv');
		}
	}

	if(!file_exists($csvArquivadoStr)){
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
	}

	// ler e salvar o csv na ram
	$csvStr=file_get_contents($csvArquivadoStr);
	$code=ramCreate($unixInt,$csvStr,$m);
	if($code['ok']){
		sucesso('csv salvo na ram');
	}else{
		$msg='erro ao salvar o csv na ram '.$code['error'];
		erroFatal($msg);	
	}

	// fazer o mapa das linhas do csv na ram
	sucesso('gerando mapa do csv na ram');
	$linesArr=mapaDoCsv($csvStr);

	// salva o mapa das linhas na ram
	$code=ramCreate($unixInt.'_map',$linesArr,$m);
	if($code['ok']){
		sucesso("mapa do csv gerado na ram");
	}else{	
		$msg='erro ao salvar o mapa do csv na ram '.$code['error'];
		erroFatal($msg);
	}

	// ler o csv na ram
	$rankArr=null;
	$domainArr=null;
	foreach ($linesArr as $rankInt => $value) {
		$data=subOff(
			$csvStr,$value['start_offset'],
			$value['end_offset']
		);
		$domainStr=trim(csvExplode($data)[1]);
		$rankArr[$unixInt.'_rank_'.$rankInt]=$domainStr;
		$domainArr[$unixInt.'_domain_'.md5($domainStr)]=$rankInt;
	}
	sucesso('salvando sites individualmente na ram');

	// salvar as tuplas rank => domain na ram
	$code=ramCreate($rankArr,null,$m);
	if($code['ok']){
		sucesso('rank => domain na ram ('.count($rankArr).' registros)');
	}else{	
		$msg='erro ao salvar o rank => domain na ram '.$code['error'];
		die($msg);
	}

	// salvar as tuplas domain => rank na ram
	$code=ramCreate($domainArr,null,$m);
	if($code['ok']){
		$msg='domain => rank na ram ('.count($domainArr).' registros)';
		sucesso($msg);
	}else{	
		$msg='erro ao salvar o domain => rank na ram '.$code['error'];
		die($msg);
	}

	// remover da ram o último csv e o mapa dele
	$code=ramDelete($unixInt);
	if($code['ok']){
		sucesso('csv removido da ram');
	}else{	
		die('erro ao remoder o csv da ram');
	}
	$code=ramDelete($unixInt.'_map');
	if($code['ok']){
		sucesso('mapa do csv removido da ram');
	}else{	
		die('erro ao remoder o mapa do csv da ram');
	}
}