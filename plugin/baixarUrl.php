<?php
function baixarUrl($url){
    $ua='Mozilla/5.0 (X11; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/111.0';
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
    curl_setopt($ch,CURLOPT_TIMEOUT,1000);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_USERAGENT,$ua); 
    $result=curl_exec($ch);
    if($result){
        return $result;
    }else{
        return false;
    }
    curl_close($ch);
}
