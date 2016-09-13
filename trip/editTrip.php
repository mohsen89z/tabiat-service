<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        ویرایش سفر
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
include_once "../model/Trip.php";
include_once "../model/Constant.php";

ob_start();
session_start();

$trip_id = $_GET["id"];

$trip = Trip::loadById($trip_id);

$trip_specs = json_decode($trip->trip_specs);

$edit = !empty($_GET["edit"]);
$return_special = !empty($_GET["s"]);

?>

<div class="container">
    <h2>

        <?php if ($edit && $_SESSION["user_group"] == 1) { ?>
            ویرایش اطلاعات سفر
        <?php } else { ?>
            مشاهده اطلاعات سفر
        <?php } ?>
    </h2>
    <form class="form-horizontal" role="form" method="post" action="insert.php">
        <div class="form-group">
            <label class="control-label col-sm-2" for="id">
                شماره
            </label>
            <div class="col-sm-10">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="number" class="form-control" name="id"
                                                                       id="id" value="<?php echo $trip->id; ?>"
                                                                       readonly="readonly" placeholder="شماره سفر">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">
                نام سفر
            </label>
            <div class="col-sm-10">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="text" class="form-control"
                                                                       value="<?php echo $trip->name; ?>" name="name"
                                                                       id="name"
                                                                       placeholder="نام سفر">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="status">
                وضعیت
            </label>
            <div class="col-sm-4">
                <select <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" name="status" id="status">
                    <?php
                    $trip_statuses = Constant::getAllByType("trip_status");

                    foreach ($trip_statuses as $trip_status) {
                        if ($trip_status->id == $trip->status) {
                            echo "<option selected='selected' value='" . $trip_status->id . "'>" . $trip_status->name . "</option>";
                        } else {
                            echo "<option value='" . $trip_status->id . "'>" . $trip_status->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <label class="control-label col-sm-2" for="is_special">
                سفر ویژه؟
            </label>
            <div class="col-sm-4">
                <select <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" name="is_special"
                        id="is_special">
                    <?php
                    $special_statuses = Constant::getAllByType("special_status");

                    foreach ($special_statuses as $special_status) {
                        if ($special_status->id == $trip->is_special) {
                            echo "<option selected='selected' value='" . $special_status->id . "'>" . $special_status->name . "</option>";
                        } else {
                            echo "<option value='" . $special_status->id . "'>" . $special_status->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <label class="control-label col-sm-2" for="opr_stat">
                وضعیت اجرا
            </label>
            <div class="col-sm-4">
                <select <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" name="opr_stat"
                        id="opr_stat">
                    <?php
                    $exec_statuses = Constant::getAllByType("exec_status");

                    foreach ($exec_statuses as $exec_status) {
                        if ($exec_status->id == $trip->opr_stat) {
                            echo "<option selected='selected' value='" . $exec_status->id . "'>" . $exec_status->name . "</option>";
                        } else {
                            echo "<option value='" . $exec_status->id . "'>" . $exec_status->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="trip_type">
                نوع سفر
            </label>
            <div class="col-sm-4">
                <select <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" name="trip_type"
                        id="trip_type">
                    <?php
                    $trip_types = Constant::getAllByType("trip_loc_type");

                    foreach ($trip_types as $trip_type) {
                        if ($trip_type->id == $trip->trip_type) {
                            echo "<option selected='selected' value='" . $trip_type->id . "'>" . $trip_type->name . "</option>";
                        } else {
                            echo "<option value='" . $trip_type->id . "'>" . $trip_type->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <label class="control-label col-sm-2" for="province_id">
                استان
            </label>
            <div class="col-sm-4">
                <select <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" name="province_id"
                        id="province_id">
                    <?php
                    $provinces = Constant::getAllByType("iran_state");

                    foreach ($provinces as $province) {
                        if ($province->id == $trip->province_id) {
                            echo "<option selected='selected' value='" . $province->id . "'>" . $province->name . "</option>";
                        } else {
                            echo "<option value='" . $province->id . "'>" . $province->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">
                توضیحات
            </label>
            <div class="col-sm-10">
                <textarea <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" rows="5"
                          name="description" id="description"
                          placeholder="توضیحات سفر"><?php echo $trip->description; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="adminstartor_cmt">
                نکات سرپرستی
            </label>
            <div class="col-sm-10">
                <textarea <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" rows="5"
                          name="adminstartor_cmt" id="adminstartor_cmt"
                          placeholder="نکات سرپرستی	"><?php echo $trip->adminstartor_cmt; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="start_date">
                تاریخ شروع سفر
            </label>
            <div class="col-sm-4">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="text" class="form-control"
                                                                       value="<?php echo $trip->start_date; ?>"
                                                                       id="start_date"
                                                                       name="start_date" placeholder="تاریخ شروع سفر"/>
            </div>
            <label class="control-label col-sm-2" for="end_date">
                تاریخ پایان سفر
            </label>
            <div class="col-sm-4">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="text" class="form-control"
                                                                       value="<?php echo $trip->end_date; ?>"
                                                                       id="end_date"
                                                                       name="end_date" placeholder="تاریخ پایان سفر"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="departure_place">
                محل حرکت
            </label>
            <div class="col-sm-4">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="text" class="form-control"
                                                                       value="<?php echo $trip->departure_place; ?>"
                                                                       id="departure_place" name="departure_place"
                                                                       placeholder="محل حرکت"/>
            </div>
            <label class="control-label col-sm-2" for="departure_time">
                زمان حرکت
            </label>
            <div class="col-sm-4">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="text" class="form-control"
                                                                       value="<?php echo explode('%', $trip->departure_time)[0]; ?>"
                                                                       id="departure_time" name="departure_time_date"
                                                                       placeholder="تاریخ حرکت"/>
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="text" class="form-control"
                                                                       value="<?php echo explode('%', $trip->departure_time)[1]; ?>"
                                                                       id="departure_time" name="departure_time_time"
                                                                       placeholder="ساعت حرکت"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="attractions">
                خلاصه‌ای از جاذبه‌ها
            </label>
            <div class="col-sm-10">
                <textarea <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" rows="5"
                          name="attractions" id="attractions"
                          placeholder="خلاصه‌ای از جاذبه‌ها"><?php echo $trip->attractions; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="opr_type">
                نحوه ی اجرا
            </label>
            <div class="col-sm-4">
                <select <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" name="opr_type"
                        id="opr_type">
                    <?php
                    $opr_types = Constant::getAllByType("opr_type");

                    foreach ($opr_types as $opr_type) {
                        if ($opr_type->id == $trip->opr_type) {
                            echo "<option selected='selected' value='" . $opr_type->id . "'>" . $opr_type->name . "</option>";
                        } else {
                            echo "<option value='" . $opr_type->id . "'>" . $opr_type->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <label class="control-label col-sm-2" for="experties_level">
                میزان سختی
            </label>
            <div class="col-sm-4">
                <select <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" name="experties_level"
                        id="experties_level">
                    <?php
                    $experties_levels = Constant::getAllByType("experties_level");

                    foreach ($experties_levels as $experties_level) {
                        if ($experties_level->id == $trip->experties_level) {
                            echo "<option selected='selected' value='" . $experties_level->id . "'>" . $experties_level->name . "</option>";
                        } else {
                            echo "<option value='" . $experties_level->id . "'>" . $experties_level->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="requiremnt_course">
                پیشنیاز
            </label>
            <div class="col-sm-4">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="text" class="form-control"
                                                                       value="<?php echo $trip->requiremnt_course; ?>"
                                                                       id="requiremnt_course" name="requiremnt_course"
                                                                       placeholder="پیشنیاز"/>
            </div>
            <label class="control-label col-sm-2" for="requirment_stuff">
                مدرک
            </label>
            <div class="col-sm-4">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="text" class="form-control"
                                                                       value="<?php echo $trip->requirment_stuff; ?>"
                                                                       id="requirment_stuff" name="requirment_stuff"
                                                                       placeholder="مدرک"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="capacity">
                ظرفیت
            </label>
            <div class="col-sm-10">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="number" min="0" class="form-control"
                                                                       value="<?php echo $trip->capacity; ?>"
                                                                       name="capacity"
                                                                       id="capacity" placeholder="ظرفیت">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pric_type">
                قیمت
            </label>
            <div class="col-sm-2">
                <select <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" name="pric_type"
                        id="pric_type">
                    <?php
                    $price_types = Constant::getAllByType("price_type");

                    foreach ($price_types as $price_type) {
                        if ($price_type->id == $trip->pric_type) {
                            echo "<option selected='selected' value='" . $price_type->id . "'>" . $price_type->name . "</option>";
                        } else {
                            echo "<option value='" . $price_type->id . "'>" . $price_type->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-2">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="number" step="1000" min="0"
                                                                       value="<?php echo $trip->price; ?>"
                                                                       class="form-control"
                                                                       name="price" id="price"
                                                                       placeholder="قیمت">
            </div>
            <span class="col-sm-1">
                تومان
            </span>
            <label class="control-label col-sm-1" for="wage">
                پورسانت
            </label>
            <div class="col-sm-3">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="number" step="1000" min="0"
                                                                       value="<?php echo $trip->wage; ?>"
                                                                       class="form-control"
                                                                       name="wage" id="wage"
                                                                       placeholder="پورسانت">
            </div>
            <span class="col-sm-1">
                تومان
            </span>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="price_decs">
                توضیحات قیمت
            </label>
            <div class="col-sm-10">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="text" class="form-control"
                                                                       value="<?php echo $trip->price_decs; ?>"
                                                                       name="price_decs"
                                                                       id="price_decs" placeholder="توضیحات قیمت">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="contract_type">
                نوع قرارداد
            </label>
            <div class="col-sm-10">
                <select <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control" name="contract_type"
                        id="contract_type">
                    <?php
                    $contract_types = Constant::getAllByType("contract_type");

                    foreach ($contract_types as $contract_type) {
                        if ($contract_type->id == $trip->contract_type) {
                            echo "<option selected='selected' value='" . $contract_type->id . "'>" . $contract_type->name . "</option>";
                        } else {
                            echo "<option value='" . $contract_type->id . "'>" . $contract_type->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="start_order">
                تاریخ شروع ثبت نام
            </label>
            <div class="col-sm-4">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="text" class="form-control"
                                                                       value="<?php echo $trip->start_order; ?>"
                                                                       id="start_order"
                                                                       name="start_order"
                                                                       placeholder="تاریخ شروع ثبت نام"/>
            </div>
            <label class="control-label col-sm-2" for="end_date">
                تاریخ پایان ثبت نام
            </label>
            <div class="col-sm-4">
                <input <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?> type="text" class="form-control"
                                                                       value="<?php echo $trip->end_order; ?>"
                                                                       id="end_order"
                                                                       name="end_order"
                                                                       placeholder="تاریخ پایان ثبت نام"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="invis_cmt">
                توضیحات مخفی
            </label>
            <div class="col-sm-10">
                <textarea
                    <?php if (!$edit || $_SESSION["user_group"] != 1) echo "disabled='disabled'" ?>class="form-control"
                    rows="5" name="invis_cmt" id="invis_cmt"
                    placeholder="توضیحات مخفی"><?php echo $trip->invis_cmt; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="invis_cmt">
                مشخصات سفر
            </label>
            <div class="col-sm-10 row">

                <?php
                $con_types = Constant::getAllByType("trip_spc");
                if (!$edit || $_SESSION["user_group"] != 1) {
                    foreach ($con_types as $con_type) {
                        if (in_array($con_type->id, $trip_specs, true)) {
                            echo "<div  class='col-sm-6'><input disabled='disabled' type='checkbox' value='" . $con_type->id . "' name='trip_spec[]' checked/>
                    " . $con_type->name . " <img src='/tabiat/assets/img/trip-icos/" . $con_type->id . ".png' /></div>";
                        } else {
                            echo "<div  class='col-sm-6'><input disabled='disabled' type='checkbox' value='" . $con_type->id . "' name='trip_spec[]'/>
                    " . $con_type->name . " <img src='/tabiat/assets/img/trip-icos/" . $con_type->id . ".png' /></div>";
                        }
                    }
                } else {
                    foreach ($con_types as $con_type) {

                        if (in_array($con_type->id, $trip_specs, true)) {
                            echo "<div  class='col-sm-6'><input type='checkbox' value='" . $con_type->id . "' name='trip_spec[]' checked/>
                    " . $con_type->name . " <img src='/tabiat/assets/img/trip-icos/" . $con_type->id . ".png' /></div>";
                        } else {
                            echo "<div  class='col-sm-6'><input type='checkbox' value='" . $con_type->id . "' name='trip_spec[]'/>
                    " . $con_type->name . " <img src='/tabiat/assets/img/trip-icos/" . $con_type->id . ".png' /></div>";
                        }
                    }
                }
                ?>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">

                <?php if (!$edit || $_SESSION["user_group"] != 1) { ?>
                <?php if ($return_special) { ?>
                <a href="editTrip.php?s=t&edit=true&id=<?php echo $trip_id ?>" class="btn btn-success">
                    <?php } else { ?>
                    <a href="editTrip.php?edit=true&id=<?php echo $trip_id ?>" class="btn btn-success">
                        <?php } ?>
                        ویرایش
                    </a>
                    <?php } else { ?>
                        <button type="submit" class="btn btn-success">
                            ذخیره
                        </button>
                    <?php } ?>


                    <?php if ($return_special) { ?>

                        <a href="./specials.php" class="btn btn-danger" role="button">
                            بازگشت به لیست سفر های ویژه
                        </a>
                    <?php } else { ?>

                        <a href="./allTrips.php" class="btn btn-danger" role="button">
                            بازگشت به لیست سفر ها
                        </a>
                    <?php } ?>

            </div>
        </div>
    </form>
</div>

<script>
    $("#start_date").datepicker({
        numberOfMonths: 3,
        minDate: 0,
        showButtonPanel: true
    });

    $("#end_date").datepicker({
        numberOfMonths: 3,
        minDate: 0,
        showButtonPanel: true
    });

    $("#start_order").datepicker({
        numberOfMonths: 3,
        minDate: 0,
        showButtonPanel: true
    });

    $("#end_order").datepicker({
        numberOfMonths: 3,
        minDate: 0,
        showButtonPanel: true
    });

    $("#departure_time").datepicker({
        minDate: 0,
        showButtonPanel: true
    });
</script>

</body>
</html>
