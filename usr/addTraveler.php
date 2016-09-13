<!DOCTYPE html>
<html lang="en">
<head>
    <title>لیست کاربران</title>
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

ob_start();
session_start();


if ($_SESSION["valid"] != true) {

    echo 'شما دسترسی به این صفحه ندارید';

    header('Refresh: 2; URL = ../util/login.php');
    die();
}

include_once "../model/User.php";
include_once "../model/Trip.php";
include_once "../model/UserGroups.php";
include_once "../model/UserInfo.php";
include_once "../model/Travelers.php";

$user_id = $_GET["user_id"];
$trip_id = $_GET["trip_id"];
$user = User::loadById($user_id);
$userInfo = UserInfo::loadById($user_id);
$trip = Trip::loadById($trip_id);

if (!empty($_POST["traveler_name"]) && !empty($_POST["traveler_family"]) && !empty($_POST["national_code"])) {
    Travelers::addTraveler($_POST["national_code"], $_POST["traveler_name"], $_POST["traveler_family"], $trip->id, $user->id);
}
if (!empty($_GET["traveler_id"])) {
    Travelers::delete($_GET["traveler_id"]);
}
$travelers = Travelers::loadByUserIdAndTripId($user_id, $trip_id);

?>
<div class="container-fluid">

    <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="../usr/profile.php">طبیعت</a>
    </div>
    <ul class="nav navbar-nav">

        <?php
        if ($_SESSION['user_group'] == 1) {
            ?>
            <li><a href="../trip/addTrip.php">اضافه کردن سفر</a></li>
            <li><a href="../usr/addUser.php">اضافه کردن کاربر</a></li>
            <?php
        }
        ?>
        <li><a href="../usr/myTrips.php"> لیست سفرهای من </a></li>
        <li><a href="../trip/allTrips.php"> لیست تمام سفرها </a></li>
        <li><a href="../trip/specials.php"> لیست سفرهای ویژه </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-left">
        <li><a href="../security/logout.php"> خروج</a></li>
    </ul>
</div>

<div class="container">
    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="ProcessingStep" value="add">

        <div class="form-group">
            <label class="control-label col-sm-2" for="id">
                نام
            </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="Cuser" id="Cuser" readonly="readonly"
                       value="<?php echo $userInfo->name . ' ' . $userInfo->surename; ?>" placeholder="نام">
            </div>
            <label class="control-label col-sm-2" for="title">
                عنوان سفر
            </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="title" id="title" readonly="readonly"
                       value="<?php echo $trip->name; ?>" placeholder="شماره سفر">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="uname">
                نام
            </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="traveler_name" id="traveler_name"
                       placeholder="نام">
            </div>

            <label class="control-label col-sm-2" for="name">
                نام خانوادگی
            </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="traveler_family" id="traveler_family"
                       placeholder="نام خانوادگی">
            </div>


            <label class="control-label col-sm-2" for="name">
                شماره ملی
            </label>
            <div class="col-sm-4">
                <input type="number" class="form-control" name="national_code" id="national_code"
                       placeholder="شماره ملی">
            </div>
            <div class="col-sm-2">
                <input type="submit" class="btn btn-success" value="اضافه کردن"/>
            </div>

        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>شماره ملی</th>
                <th>حذف</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $count = 0;
            foreach ($travelers as $traveler) {
                if ($count % 2)
                    $class = "class='info'";
                else
                    $class = "class='warning'";
                $count++;
                echo "<tr " . $class . " >";
                echo "    <td>";
                echo $traveler->name;
                echo "    </td><td>";
                echo $traveler->family;
                echo "    </td><td>";
                echo $traveler->nationalCode;
                echo "    </td><td>";
                echo "        <a href='./addTraveler.php?traveler_id=" . $traveler->id . "&trip_id=" . $trip_id . "&user_id=" . $user_id . "' class='btn btn-default btn-sm'>";
                echo "            <span class='glyphicon glyphicon-edit'></span> حذف همسفر";
                echo "        </a>";
                echo "    </td>";
                echo "<tr />";
            }
            ?>
            </tbody>
        </table>

        <br/>

        <a href="addUser.php" class="btn btn-success" role="button">
            افزودن کاربر جدید
        </a>
    </form>
</div>

</body>
</html>