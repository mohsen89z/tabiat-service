<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/6/2016
 * Time: 11:01 AM
 */


function logTabiat($msg)
{
//    error_log($msg . "\n", 3, "./tabiat.log");
    error_log($msg . "\n", 3, "/var/log/nginx/tabiat.log");
}

?>