<?php

/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 7/7/2016
 * Time: 8:41 PM
 */

include_once '../util/dbManager.php';
include_once '../util/logger.php';

class UserTrip
{
    public $trip_id;
    public $user_id;
    public $group_id;

    public static function getAll(){
        $sql = "select trip_id, user_id, group_id from user_trip";

        return runSelect($sql);
    }

    public function loadById(){
        $sql = sprintf("select trip_id, user_id, group_id from user_trip where id = '%s'" , $this->id);

        return runSelect($sql);
    }

    public static function initUserTrip(){
        initDbBySQLFile("../sql/user_trip.sql");
    }
}