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


include_once '../model/Trip.php';
include_once '../model/User.php';
include_once '../model/UserTrip.php';

if (empty($_GET["id"])) {
    echo "Invalid Trip Id";
    die(0);
} else {
    $id = $_GET["id"];
}

?>

<div class="container">
    <?php

    if (!empty($_POST["ProcessingStep"])) {
        logTabiat("we are here");
        $userIds = $_POST["user_ids"];
        logTabiat($userIds);
        logTabiat($id);
        UserTrip::addUsersToTrip($userIds, $id);
        logTabiat("after this");
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
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>وضعیت تاهل</th>
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
            $allOtherUsers = getAllUsersOutOfTrip($trip_id);

            foreach ($allOtherUsers as $user) {
                $userInfo = UserInfo::loadById($user->id);
                echo "<tr>";
                echo "    <td>";
                echo $userInfo->name;
                echo "    </td><td>";
                echo $userInfo->surename;
                echo "    </td><td>";
                $maritalStatuses = Constant::getAllByType("marriage");

                foreach ($maritalStatuses as $maritalStatus) {
                    if ($maritalStatus->id == $userInfo->married) {
                        echo $maritalStatus->name;
                    }
                }

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
                <a href="./allTrips.php" class="btn btn-danger" role="button">
                    بازگشت به لیست سفر ها
                </a>
            </div>
        </div>
    </form>
</div>
</body>
</html>