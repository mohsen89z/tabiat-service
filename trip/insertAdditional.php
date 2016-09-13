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

    <style>
        body {
            background: #76b852;
            background: -webkit-linear-gradient(right, #76b852, #8DC26F);
            background: -moz-linear-gradient(right, #76b852, #8DC26F);
            background: -o-linear-gradient(right, #76b852, #8DC26F);
            background: linear-gradient(to left, #76b852, #8DC26F);
        }

        .container {
            background: #FFFFFF;
            margin-top: 100px;
            margin-bottom: 100px;
            border-radius: 5px;
        }
    </style>

</head>
<body>
<?php
include_once '../model/AdditionalTrip.php';
include_once '../util/dbManager.php';

ob_start();
session_start();

$car = $_POST["trip_vec"];
$necessary_tools = $_POST["trip_nes"];
$car_details = $_POST["car_cmt"];
$trip_cat = $_POST["trip_cat"];
$trip_id = $_POST["trip_id"];
$breakfast_provider = $_POST["bfood_prov"];
$breakfast_location = $_POST["bdine_loc"];
$lunch_provider = $_POST["lfood_prov"];
$lunch_location = $_POST["ldine_loc"];
$dinner_provider = $_POST["dfood_prov"];
$dinner_location = $_POST["ddine_loc"];

$trip = new AdditionalTrip($car,
    $necessary_tools,
    $car_details,
    $trip_cat,
    $trip_id,
    $breakfast_provider,
    $breakfast_location,
    $lunch_provider,
    $lunch_location,
    $dinner_provider,
    $dinner_location);

$trip->save();

echo "<h2>" . "سفر با موفقیت ثبت شد!" . "</h2>";

?>

<br>
<a href="addTrip.php" class="btn btn-success" role="button">
    بازگشت
</a>
<a href="./allTrips.php" class="btn btn-success" role="button">
    بازگشت به لیست سفر ها
</a>

</body>
</html>
