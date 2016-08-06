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

if (empty($_GET["id"])) {
    echo "Access Denied!";
    die(0);
} else {
    $id = $_GET["id"];

    TripImage::initTripImages();
    $trip = Trip::loadById($id);
    $images = TripImage::loadByTripId($id);
    foreach ($images as $image) {
        echo "1";
    }
}

if (!empty($_POST["ProcessingStep"])) {
    $file = rand(1000,100000)."-".$_FILES['image']['name'];
    $file_loc = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_type = $_FILES['image']['type'];
    $folder="uploads/";

    move_uploaded_file($file_loc,$folder.$file);

    $image  = new TripImage(-1, $_POST["id"], $file);
    echo $image->image;
    try{
        //$image->save();
        echo "با موفقیت ذخیره شد!";
    } catch (Exception $ex) {
        echo "با موفقیت ذخیره نشد!";
        echo $ex->getCode() . " " . $ex->getMessage();
    }
}
?>

<div class="container">
    <h2>
        مدیریت تصاویر سفر
    </h2>
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