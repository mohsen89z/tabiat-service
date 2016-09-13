<?php
ob_start();
session_start();
?>

<?
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
?>
<head>
    <title>
        پروفایل
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

<div class="container">
    <?php
    include_once "../model/Constant.php";
    include_once "../model/User.php";
    include_once "../model/UserGroups.php";
    include_once "../model/UserInfo.php";

    $id = $_SESSION['user_id'];
    $user = User::loadById($id);
    $userInfo = UserInfo::loadById($id);
    ?>
    <br>
    <form class="form-horizontal" role="form" method="post" action="insertInfo.php">
        <?php
        if ($_SESSION['valid'] == true) {
            if ($_SESSION['user_group'] == 1) {
                ?>
                <a href="../trip/addTrip.php" class="btn btn-primary">اضافه کردن سفر</a>
                <a href="addUser.php" class="btn btn-default">اضافه کردن کاربر</a>
                <?php
            }
            ?>
            <a href="myTrips.php" class="btn btn-success"> لیست سفرهای من </a>
            <a href="../trip/allTrips.php" class="btn btn-info"> لیست تمام سفرها </a>
            <a href="../trip/specials.php" class="btn btn-warning"> لیست سفرهای ویژه </a>
            <a href="../util/logout.php" class="btn btn-danger"> خروج</a>
            <?php
        } else {
            ?>
            شما دسترسی به این صفحه ندارید
            <?php

            header('Refresh: 2; URL = ../util/login.php');
            die();
        }
        ?>
        <br>
        <br>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">
                نام
            </label>
            <div class="col-sm-4">
                <input <?php echo "value='" . $userInfo->name . "'"; ?> disabled='disabled' type="text"
                                                                        class="form-control" name="name"
                                                                        id="name" placeholder="نام">
            </div>
            <label class="control-label col-sm-2" for="surename">
                نام خانوادگی
            </label>
            <div class="col-sm-4">
                <input <?php echo "value='" . $userInfo->surename . "'"; ?> disabled='disabled' type="text"
                                                                            class="form-control" name="surename"
                                                                            id="surename" placeholder="نام خانوادگی">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="father_name">
                نام پدر
            </label>
            <div class="col-sm-4">
                <input <?php echo "value='" . $userInfo->father_name . "'"; ?> disabled='disabled' type="text"
                                                                               class="form-control"
                                                                               name="father_name" id="father_name"
                                                                               placeholder="نام پدر">
            </div>
            <label class="control-label col-sm-2" for="birthdate">
                تاریخ تولد
            </label>
            <div class="col-sm-4">
                <input <?php if (!$newInfo) echo "value='" . $userInfo->birthdate . "'"; ?> disabled='disabled'
                                                                                            type="text"
                                                                                            class="form-control"
                                                                                            name="birthdate"
                                                                                            id="birthdate"
                                                                                            placeholder="تاریخ تولد">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="national_code">
                شماره شناسنامه
            </label>
            <div class="col-sm-2">
                <input <?php if (!$newInfo) echo "value='" . $userInfo->national_code . "'"; ?> disabled='disabled'
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                name="national_code"
                                                                                                id="national_code"
                                                                                                placeholder="شماره شناسنامه">
            </div>
            <label class="control-label col-sm-2" for="national_id">
                کد ملی
            </label>
            <div class="col-sm-2">
                <input <?php if (!$newInfo) echo "value='" . $userInfo->national_id . "'"; ?> disabled='disabled'
                                                                                              type="text"
                                                                                              class="form-control"
                                                                                              name="national_id"
                                                                                              id="national_id"
                                                                                              placeholder="کد ملی">
            </div>
            <label class="control-label col-sm-2" for="passport_number">
                شماره ی پاسپورت
            </label>
            <div class="col-sm-2">
                <input <?php if (!$newInfo) echo "value='" . $userInfo->passport_number . "'"; ?> disabled='disabled'
                                                                                                  type="text"
                                                                                                  class="form-control"
                                                                                                  name="passport_number"
                                                                                                  id="passport_number"
                                                                                                  placeholder="شماره ی پاسپورت">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="married">
                وضعیت تأهل
            </label>
            <div class="col-sm-4">
                <select disabled='disabled' class="form-control" name="married"
                        id="married">
                    <?php
                    $maritalStatuses = Constant::getAllByType("marriage");

                    foreach ($maritalStatuses as $maritalStatus) {
                        if ($maritalStatus->id == $userInfo->married) {
                            echo "<option selected='selected' value='" . $maritalStatus->id . "'>" . $maritalStatus->name . "</option>";
                        } else {
                            echo "<option value='" . $maritalStatus->id . "'>" . $maritalStatus->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <label class="control-label col-sm-2" for="marriage_date">
                تاریخ ازدواج
            </label>
            <div class="col-sm-4">
                <input <?php if (!$newInfo) echo "value='" . $userInfo->marriage_date . "'"; ?> disabled='disabled'
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                name="marriage_date"
                                                                                                id="marriage_date"
                                                                                                placeholder="تاریخ ازدواج">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="introduction">
                نحوه ی آشنایی
            </label>
            <div class="col-sm-4">
                <select disabled='disabled' class="form-control" name="introduction"
                        id="introduction">
                    <option value="14">نامشخص</option>
                    <?php
                    $introduction_types = Constant::getAllByType("introduction_type");

                    foreach ($introduction_types as $introduction_type) {
                        if ($introduction_type->id == $userInfo->introduction) {
                            echo "<option selected='selected' value='" . $introduction_type->id . "'>" . $introduction_type->name . "</option>";
                        } else {
                            echo "<option value='" . $introduction_type->id . "'>" . $introduction_type->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <label class="control-label col-sm-2" for="refrence">
                معرف
            </label>
            <div class="col-sm-4">
                <input <?php if (!$newInfo) echo "value='" . $userInfo->refrence . "'"; ?> disabled='disabled'
                                                                                           type="text"
                                                                                           class="form-control"
                                                                                           name="refrence"
                                                                                           id="refrence"
                                                                                           placeholder="معرف">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">
                توضیحات
            </label>
            <div class="col-sm-10">
                <input <?php if (!$newInfo) echo "value='" . $userInfo->description . "'"; ?> disabled='disabled'
                                                                                              type="text"
                                                                                              class="form-control"
                                                                                              name="description"
                                                                                              id="description"
                                                                                              placeholder="توضیحات">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="blood_type">
                گروه خونی
            </label>
            <div class="col-sm-4">
                <select disabled='disabled' class="form-control" name="blood_type"
                        id="blood_type">
                    <option value="14">نامشخص</option>
                    <?php
                    $blood_types = Constant::getAllByType("blood_type");

                    foreach ($blood_types as $blood_type) {
                        if ($blood_type->id == $userInfo->blood_type) {
                            echo "<option selected='selected' value='" . $blood_type->id . "'>" . $blood_type->name . "</option>";
                        } else {
                            echo "<option value='" . $blood_type->id . "'>" . $blood_type->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <label class="control-label col-sm-2" for="illness">
                بیماری
            </label>
            <div class="col-sm-4">
                <input <?php if (!$newInfo) echo "value='" . $userInfo->illness . "'"; ?> disabled='disabled'
                                                                                          type="text"
                                                                                          class="form-control"
                                                                                          name="illness"
                                                                                          id="illness"
                                                                                          placeholder="بیماری">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="nativ_lnag">
                زبان مادری
            </label>
            <div class="col-sm-1">
                <select disabled='disabled' class="form-control" name="nativ_lnag"
                        id="nativ_lnag">
                    <?php
                    $nativ_lnags = Constant::getAllByType("lang");

                    foreach ($nativ_lnags as $nativ_lnag) {
                        if ($nativ_lnag->id == $userInfo->nativ_lnag) {
                            echo "<option selected='selected' value='" . $nativ_lnag->id . "'>" . $nativ_lnag->name . "</option>";
                        } else {
                            echo "<option value='" . $nativ_lnag->id . "'>" . $nativ_lnag->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <label class="control-label col-sm-2" for="first_lang">
                زبان خارجی اول
            </label>
            <div class="col-sm-1">
                <select disabled='disabled' class="form-control" name="first_lang"
                        id="first_lang">
                    <option value="14">نامشخص</option>
                    <?php
                    $first_langs = Constant::getAllByType("lang");

                    foreach ($first_langs as $first_lang) {
                        if ($first_lang->id == $userInfo->first_lang) {
                            echo "<option selected='selected' value='" . $first_lang->id . "'>" . $first_lang->name . "</option>";
                        } else {
                            echo "<option value='" . $first_lang->id . "'>" . $first_lang->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <label class="control-label col-sm-2" for="sec_lang">
                زبان خارجی دوم
            </label>
            <div class="col-sm-1">
                <select disabled='disabled' class="form-control" name="sec_lang"
                        id="sec_lang">
                    <option value="14">نامشخص</option>
                    <?php
                    $sec_langs = Constant::getAllByType("lang");

                    foreach ($sec_langs as $sec_lang) {
                        if ($sec_lang->id == $userInfo->sec_lang) {
                            echo "<option selected='selected' value='" . $sec_lang->id . "'>" . $sec_lang->name . "</option>";
                        } else {
                            echo "<option value='" . $sec_lang->id . "'>" . $sec_lang->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <label class="control-label col-sm-2" for="edu_level">
                میزان تحصیلات
            </label>
            <div class="col-sm-1">
                <select disabled='disabled' class="form-control" name="edu_level"
                        id="edu_level">
                    <option value="14">نامشخص</option>
                    <?php
                    $edu_levels = Constant::getAllByType("edu_level");

                    foreach ($edu_levels as $edu_level) {
                        if ($edu_level->id == $userInfo->edu_level) {
                            echo "<option selected='selected' value='" . $edu_level->id . "'>" . $edu_level->name . "</option>";
                        } else {
                            echo "<option value='" . $edu_level->id . "'>" . $edu_level->name . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="edu_field">
                رشته تحصیلی
            </label>
            <div class="col-sm-10">
                <input <?php if (!$newInfo) echo "value='" . $userInfo->edu_field . "'"; ?> disabled='disabled'
                                                                                            type="text"
                                                                                            class="form-control"
                                                                                            name="edu_field"
                                                                                            id="edu_field"
                                                                                            placeholder="رشته تحصیلی">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="job_desc">
                شغل
            </label>
            <div class="col-sm-4">
                <input <?php if (!$newInfo) echo "value='" . $userInfo->job_desc . "'"; ?> disabled='disabled'
                                                                                           type="text"
                                                                                           class="form-control"
                                                                                           name="job_desc"
                                                                                           id="job_desc"
                                                                                           placeholder="شغل">
            </div>
            <label class="control-label col-sm-2" for="job_loc">
                محل کار
            </label>
            <div class="col-sm-4">
                <input <?php if (!$newInfo) echo "value='" . $userInfo->job_loc . "'"; ?> disabled='disabled'
                                                                                          type="text"
                                                                                          class="form-control"
                                                                                          name="job_loc"
                                                                                          id="job_loc"
                                                                                          placeholder="محل کار">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">

                <a href="addInfo.php?edit=true&id=<?php echo $id ?>" class="btn btn-success">
                    ویرایش
                </a>

            </div>
        </div>
    </form>
</div>

<script>
    $("#birthdate").datepicker({
        maxDate: 0,
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true
    });

    $("#marriage_date").datepicker({
        maxDate: 0,
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true
    });
</script>

</body>
</html>
