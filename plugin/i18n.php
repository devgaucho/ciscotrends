<?php
function i18n($data){
    $linguagem=linguagemDoBrowser();
    $i18n=require __DIR__.'/../i18n.php';
    foreach ($data as $key => $value) {
    	$prefix=substr($key,0,1);
    	if(
            $prefix=='_' and
            $key<>'_include' and
            $key<>'_indent'
        ){
            $i18n_key=substr($key,1);
            if(
                isset($i18n[$i18n_key][$linguagem]) and
                !empty($i18n[$i18n_key][$linguagem])
            ){
                $data[$key]=$i18n[$i18n_key][$linguagem];
            }else{
                $data[$key]=$i18n_key;
            }
        }
        if($key=='_include'){
            foreach ($value as $incName => $incData) {
                $data[$key][$incName]=i18n($incData);
            }
        }
    }
    return $data;
}