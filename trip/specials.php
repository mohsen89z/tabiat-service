<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 7/29/2016
 * Time: 12:08 PM
 */
include_once '../model/Special.php';

$specials = Special::getAll();

print_r(json_encode($specials));

?>