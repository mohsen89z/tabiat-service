<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        اطلاعات تکمیلی سفر
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
include_once "../model/Constant.php";
include_once "../model/Trip.php";
$trip_id = $_GET["id"];
$trip = Trip::loadById($trip_id);

ob_start();
session_start();

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
    <?php


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
    <h2>
        اطلاعات تکمیلی سفر
    </h2>
    <form class="form-horizontal" role="form" method="post" action="insertAdditional.php">
        <input type="hidden" name="trip_id" value="<?php echo $trip_id ?>"/>
        <div class="form-group">
            <label class="control-label col-sm-2" for="invis_cmt">
                طبقه بندی سفر
            </label>
            <div class="col-sm-10 row">
                <?php
                $con_types = Constant::getAllByType("trip_cat");

                foreach ($con_types as $con_type) {
                    echo "<div  class='col-sm-6'><input type='radio' value='" . $con_type->id . "' name='trip_cat[]'/> " . $con_type->name . "</div>";
                }
                ?>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>

        <div class="form-group">
            <label class="control-label col-sm-2" for="invis_cmt">
                وسیله نقلیه
            </label>
            <div class="col-sm-10 row">
                <?php
                $con_types = Constant::getAllByType("trip_vec");

                foreach ($con_types as $con_type) {
                    echo "<div  class='col-sm-6'><input type='checkbox' value='" . $con_type->id . "' name='trip_vec[]'/> " . $con_type->name . "</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="invis_cmt">
                توضیحات وسیله نقلیه
            </label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="car_cmt" id="car_cmt"
                          placeholder="توضیحات وسیله نقلیه"></textarea>
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-2" for="invis_cmt">
                ملزومات سفر
            </label>
            <div class="col-sm-10 row">
                <?php
                $con_types = Constant::getAllByType("trip_nes");

                foreach ($con_types as $con_type) {
                    echo "<div  class='col-sm-6'><input type='checkbox' value='" . $con_type->id . "' name='trip_nes[]'/> " . $con_type->name . "</div>";
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="invis_cmt">
                وعده های غذایی
            </label>
            <br>
            <br>
            <br>
            <?php
            for ($i = 0; $i < $trip->duration; $i++) {
                ?>
                <label class="control-label col-sm-1" for="invis_cmt">
                    صبحانه
                    <?php echo $i + 1 ?>
                </label>

                <div class="col-sm-1">
                    <select class="form-control" name="bfood_prov[]">
                        <?php
                        $food_provs = Constant::getAllByType("food_prov");

                        foreach ($food_provs as $food_prov) {
                            echo "<option value='" . $food_prov->id . "'>" . $food_prov->name. "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-sm-1">
                    <select class="form-control" name="bdine_loc[]">
                        <?php
                        $food_provs = Constant::getAllByType("dine_loc");

                        foreach ($food_provs as $food_prov) {
                            echo "<option value='" . $food_prov->id . "'>" . $food_prov->name. "</option>";
                        }
                        ?>
                    </select>
                </div>

                <label class="control-label col-sm-1" for="invis_cmt">
                    نهار
                    <?php echo $i + 1 ?>
                </label>

                <div class="col-sm-1">
                    <select class="form-control" name="lfood_prov[]">
                        <?php
                        $food_provs = Constant::getAllByType("food_prov");

                        foreach ($food_provs as $food_prov) {
                            echo "<option value='" . $food_prov->id . "'>" . $food_prov->name."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-sm-1">
                    <select class="form-control" name="ldine_loc[]">
                        <?php
                        $food_provs = Constant::getAllByType("dine_loc");

                        foreach ($food_provs as $food_prov) {
                            echo "<option value='" . $food_prov->id . "'>" . $food_prov->name ."</option>";
                        }
                        ?>
                    </select>
                </div>


                <label class="control-label col-sm-1" for="invis_cmt">
                    شام
                    <?php echo $i + 1 ?>
                </label>

                <div class="col-sm-1">
                    <select class="form-control" name="dfood_prov[]">
                        <?php
                        $food_provs = Constant::getAllByType("food_prov");

                        foreach ($food_provs as $food_prov) {
                            echo "<option value='" . $food_prov->id . "'>" . $food_prov->name."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-sm-1">
                    <select class="form-control" name="ddine_loc[]">
                        <?php
                        $food_provs = Constant::getAllByType("dine_loc");

                        foreach ($food_provs as $food_prov) {
                            echo "<option value='" . $food_prov->id . "'>" . $food_prov->name."</option>";
                        }
                        ?>
                    </select>
                </div>

                <br>
                <br>
                <br>
                <?php
            }
            ?>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">
                    ثبت
                </button>
            </div>
        </div>
    </form>
</div>
</body>