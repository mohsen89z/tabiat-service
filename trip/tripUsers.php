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
</head>
<body>

<div class="container">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>نام</th>
            <th>نام خانوادگی</th>
            <th>وضعیت تاهل</th>
            <th>وضعیت سلامتی</th>
            <th>تغییر رمز</th>
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
        $users = getAllUsersOfTrip($trip_id);
        foreach ($users as $user) {
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
            echo "        <a href='./removeUserFromTrip.php?user_id=" . $user->id . "&trip_id=" . $trip_id . "' class='btn btn-default btn-sm'>";
            echo "            <span class='glyphicon glyphicon-edit'></span>حذف کاربر از سفر ";
            echo "        </a>";
            echo "    </td>";
            echo "<tr />";
        }
        ?>
        </tbody>
    </table>

    <br/>
    <a href="addUser.php" class="btn btn-success" role="button">
        افزودن کاربر به سفر
    </a>

</div>

</body>
</html>
