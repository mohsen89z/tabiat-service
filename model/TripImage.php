<?php

/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 8/1/2016
 * Time: 5:43 PM
 */
include_once '../util/dbManager.php';

class TripImage
{
    public $id;
    public $trip_id;
    public $image;

    /**
     * TripImage constructor.
     * @param $id
     * @param $trip_id
     * @param $image
     */
    public function __construct($id, $trip_id, $image)
    {
        $this->id = $id;
        $this->trip_id = $trip_id;
        $this->image = $image;
    }


    public static function loadByTripId($tripId){
        $sql = sprintf("select id, trip_id, image from tripimages where trip_id = '%s'" , $tripId);

        $images = array();
        $raws = runSelect($sql);
        foreach($raws as $raw){
            array_push($images, new TripImage($raw["id"], $raw["trip_id"], $raw["image"]));
        }

        return $images;
    }

    public function save(){
        $sql = "INSERT INTO tripimages (trip_id, image) VALUES ($this->trip_id, $this->image)";

        runQuery($sql);
    }

    public static function initTripImages(){
        initDbBySQLFile("../sql/tripImages.sql");
    }
}