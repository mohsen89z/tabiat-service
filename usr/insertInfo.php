<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        ویرایش کاربر
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/19/2016
 * Time: 11:20 PM
 */

include_once '../model/UserInfo.php';
include_once '../model/User.php';


$user_id = $_POST["id"];

$id = $user_id;
$status = $_POST["status"];
$black_list = $_POST["black_list"];
$sexuality = $_POST["sexuality"];
$name = $_POST["name"];
$surename = $_POST["surename"];
$father_name = $_POST["father_name"];
$birthdate = $_POST["birthdate"];
$nationality = $_POST["nationality"];
$national_code = $_POST["national_code"];
$national_id = $_POST["national_id"];
$passport_number = $_POST["passport_number"];
$married = $_POST["married"];
$marriage_date = $_POST["marriage_date"];
$introduction = $_POST["introduction"];
$refrence = $_POST["refrence"];
$description = $_POST["description"];
$blood_type = $_POST["blood_type"];
$illness = $_POST["illness"];
$nativ_lnag = $_POST["nativ_lnag"];
$first_lang = $_POST["first_lang"];
$sec_lang = $_POST["sec_lang"];
$edu_level = $_POST["edu_level"];
$edu_field = $_POST["edu_field"];
$job_loc = $_POST["job_loc"];
$job_desc = $_POST["job_desc"];

$userInfo = UserInfo::withMoreData($id, $status, $black_list, $sexuality, $name, $surename, $father_name, $birthdate, $nationality, $national_code, $national_id, $passport_number, $married, $marriage_date, $introduction, $refrence, $description, $blood_type, $illness, $nativ_lnag, $first_lang, $sec_lang, $edu_level, $edu_field, $job_loc, $job_desc);

$userInfo->save();

$userTmp = User::loadById($user_id);
$user = new User($userTmp->id, $userTmp->username, $userTmp->password, $userTmp->group_id);
$user->info_id = $id;
$user->updateUserInfo();


echo "<h2>" . "کاربر با موفقیت ثبت شد!" . "</h2>";

?>

<br>
<?php
if ($_SESSION["user_group"] == 1) {
    ?>
    <a href="allUsers.php" class="btn btn-success" role="button">
        بازگشت به لیست کاربران
    </a>
    <?php
}
?>
<a href="profile.php" class="btn btn-success" role="button">
    بازگشت به پروفایل
</a>

</body>
</html>
