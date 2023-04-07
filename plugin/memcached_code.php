<?php
function memcached_code($m=false){
	$code=$m->getResultCode();
	switch($code){
		case '00':
		$error='MEMCACHED_SUCCESS';
		break;
		case '01':
		$error='MEMCACHED_FAILURE';
		break;
		case '02':
		case '04':	
		$error='MEMCACHED_HOST_LOOKUP_FAILURE';
		break;
		case '03':
		$error='MEMCACHED_CONNECTION_FAILURE';
		break;
		case '05':
		$error='MEMCACHED_WRITE_FAILURE';
		break;
		case '06':
		$error='MEMCACHED_READ_FAILURE';
		break;
		case '07':
		$error='MEMCACHED_UNKNOWN_READ_FAILURE';
		break;
		case '08':
		$error='MEMCACHED_PROTOCOL_ERROR';
		break;
		case '09':
		$error='MEMCACHED_CLIENT_ERROR';
		break;
		case '10':
		$error='MEMCACHED_SERVER_ERROR';
		break;
		case '11':
		$error='MEMCACHED_ERROR';
		break;
		case '12':
		$error='MEMCACHED_DATA_EXISTS';
		break;
		case '13':
		$error='MEMCACHED_DATA_DOES_NOT_EXIST';
		break;
		case '14':
		$error='MEMCACHED_NOTSTORED';
		break;
		case '15':
		$error='MEMCACHED_STORED';
		break;
		case '16':
		$error='MEMCACHED_NOTFOUND';
		break;
		case '17':
		$error='MEMCACHED_MEMORY_ALLOCATION_FAILURE';
		break;
		case '18':
		$error='MEMCACHED_PARTIAL_READ';
		break;
		case '19':
		$error='MEMCACHED_SOME_ERRORS';
		break;
		case '20':
		$error='MEMCACHED_NO_SERVERS';
		break;
		case '21':
		$error='MEMCACHED_END';
		break;
		case '22':
		$error='MEMCACHED_DELETED';
		break;
		case '23':
		$error='MEMCACHED_VALUE';
		break;
		case '24':
		$error='MEMCACHED_STAT';
		break;
		case '25':
		$error='MEMCACHED_ITEM';
		break;
		case '26':
		$error='MEMCACHED_ERRNO';
		break;
		case '27':
		$error='MEMCACHED_FAIL_UNIX_SOCKET';
		break;
		case '28':
		$error='MEMCACHED_NOT_SUPPORTED';
		break;
		case '30':
		$error='MEMCACHED_FETCH_NOTFINISHED';
		break;
		case '31':
		$error='MEMCACHED_TIMEOUT';
		break;
		case '32':
		$error='MEMCACHED_BUFFERED';
		break;
		case '29':	
		case '33':
		$error='MEMCACHED_BAD_KEY_PROVIDED';
		break;
		case '34':
		$error='MEMCACHED_INVALID_HOST_PROTOCOL';
		break;
		case '35':
		$error='MEMCACHED_SERVER_MARKED_DEAD';
		break;
		case '36':
		$error='MEMCACHED_UNKNOWN_STAT_KEY';
		break;
		case '37':
		$error='MEMCACHED_E2BIG';
		break;
		case '38':
		$error='MEMCACHED_INVALID_ARGUMENTS';
		break;
		case '39':
		$error='MEMCACHED_KEY_TOO_BIG';
		break;
		case '40':
		$error='MEMCACHED_AUTH_PROBLEM';
		break;
		case '41':
		$error='MEMCACHED_AUTH_FAILURE';
		break;
		case '42':
		$error='MEMCACHED_AUTH_CONTINUE';
		break;
		case '43':
		$error='MEMCACHED_PARSE_ERROR';
		break;
		case '44':
		$error='MEMCACHED_PARSE_USER_ERROR';
		break;
		case '45':
		$error='MEMCACHED_DEPRECATED';
		break;
		case '46':
		$error='MEMCACHED_IN_PROGRESS';
		break;
		case '47':
		$error='MEMCACHED_SERVER_TEMPORARILY_DISABLED';
		break;
		case '48':
		$error='MEMCACHED_SERVER_MEMORY_ALLOCATION_FAILURE';
		break;
		case '49':
		$error='MEMCACHED_MAXIMUM_RETURN';
		break;
		default:
		$error=false;
		break;
	}
	$ok=false;
	if($code=='00'){
		$ok=true;
	}
	return [
		'ok'=>$ok,
		'error'=>$error
	];
}