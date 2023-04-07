<?php
function gerarUrlDaCisco($dataStr){
    $url='https://s3-us-west-1.amazonaws.com/';
    $url.='umbrella-static/top-1m-'.$dataStr.'.csv.zip';
    return $url;
}