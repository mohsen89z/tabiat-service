<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        افزودن سفر جدید
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/6/2016
 * Time: 1:18 PM
 */
include_once '../model/Trip.php';
include_once '../util/dbManager.php';

$id = $_POST["id"];
$name = $_POST["name"];
$status = $_POST["status"];
$description = $_POST["description"];
$opr_stat = $_POST["opr_stat"];
$trip_type = $_POST["trip_type"];
$province_id = $_POST["province_id"];
$adminstartor_cmt = $_POST["adminstartor_cmt"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];
$departure_place = $_POST["departure_place"];
$departure_time = $_POST["departure_time_date"] . "%" . $_POST["departure_time_time"];
$attractions = $_POST["attractions"];
$opr_type = $_POST["opr_type"];
$experties_level = $_POST["experties_level"];
$capacity = $_POST["capacity"];
$pric_type = $_POST["pric_type"];
$price = $_POST["price"];
$wage = $_POST["wage"];
$price_decs = $_POST["price_decs"];
$contract_type = $_POST["contract_type"];
$start_order = $_POST["start_order"];
$end_order = $_POST["end_order"];
$invis_cmt = $_POST["invis_cmt"];
$requiremnt_course = $_POST["requiremnt_course"];
$requirment_stuff = $_POST["requirment_stuff"];
$trip_spec = $_POST["trip_spec"];

$trip = new Trip($id, $name, $status ,225,$opr_stat, $trip_type,
    $province_id, $description, $adminstartor_cmt,
    $start_date, $end_date, $departure_place, $departure_time,
    $attractions, $opr_type, $experties_level, $requiremnt_course,
    $requirment_stuff, $capacity, $pric_type, $price, $wage,
    $price_decs, $contract_type, $start_order, $end_order, $invis_cmt , $trip_spec);

//$trip->save();

$sql = "INSERT INTO trip (id, name, status,  is_special, opr_stat, trip_type,
                          province_id, description, adminstartor_cmt,
                          start_date, end_date, departure_place, departure_time,
                          attractions, opr_type, experties_level, requiremnt_course,
                          requirment_stuff, capacity, pric_type, price, wage,
                          price_decs, contract_type, start_order, end_order,
                           invis_cmt , duration , trip_specs
                      )
                      VALUES ('%s', '%s', '%s','%s', '%s', '%s',
                            '%s', '%s', '%s',
                            '%s', '%s', '%s', '%s',
                            '%s', '%s', '%s', '%s',
                            '%s', '%s', '%s', '%s', '%s',
                            '%s', '%s', '%s', '%s',
                             '%s', '%s' , '%s')
                      ON DUPLICATE KEY UPDATE
                          id = '%s', name = '%s', status = '%s', is_special = '%s' ,opr_stat = '%s', trip_type = '%s',
                          province_id = '%s', description = '%s', adminstartor_cmt = '%s',
                          start_date = '%s', end_date = '%s', departure_place = '%s', departure_time = '%s',
                          attractions = '%s', opr_type = '%s', experties_level = '%s', requiremnt_course = '%s',
                          requirment_stuff = '%s', capacity = '%s', pric_type = '%s', price = '%s', wage = '%s',
                          price_decs = '%s', contract_type = '%s', start_order = '%s', end_order = '%s',
                          invis_cmt = '%s', duration = '%s' , trip_specs = '%s'";

$sql = sprintf($sql,
    $trip->id, $trip->name, $trip->status, $trip->is_special ,$trip->opr_stat, $trip->trip_type,
    $trip->province_id, $trip->description, $trip->adminstartor_cmt,
    $trip->start_date, $trip->end_date, $trip->departure_place, $trip->departure_time,
    $trip->attractions, $trip->opr_type, $trip->experties_level, $trip->requiremnt_course,
    $trip->requirment_stuff, $trip->capacity, $trip->pric_type, $trip->price, $trip->wage,
    $trip->price_decs, $trip->contract_type, $trip->start_order, $trip->end_order,
    $trip->invis_cmt, $trip->duration, json_encode($trip_spec),
    $trip->id, $trip->name, $trip->status, $trip->is_special , $trip->opr_stat, $trip->trip_type,
    $trip->province_id, $trip->description, $trip->adminstartor_cmt,
    $trip->start_date, $trip->end_date, $trip->departure_place, $trip->departure_time,
    $trip->attractions, $trip->opr_type, $trip->experties_level, $trip->requiremnt_course,
    $trip->requirment_stuff, $trip->capacity, $trip->pric_type, $trip->price, $trip->wage,
    $trip->price_decs, $trip->contract_type, $trip->start_order, $trip->end_order,
    $trip->invis_cmt , $trip->duration, json_encode($trip_spec));

//echo $sql;
//echo "<br>";
logTabiat("before query: $sql");
$test = runQuery($sql);

logTabiat("after query $test");

echo "<h2>" . "سفر با موفقیت ثبت شد!" . "</h2>";

header("Location: ./additional_trip.php?id=".$test);

?>


</body>
</html>
