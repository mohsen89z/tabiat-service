<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
if ($_SESSION["user_group"] != 1) {
    echo 'شما دسترسی به این صفحه ندارید';

    header('Refresh: 2; URL = ../usr/profile.php');
    die();
}
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
                <li><a href="addUser.php">اضافه کردن کاربر</a></li>
                <?php
            }
            ?>
            <li><a href="myTrips.php"> لیست سفرهای من </a></li>
            <li><a href="../trip/allTrips.php"> لیست تمام سفرها </a></li>
            <li><a href="../trip/specials.php"> لیست سفرهای ویژه </a></li>
        </ul>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="../util/logout.php"> خروج</a></li>
        </ul>
</div>
<div class="container">
    <br>
    <br>
    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>وضعیت تاهل</th>
                <th>وضعیت سلامتی</th>
                <th>حذف کاربر از سفر</th>
            </tr>
            </thead>
            <tbody>

            <?php
            include_once "../model/User.php";
            include_once "../model/UserInfo.php";
            include_once "../model/UserTrip.php";
            include_once "../model/UserGroups.php";
            include_once "../model/Trip.php";
            include_once "../model/Constant.php";

            $trip_id = $_GET["id"];
            if (!empty($_POST["ProcessingStep"])) {
                $userIds = $_POST["user_ids"];
                UserTrip::removeUsersFrom($userIds, $trip_id);
            }
            $users = User::getAllUsersOfTrip($trip_id);
            $count = 0;
            foreach ($users as $user) {
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
                echo "            <span class='glyphicon glyphicon-edit'></span>حذف کاربر از سفر";
                echo "        </a>";
                echo "    </td>";
                echo "<tr />";
            }
            ?>
            </tbody>
        </table>

        <br/>
        <button type="submit" class="btn btn-success">
            حذف کاربران انتخاب شده
        </button>
        <a href="addUserToTrip.php?id=<?php echo $trip_id; ?>" class="btn btn-success" role="button">
            افزودن کاربر به سفر
        </a>
        <a href="./allTrips.php" class="btn btn-danger" role="button">
            بازگشت به لیست سفر ها
        </a>
        <input type="hidden" name="ProcessingStep" value="add">

        <br>
        <br>
</div>

</form>
</body>
</html>
