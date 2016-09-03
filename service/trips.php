<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 8/17/2016
 * Time: 10:35 PM
 */
include_once '../model/Special.php';
include_once '../model/Trip.php';
include_once '../model/Constant.php';
include_once '../model/TripImage.php';


$method = $_GET["method"];

if($method == "special") {
    echo json_encode(Trip::get4Special());
} elseif ($method == "normal") {
    echo json_encode(Trip::get6Trips());
} elseif ($method == "list") {
    class TripItem {
        public $name;
        public $province;
        public $date;

        /**
         * TripItem constructor.
         * @param $name
         * @param $province
         * @param $date
         */
        public function __construct($name, $province, $date)
        {
            $this->name = $name;
            $this->province = $province;
            $this->date = $date;
        }

    }

    $trips = Trip::getTripList();
    $list = array();
    foreach($trips as $trip){
        $province = Constant::loadById($trip->province_id);
        array_push($list,new TripItem($trip->name, $province->name, $trip->start_date));
    }
    echo json_encode($list);
} elseif ($method == "trpimg"){
    $id = $_GET["id"];

    $img = TripImage::getRandomImgByTripId($id);
    echo "/tabiat-service/trip/images/" . $img->image;
}