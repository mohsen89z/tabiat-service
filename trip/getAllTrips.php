<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/6/2016
 * Time: 12:31 PM
 */
include_once "../model/Trip.php";

$trips = getAllTrips();

foreach($trips as $trip){
    echo $trip->id;
    echo " , ";
    echo $trip->name;
    echo " , ";
    echo $trip->status;
    echo " , ";
    echo $trip->description;
    echo "<br />";
}
?>