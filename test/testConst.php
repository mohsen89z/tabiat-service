<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 8/17/2016
 * Time: 1:18 PM
 */
//$raw = file_get_contents('/tabiat-service/service/trips.php?method=normal');
//$normals = json_decode($raw);
//echo $normals;
//echo '<br />';
//echo count($normals)
//

echo "before ts 01/07/1395 and 03/07/1395";
//$ts1 = date('d/m/y', strtotime('01/07/1395'));//date_parse_from_format('d/M/Y', '01/07/1395');//new DateTime('01-07-1395');
$pieces = explode("/", '01/07/1395');
echo "salaam";
$ts1 = $pieces[1]."/".$pieces[0]."/".$pieces[2];
//$ts2 = date('d/m/y', strtotime('03/07/1395'));//date_parse_from_format('d/M/Y', '03/07/1395');
//$ts2 = str_replace('/', '-', $ts2);
//$ts2 =  date("m-d-Y", strtotime($ts2) );
$pieces = explode("/", '03/07/1395');
echo $pieces[0];
$ts2 = $pieces[1]."/".$pieces[0]."/".$pieces[2];
echo $ts2;
$ts1 = strtotime($ts1);
$ts2 = strtotime($ts2);
echo "after ts".$ts1 ."   " .$ts2;
$duration = ($ts2 - $ts1) /3600 /24;    //$ts2->diff($ts1)->days;
echo "after this";
echo $duration;
