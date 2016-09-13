<!DOCTYPE html>
<html lang="en">
<head>
    <title>لیست سفر ها</title>


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


    if ($_SESSION["valid"] != true) {

        echo 'شما دسترسی به این صفحه ندارید';

        header('Refresh: 2; URL = ../util/login.php');
        die();
    }
    ?>
    <h3>
        لیست سفرهای من
    </h3>
    <br>
    <br>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>شماره</th>
            <th>نام سفر</th>
            <th>وضعیت</th>
            <th>توضیحات</th>
            <th>اضافه کردن همسفر</th>
        </tr>
        </thead>
        <tbody>

        <?php
        include_once "../model/Trip.php";
        include_once "../model/Constant.php";
        $user_id = $_SESSION["user_id"];
        $trips = getAllTripsOfUser($user_id);

        $count = 0;
        foreach ($trips as $trip) {
            if ($count % 2)
                $class = "class='info'";
            else
                $class = "class='warning'";
            $count++;
            echo "<tr " . $class . " >";
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
            echo "    </td><td>";
            echo "        <a href='./addTraveler.php?trip_id=" . $trip->id . "&user_id=" . $user_id . "' class='btn btn-default btn-sm'>";
            echo "            <span class='glyphicon glyphicon-th-list'></span>اضافه کردن همسفر ";
            echo "        </a>";
            echo "    </td>";
            echo "<tr />";
        }
        ?>
        </tbody>
    </table>

</div>

</body>
</html>