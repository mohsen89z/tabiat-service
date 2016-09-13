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
<body>
<?php

ob_start();
session_start();
if ($_SESSION["user_group"] != 1) {
    echo 'شما دسترسی به این صفحه ندارید';

    header('Refresh: 2; URL = profile.php');
    die();
}
?>
?>
<div class="container">
    <h2>
        لیست کاربران
    </h2>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>شماره</th>
            <th>نام کاربری</th>
            <th>سمت</th>
            <th>ویرایش اطلاعات</th>
            <th>تغییر رمز</th>
        </tr>
        </thead>
        <tbody>

        <?php
        include_once "../model/User.php";
        include_once "../model/UserGroups.php";

        $users = User::getAll();
        $count = 0;
        foreach ($users as $user) {
            if ($count % 2)
                $class = "class='info'";
            else
                $class = "class='warning'";
            $count++;
            echo "<tr " . $class . " >";
            echo "    <td>";
            echo $user->id;
            echo "    </td><td>";
            echo $user->username;
            echo "    </td><td>";
            $userGroups = UserGroups::getAll();

            foreach ($userGroups as $group) {
                if ($group->id == $user->group_id) {
                    echo $group->title;
                }
            }
            echo "    </td><td>";
            echo "        <a href='./addInfo.php?id=" . $user->id . "' class='btn btn-default btn-sm'>";
            echo "            <span class='glyphicon glyphicon-edit'></span> اطلاعات تکمیلی";
            echo "        </a>";
            echo "    </td><td>";
            echo "        <a href='./addUser.php?id=" . $user->id . "' class='btn btn-default btn-sm'>";
            echo "            <span class='glyphicon glyphicon-edit'></span> تغییر رمز";
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
    <br>
    <br>
</div>
</body>
</html>