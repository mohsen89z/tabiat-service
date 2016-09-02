<?php

/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 7/29/2016
 * Time: 11:50 AM
 */
include_once '../util/dbManager.php';

class Special
{
    public $trip_id;
    public $priority;

    /**
     * Special constructor.
     * @param $trip_id
     * @param $priority
     */
    public function __construct($trip_id, $priority)
    {
        $this->trip_id = $trip_id;
        $this->priority = $priority;
    }

    public static function getAll(){
        $sql = "select trip_id, priority from specials limit 4";

        $raws = runSelect($sql);

        $specials = array();
        foreach($raws as $raw){
            array_push($specials, new Special($raw->trip_id, $raw->priority));
        }

        return $specials;
    }

    public static function initSpecials()
    {
        initDbBySQLFile("../sql/specials.sql");
    }

}