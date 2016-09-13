<!DOCTYPE html>
<html lang="en">
<head>
    <title>لیست سفرهای ویژه</title>
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

<div class="container">
    <?php

    ob_start();
    session_start();

    ?>
    <h3>
        لیست سفرهای ویژه
    </h3>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>شماره</th>
            <th>نام سفر</th>
            <th>وضعیت</th>
            <th>توضیجات</th>
            <?php
            if ($_SESSION["user_group"] == 1) {
                ?>
                <th>ویرایش</th>
                <?php
            }
            ?>
        </tr>
        </thead>
        <tbody>

        <?php

        include_once "../model/Trip.php";
        include_once "../model/Constant.php";

        $trips = getAllTrips();

        foreach ($trips as $trip) {
            echo "<tr>";
            echo "    <td>";
            echo $trip->id;
            echo "    </td><td>";
            echo $trip->name;
            echo "    </td><td>";
            $trip_statuses = Constant::getAllByType("trip_status");

            foreach ($trip_statuses as $trip_status) {
                if ($trip_status->id == $trip->status) {
                    echo $trip_status->name;
                }
            }
            echo "    </td><td>";
            echo $trip->description;
            echo $_SESSION["user_group"];
            echo $_SESSION["username"];
            if ($_SESSION["user_group"] == 1) {
                echo "    </td><td>";
                echo "        <a href='./editTrip.php?id=" . $trip->id . "' class='btn btn-default btn-sm'>";
                echo "            <span class='glyphicon glyphicon-edit'></span> ویرایش";
                echo "        </a>";
                echo "        <a href='./addImage.php?id=" . $trip->id . "' class='btn btn-default btn-sm'>";
                echo "            <span class='glyphicon glyphicon-camera'></span> افزودن تصویر";
                echo "        </a>";
                echo "        <a href='./tripUsers.php?id=" . $trip->id . "' class='btn btn-default btn-sm'>";
                echo "            <span class='glyphicon glyphicon-th-list'></span> کاربران ثبت نامی";
                echo "        </a>";
            }
            echo "    </td>";
            echo "<tr />";
        }
        ?>
        </tbody>
    </table>


    <br/>

</div>

</body>
</html>