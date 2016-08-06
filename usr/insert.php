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
<body><?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/19/2016
 * Time: 8:55 PM
 */

include_once '../model/User.php';

$id = $_POST["id"];
$username = $_POST["username"];
$password = $_POST["password"];
$group_id = $_POST["group_id"];

$user = new User($id, $username, $password, $group_id);
$user->save();

echo "<h2>" . "کاربر با موفقیت ثبت شد!" . "</h2>";

?>

<br>
<a href="allUsers.php" class="btn btn-success" role="button">
    بازگشت به لیست کاربران
</a>

</body>
</html>
