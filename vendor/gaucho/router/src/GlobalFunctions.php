<?php

use gaucho\Env;
use gaucho\Router;

// carregar plugins no escopo global
$plugins_path_str=__DIR__.'/../../../../plugin';
if(file_exists($plugins_path_str)){
	foreach (glob($plugins_path_str.'/*.php') as $filename){
    		require_once $filename;
	}
}

// caregar o .env
new Env();

// exibir erros
show_errors();

function asset($urls,$print=true,$autoIndent=true){
    if(is_string($urls)){
        $arr[]=$urls;
        $urls=$arr;
    }
    foreach($urls as $key=>$url){
	if(isset($_ENV['THEME'])){
		$url='view/'.$_ENV['THEME'].'/'.$url;
	}
        $filename=__DIR__.'/../../../../'.$url;
        $path_parts=pathinfo($url);
        $ext=$path_parts['extension'];
	$out=null;
        if(file_exists($filename)){
            $md5=md5_file($filename);
            if(isset($_ENV['SITE_URL'])){
                $url=$_ENV['SITE_URL'].'/'.$url."?$md5";
            }else{
                $url=$url."?$md5";
            }
            if($autoIndent and $key<>0){
                $out.='    ';
            }
            if($ext=='css'){
                $out.='<link rel="stylesheet" href="'.$url.'" />';
            }
            if($ext=='js'){
                $out.='<script type="text/javascript" src="';
                $out.=$url.'"></script>';
            }
            $out.=PHP_EOL;
        }
	$out=trim($out);
	if($print){
		print $out;
	}else{
		return $out;
	}
    }
}
function code($httpCode){
	http_response_code($httpCode);
}
function delete(...$params){
    Router::delete(...$params);
}
function dispatch(){
	if(!isCli()){
		Router::dispatch();
  	}
}
function end_time($start_str){
    $end_str=microtime(1);
    if(!function_exists('bcdiv')){
        die("sudo apt install php-bcmath -y && sudo systemctl restart apache2");
    }
    return bcsub($end_str,$start_str,3);//tempo em segundos
}
function get(...$params){
    Router::get(...$params);
}
function headMethod(...$params){
    Router::head(...$params);
}
function isCli(){
	if (php_sapi_name() == "cli") {
		return true;
	} else {
		return false;
	}
}
function json($data,$print=true){
	$str=json_encode($data,JSON_PRETTY_PRINT);
	if($print){
       header('Content-Type: application/json');
       die($str);
   }else{
      return $str;
  }
}
function mustache($templateName,$data=[],$print=true){
	if(isset($_ENV['SITE_NAME'])){
		$data['SITE_NAME']=$_ENV['SITE_NAME'];
	}
	if(isset($_ENV['SITE_URL'])){
		$data['SITE_URL']=$_ENV['SITE_URL'];
	}
	if(isset($data['_indent'])){
		$indent=$data['_indent'];
	}else{
		$indent=false;
	}
	if(isset($_ENV['THEME'])){
		$str=__DIR__.'/../../../../view/'.$_ENV['THEME'].'/'.$templateName.'.html';
	}else{
		$str=__DIR__.'/../../../../view/'.$templateName.'.html';
	}
	$str=realpath($str);
	if(file_exists($str)){
		$obj=new Mustache_Engine(['entity_flags'=>ENT_QUOTES]);	
		//adicionar as includes como variáveis
		if(isset($data['_include'])){
			foreach($data['_include'] as $includeName=>$includeData){
				$data[$includeName]=mustache($includeName,$includeData,false);
			}
		}
		$str=file_get_contents($str);
		if($indent){
			$i=1;
			$tab=null;
			while($i++<=$indent){
				$tab.=chr(9);
			}
			$arr=explode(PHP_EOL,$str);
			foreach($arr as $key=>$value){
				if($key<>0){
					$arr[$key]=$tab.$value;
				}
			}
			$str=implode(PHP_EOL,$arr);
		}
		$str=$obj->render($str,$data);
		if($print){
			print $str;
		}else{
			return $str;
		}	
	}else{
		die('template <b>'.$templateName.'</b> not found');
	}
}
function options(...$params){
    Router::options(...$params);
}
function patch(...$params){
    Router::patch(...$params);
}
function post(...$params){
    Router::post(...$params);
}
function put(...$params){
    Router::put(...$params);
}
function segment($segmentId=null){
    $str=$_SERVER["REQUEST_URI"];
    $str=@explode('?', $str)[0];
    $arr=explode('/', $str);
    $arr=array_filter($arr);
    $arr=array_values($arr);
    if(count($arr)<1){
        $segment[1]='/';
    }else{
        $i=1;
        foreach ($arr as $key => $value) {
            $segment[$i++]=$value;
        }
    }
    if(is_null($segmentId)){
        return $segment;
    }else{
        if(isset($segment[$segmentId])){
            return $segment[$segmentId];
        }else{
            return false;
        }
    }
}	
function show_errors($display_errors=true){
    if(isset($_ENV['DISPLAY_ERRORS'])){
        $display_errors=$_ENV['DISPLAY_ERRORS'];
    }
    if($display_errors){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }else{
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(0);
    }
}
function start_time(){
    return microtime(1);
}
function view($name,$data='',$print=true){
	return mustache($name,$data,$print);
}
register_shutdown_function('dispatch');
