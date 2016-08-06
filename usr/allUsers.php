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

        foreach ($users as $user) {
            echo "<tr>";
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

</div>

</body>
</html>