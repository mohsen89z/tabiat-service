<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        اضافه کردن افراد به سفر
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
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 8/1/2016
 * Time: 4:12 PM
 */

ob_start();
session_start();


if ($_SESSION["valid"] != true) {

    echo 'شما دسترسی به این صفحه ندارید';

    header('Refresh: 2; URL = ../util/login.php');
    die();
}
if ($_SESSION["user_group"] != 1) {
    echo 'شما دسترسی به این صفحه ندارید';

    header('Refresh: 2; URL = ../usr/profile.php');
    die();
}
include_once '../model/Trip.php';
include_once '../model/User.php';
include_once '../model/UserTrip.php';

if (empty($_GET["id"])) {
    echo "Invalid Trip Id";
    die(0);
} else {
    $id = $_GET["id"];
}

if (!empty($_POST["uname"])) {
    $uname = $_POST["uname"];
}
if (!empty($_POST["name"])) {
    $name = $_POST["name"];
}

?>

<div class="container">
    <?php

    if (!empty($_POST["ProcessingStep"])) {
        $userIds = $_POST["user_ids"];
        logTabiat($userIds);
        logTabiat($id);
        UserTrip::addUsersToTrip($userIds, $id);
    } else
        $trip = Trip::loadById($id);
    ?>
    <h2>
        اضافه کردن افراد به سفر
    </h2>
    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="ProcessingStep" value="add">
        <div class="form-group">
            <label class="control-label col-sm-2" for="id">
                شماره سفر
            </label>
            <div class="col-sm-4">
                <input type="number" class="form-control" name="id" id="id" readonly="readonly"
                       value="<?php echo $trip->id; ?>" placeholder="شماره سفر">
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
                جستجو بر اساس نام کاربری
            </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="uname" id="uname"
                       value="<?php echo $uname; ?>" placeholder="نام کاربر">
            </div>

            <label class="control-label col-sm-2" for="name">
                جستجو بر اساس نام
            </label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="name" id="name"
                       value="<?php echo $name; ?>" placeholder="نام کاربر">
            </div>
            <div class="col-sm-2">
                <input type="submit" class="btn btn-success" value="جستجو"/>
            </div>

        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>وضعیت تاهل و تاریخ ازدواج</th>
                <th>تاریخ تولد</th>
                <th>وضعیت سلامتی</th>
                <th>انتخاب</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include_once "../model/User.php";
            include_once "../model/UserInfo.php";
            include_once "../model/UserGroups.php";
            include_once "../model/Trip.php";
            include_once "../model/Constant.php";

            $trip_id = $_GET["id"];
            if (!empty($_POST["uname"])) {
                $allOtherUsers = User::getSearchedUsersOutOfTrip($trip_id, $_POST["uname"]);
            } elseif (!empty($_POST["name"])) {
                $allOtherUsers = User::getSearchedUsersOutOfTripWithUserInfo($trip_id, $_POST["name"]);
            } else {
                $allOtherUsers = User::getAllUsersOutOfTrip($trip_id);
            }
            $count = 0;
            foreach ($allOtherUsers as $user) {
                $userInfo = UserInfo::loadById($user->id);
                if ($count % 2)
                    $class = "class='info'";
                else
                    $class = "class='warning'";
                $count++;
                echo "<tr " . $class . " >";
                echo "    <td>";
                echo $userInfo->name;
                echo "    </td><td>";
                echo $userInfo->surename;
                echo "    </td><td>";
                echo Constant::loadById($userInfo->married)->name;
                if ($userInfo->married == 18) {
                    logTabiat("married!" . $userInfo->marriage_date);
                    echo "<br>";
                    echo $userInfo->marraige_date;
                }
                echo "    </td><td>";
                echo $userInfo->birthdate;
                echo "    </td><td>";
                if ($userInfo->illness == null)
                    echo "سالم";
                else
                    echo $userInfo->illness;
                echo "    </td><td>";
                echo "<input type='checkbox' value='" . $user->id . "' name='user_ids[]'/>";
                echo "            <span class='glyphicon glyphicon-edit'></span>اضافه کردن کاربر به سفر";
                echo "        </a>";
                echo "    </td>";
                echo "<tr />";
            }
            ?>
            </tbody>
        </table>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">
                    افزودن
                </button>
                <a href="tripUsers.php?id=<?php echo $trip_id; ?>" class="btn btn-danger" role="button">
                    بازگشت به لیست کاربران ثبت نامی
                </a>
                <a href="./allTrips.php" class="btn btn-danger" role="button">
                    بازگشت به لیست سفر ها
                </a>
            </div>
        </div>
    </form>
</div>
</body>
</html>