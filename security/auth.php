<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/6/2016
 * Time: 3:37 PM
 */
$valid_passwords = array ("admin" => "123");
$valid_users = array_keys($valid_passwords);

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    die ("Not authorized");
}

header('Location: ../trip/allTrips.php');

?>