<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        افزودن تصویر جدید
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

        .item img {
            width: 100px;
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
include_once '../model/TripImage.php';

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
if (empty($_GET["id"])) {
    echo "سفر مورد نظر وجود ندارد";
    die(0);
}
else {
    $id = $_GET["id"];

//    TripImage::initTripImages();
    $trip = Trip::loadById($id);
    $images = TripImage::loadByTripId($id);
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
        مدیریت تصاویر سفر
    </h2>

    <?php
    if (!empty($_POST["ProcessingStep"])) {
        try {
            $file = basename(rand(1000, 100000) . "-" . $_FILES['image']['name']);
            $file_loc = $_FILES['image']['tmp_name'];
            $file_size = $_FILES['image']['size'];
            $file_type = $_FILES['image']['type'];
            $folder = "/usr/share/nginx/html/tabiat-service/trip/images/";

            move_uploaded_file($file_loc, $folder . $file);

            $image = new TripImage(-1, $_POST["id"], $file);
            $image->save();
            ?>
            <div class="alert alert-success">
                <?php
                echo "با موفقیت ذخیره شد!";
                ?>
            </div>
            <?php
        } catch (Exception $ex) {
            ?>
            <div class="alert alert-danger">
                <?php
                echo "خطا رخ داد!";
                echo $ex->getCode() . " " . $ex->getMessage();
                ?>
            </div>
            <?php
        }
    }
    ?>

    <?php
    if (count($images) > 0) {
        ?>
        <!-- Squares -->
        <div id="squersSlider" class="owl-carousel owl-theme Iran-Sans">
            <?php
            foreach ($images as $image) {
                ?>
                <div class="item">
                    <img src="/tabiat-service/trip/images/<?php echo $image->image; ?>"/>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>

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
        <div class="form-group">
            <label class="control-label col-sm-2" for="image">
                اننتخاب تصویر
            </label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="image" id="image">
            </div>
        </div>

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