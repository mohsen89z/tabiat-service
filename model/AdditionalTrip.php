<?php

include_once '../util/dbManager.php';

class AdditionalTrip
{
    public $id;
    public $car;
    public $necessary_tools;
    public $suggested_tools;
    public $necessary_leader_tools;
    public $car_details;
    public $trip_cat;
    public $trip_id;
    public $breakfast_provider;
    public $breakfast_location;
    public $lunch_provider;
    public $lunch_location;
    public $dinner_provider;
    public $dinner_location;

    public function __construct(
        $car,
        $necessary_tools,
        $car_details,
        $trip_cat,
        $trip_id,
        $breakfast_provider,
        $breakfast_location,
        $lunch_provider,
        $lunch_location,
        $dinner_provider,
        $dinner_location)
    {
        $this->car = $car;
        $this->necessary_tools = $necessary_tools;
        $this->car_details = $car_details;
        $this->trip_cat = $trip_cat;
        $this->trip_id = $trip_id;
        $this->breakfast_provider = $breakfast_provider;
        $this->breakfast_location = $breakfast_location;
        $this->lunch_location = $lunch_location;
        $this->lunch_provider = $lunch_provider;
        $this->dinner_location = $dinner_location;
        $this->dinner_provider = $dinner_provider;
    }

    public
    static function getAll()
    {
        $sql = "select id , car,
        necessary_tools,
        suggested_tools,
        necessary_leader_tools,
        car_details,
        trip_cat,
        trip_id ,
        breakfast_provider,
        breakfast_location,
        lunch_provider,
        lunch_location,
        dinner_provider,
        dinner_locationfrom trip_additional";
        return runSelect($sql);
    }

    public
    function save()
    {
        $sql = sprintf("INSERT INTO trip_additional (car,
        necessary_tools,
        car_details,
        trip_cat,
        trip_id,
        breakfast_provider,
        breakfast_location,
        lunch_provider,
        lunch_location,
        dinner_provider,
        dinner_location) VALUES ('%s', '%s', '%s', '%s' , '%s' ,'%s', '%s', '%s' , '%s' ,'%s', '%s');
        ",
            json_encode($this->car),
            json_encode($this->necessary_tools),
            $this->car_details,
            json_encode($this->trip_cat),
            $this->trip_id,
            json_encode($this->breakfast_provider),
            json_encode($this->breakfast_location),
            json_encode($this->lunch_location),
            json_encode($this->lunch_provider),
            json_encode($this->dinner_provider),
            json_encode($this->dinner_location)
        );
        runQuery($sql);
    }

}