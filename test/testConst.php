<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 8/17/2016
 * Time: 1:18 PM
 */

$raw = file_get_contents('http://91.109.17.87/tabiat-service/service/trips.php?method=normal');
$normals = json_decode($raw);
echo $normals[0]->trip_spec;
echo '<br />';
foreach($normals[0]->trip_spec as $spec){
    echo $spec;
    echo '<br />';
}
echo '<br />';
echo count($normals)
?>