<?php
if(!file_exists('.env')){
	die('cd "'.__DIR__.'" && cp .env.example .env && nano .env');
}
require 'vendor/autoload.php';
// https://www.php.net/manual/en/timezones.php
date_default_timezone_set($_ENV['TIMEZONE']);
return start_time();