<?php
require 'vendor/autoload.php';
// https://www.php.net/manual/en/timezones.php
date_default_timezone_set($_ENV['TIMEZONE']);
return start_time();