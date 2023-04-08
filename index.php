<?php
require 'cfg.php';

get('/',function(){
	require 'controller/home.php';
});

get('/s/{domain}',function($domain){
	require 'controller/domain.php';
});

get('/404',function(){
	require 'controller/404.php';
});