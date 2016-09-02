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

    public function __construct($trip_id, $user_id, $group_id)
    {
        $this->trip_id = $trip_id;
        $this->user_id = $user_id;
        $this->group_id = $group_id;
    }

    public static function getAll()
    {
        $sql = "select trip_id, user_id, group_id from user_trip";
        return runSelect($sql);
    }

    public function loadById()
    {
        $sql = sprintf("select trip_id, user_id, group_id from user_trip where id = '%s'", $this->id);

        return runSelect($sql);
    }

    public static function addUsersToTrip($user_ids, $trip_id)
    {
        foreach ($user_ids as $user_id) {
            logTabiat("my user is : " . $user_id);
            $userTrip = new UserTrip($trip_id, $user_id, 1);
            $userTrip->save();

        }
    }

    public static function removeUsersFrom($user_ids, $trip_id)
    {
        foreach ($user_ids as $user_id) {
            logTabiat("my user is : " . $user_id);
            $userTrip = new UserTrip($trip_id, $user_id, 1);
            $userTrip->remove();

        }
    }

    public function remove(){
        $sql = sprintf("DELETE FROM user_trip WHERE trip_id = '%s' AND user_id = '%s'", $this->trip_id , $this->user_id);
        runQuery($sql);
    }

    public function save()
    {
        $sql = sprintf("INSERT INTO user_trip
              VALUES ('%s', '%s', '%s')",
            $this->trip_id,
            $this->user_id,
            $this->group_id
        );
        logTabiat($sql);

        runQuery($sql);
    }

    public static function initUserTrip()
    {
        initDbBySQLFile("../sql/user_trip.sql");
    }
}