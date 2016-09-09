<?php

/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 7/7/2016
 * Time: 8:41 PM
 */

include_once '../util/dbManager.php';
include_once '../util/logger.php';

class Travelers
{
    public $id;
    public $name;
    public $family;
    public $nationalCode;
    public $trip_id;
    public $user_id;

    public function __construct($nationalCode, $name, $family, $trip_id, $user_id)
    {
        $this->trip_id = $trip_id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->family = $family;
        $this->nationalCode = $nationalCode;
    }

    public static function getAll()
    {
        $sql = "select id, name, family , nationalCode , trip_id , user_id from travelers";
        return runSelect($sql);
    }

    public function loadByUserId($user_id)
    {
        $sql = sprintf("select id, name, family , nationalCode , trip_id , user_id from travelers where user_id = '%s'", $user_id);

        return runSelect($sql);
    }

    public static function loadByUserIdAndTripId($user_id, $trip_id)
    {
        $sql = sprintf("select id, name, family , nationalCode , trip_id , user_id from travelers where user_id = '%s' and trip_id = '%s'", $user_id, $trip_id);

        return runSelect($sql);
    }

    public function loadByTripId($trip_id)
    {
        $sql = sprintf("select id, name, family , nationalCode , trip_id , user_id from travelers where trip_id = '%s'", $trip_id);

        return runSelect($sql);
    }

    public function save()
    {
        $sql = sprintf("INSERT INTO travelers (name, family, nationalCode , trip_id , user_id)
              VALUES ('%s', '%s', '%s', '%s' , '%s' )",
            $this->name,
            $this->family,
            $this->nationalCode,
            $this->trip_id,
            $this->user_id
        );
        runQuery($sql);
    }

    public static function addTraveler($nationalCode, $name, $family, $trip_id, $user_id)
    {
        $cTraveler = new Travelers($nationalCode, $name, $family, $trip_id, $user_id);
        $cTraveler->save();
    }

    public function remove()
    {
        $sql = sprintf("DELETE FROM travelers WHERE id = '%s'", $this->id);
        runQuery($sql);
    }


    public static function delete($traveler_id)
    {
        $sql = sprintf("DELETE FROM travelers WHERE id = '%s'", $traveler_id);
        runQuery($sql);
    }
}