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
</head>
<body>

<div class="container">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>شماره</th>
            <th>نام سفر</th>
            <th>وضعیت</th>
            <th>توضیجات</th>
            <th>ویرایش</th>
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
            echo "    </td><td>";
            echo "        <a href='./editTrip.php?id=" . $trip->id . "' class='btn btn-default btn-sm'>";
            echo "            <span class='glyphicon glyphicon-edit'></span> ویرایش";
            echo "        </a>";
            echo "        <a href='./addImage.php?id=" . $trip->id . "' class='btn btn-default btn-sm'>";
            echo "            <span class='glyphicon glyphicon-camera'></span> افزودن تصویر";
            echo "        </a>";
            echo "    </td>";
            echo "<tr />";
        }
        ?>
        </tbody>
    </table>

    <br/>
    <a href="addTrip.php" class="btn btn-success" role="button">
        افزودن سفر جدید
    </a>

</div>

</body>
</html>