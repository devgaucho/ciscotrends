<?php
function xDiasAtras($x){
    $time=time();
    $dia=(60*60*24);
    $curr_time=$time-($dia*$x);
    $data=[];
    date_default_timezone_set('GMT0');
    //https://www.php.net/manual/en/datetimeimmutable.createfromformat.php
    $data['csv']=date('Y-m-d', $curr_time);
    $data['Y']=date('Y', $curr_time);
    $data['m']=date('m', $curr_time);
    $data['d']=date('d', $curr_time);
    $data['D']=date('D', $curr_time);
    $data['M']=date('M', $curr_time);
    $data['GMT']=$data['D'].', '.$data['d'].' '.$data['M'].' '.$data['Y'].' 00:00:00 +0000';
    $parsed = date_parse($data['GMT']);
    $unix = mktime(
        $parsed['hour'],
        $parsed['minute'],
        $parsed['second'],
        $parsed['month'],
        $parsed['day'],
        $parsed['year']
    );
    $data['unix_time']=$unix;
    return $data;
}
