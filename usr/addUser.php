<?php
include_once "../model/Constant.php";
include_once "../model/User.php";
include_once "../model/UserGroups.php";

if (empty($_GET["id"])) {
    $id = (User::getMaxId()) + 1;
} else {
    $id = $_GET['id'];
    $user = User::loadById($id);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        <?php if (empty($user)) { ?>
            افزودن کاربرجدید
        <?php } else { ?>
            ویرایش کاربر
        <?php } ?>

    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">

    <link rel="stylesheet" href="../web/css/bootstrap-datepicker.min.css">
    <script src="../web/js/bootstrap-datepicker.min.js"></script>
    <script src="../web/js/bootstrap-datepicker.fa.min.js"></script>

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
    <h2>
        <?php

        if (empty($user)) {
            if ($_SESSION["user_group"] != 1) {
                echo 'شما دسترسی به این صفحه ندارید';

                header('Refresh: 2; URL = profile.php');
                die();
            }
            ?>
            کاربرجدید
        <?php } else { ?>
            ویرایش اطلاعات
        <?php } ?>
    </h2>
    <form class="form-horizontal" role="form" method="post" action="insert.php">
        <div class="form-group">
            <label class="control-label col-sm-2" for="id">
                شماره
            </label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="id" id="id" readonly="readonly"
                       value="<?php echo $id; ?>" placeholder="شماره سفر">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="username">
                نام کاربری
            </label>
            <div class="col-sm-10">
                <?php if (empty($user)) { ?>
                    <input type="text" class="form-control" name="username" id="username" placeholder="نام کاربری">
                <?php } else { ?>
                    <input type="text" class="form-control" name="username" value="<?php echo $user->username; ?>"
                           readonly="readonly" id="username" placeholder="نام کاربری">
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="password">
                رمز عبور جدید
            </label>
            <div class="col-sm-10">
                <?php if (empty($user)) { ?>
                    <input type="password" class="form-control" name="password" id="password" placeholder="رمز عبور">
                <?php } else { ?>
                    <input type="password" class="form-control" name="password" value="<?php echo $user->password; ?>"
                           id="password" placeholder="رمز عبور">
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="group_id">
                سمت
            </label>
            <div class="col-sm-4">
                <select class="form-control" name="group_id" id="group_id">
                    <?php
                    $groups = UserGroups::getAll();

                    foreach ($groups as $group) {
                        if (!empty($user) && $group->id == $user->group_id) {
                            echo "<option selected='selected' value='" . $group->id . "'>" . $group->name . "</option>";
                        } else {
                            echo "<option value='" . $group->id . "'>" . $group->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">
                    ثبت
                </button>
                <a href="allUsers.php" class="btn btn-danger" role="button">
                    بازگشت به لیست کاربران
                </a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
