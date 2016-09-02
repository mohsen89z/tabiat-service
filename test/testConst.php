<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 8/17/2016
 * Time: 1:18 PM
 */
$raw = file_get_contents('/tabiat-service/service/trips.php?method=normal');
$normals = json_decode($raw);
echo $normals;
echo '<br />';
echo count($normals)
?>