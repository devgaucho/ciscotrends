<?php

namespace gaucho;

class Env
{
    public function __construct($env_filename_str=null)
    {
        if (is_null($env_filename_str)) {
            $dir_arr=explode('/', __DIR__);
            $dir_arr=array_slice($dir_arr, 0, -4);
            $dir_str=implode('/', $dir_arr);
            $env_filename_str=$dir_str.'/.env';
        }
        if (!file_exists($env_filename_str)) {
            die($env_filename_str.' not found'.PHP_EOL);
        }
        $contents_str=file_get_contents($env_filename_str);
        $contents_arr=explode(PHP_EOL, $contents_str);
        foreach ($contents_arr as $value_str) {
            $value_str=trim($value_str);
            $value_arr=null;
            $first_char=substr($value_str, 0, 1);
            if (
                !empty($value_str) and
                $first_char<>'#'
            ) {
                $value_arr=explode('=', $value_str);
            }
            if (
                !empty($value_arr) and
                is_array($value_arr)
            ) {
                $key_str=$value_arr[0];
                unset($value_arr[0]);
                $_ENV[$key_str]=implode('=', $value_arr);
            }
        }
    }
}
