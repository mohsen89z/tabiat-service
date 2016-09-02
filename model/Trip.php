<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/6/2016
 * Time: 10:56 AM
 */

include_once '../util/dbManager.php';
include_once '../util/logger.php';

function initTrip()
{
    initDbBySQLFile("../sql/trip.sql");
}

class Trip
{
    public $id;
    public $name;
    public $status;
    public $is_special;
    public $opr_stat;
    public $trip_type;
    public $province_id;
    public $duration;
    public $description;
    public $adminstartor_cmt;
    public $start_date;
    public $end_date;
    public $departure_place;
    public $departure_time;
    public $attractions;
    public $opr_type;
    public $experties_level;
    public $requiremnt_course;
    public $requirment_stuff;
    public $capacity;
    public $pric_type;
    public $price;
    public $wage;
    public $price_decs;
    public $contract_type;
    public $contract_genral;
    public $start_order;
    public $end_order;
    public $invis_cmt;

    /**
     * Trip constructor.
     * @param $name
     * @param $id
     * @param $status
     * @param $description
     */
    public function __construct(
        $id, $name, $status, $opr_stat, $trip_type,
        $province_id, $description, $adminstartor_cmt,
        $start_date, $end_date, $departure_place, $departure_time,
        $attractions, $opr_type, $experties_level, $requiremnt_course,
        $requirment_stuff, $capacity, $pric_type, $price, $wage,
        $price_decs, $contract_type, $start_order, $end_order, $invis_cmt , $trip_spec)
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->opr_stat = $opr_stat;
        $this->trip_type = $trip_type;

        $this->province_id = $province_id;
        $this->description = $description;
        $this->adminstartor_cmt = $adminstartor_cmt;

        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->departure_place = $departure_place;
        $this->departure_time = $departure_time;

        $this->attractions = $attractions;
        $this->opr_type = $opr_type;
        $this->experties_level = $experties_level;
        $this->requiremnt_course = $requiremnt_course;

        $this->requirment_stuff = $requirment_stuff;
        $this->capacity = $capacity;
        $this->pric_type = $pric_type;
        $this->price = $price;
        $this->wage = $wage;

        $this->price_decs = $price_decs;
        $this->contract_type = $contract_type;
        $this->start_order = $start_order;
        $this->end_order = $end_order;
        $this->invis_cmt = $invis_cmt;


        logTabiat("before ts" . $start_date . " and " . $end_date);
        $pieces = explode("/", $start_date);

        $ts1 = $pieces[1]."/".$pieces[0]."/".$pieces[2];
        $pieces = explode("/", $end_date);
        $ts2 =  $pieces[1]."/".$pieces[0]."/".$pieces[2];
        $ts1 = strtotime($ts1);
        $ts2 = strtotime($ts2);
        logTabiat("after ts" .$ts1 . $ts2);
        $this->duration = ($ts2 - $ts1) /3600 /24 + 1;
        logTabiat("after this");
        logTabiat($this->duration);

        $this->trip_spec = $trip_spec;
    }

    public function save()
    {
        $sql = "INSERT INTO trip (id, name, status, is_special, opr_stat, trip_type,
                          province_id, description, adminstartor_cmt,
                          start_date, end_date, departure_place, departure_time,
                          attractions, opr_type, experties_level, requiremnt_course,
                          requirment_stuff, capacity, pric_type, price, wage,
                          price_decs, contract_type, start_order, end_order, invis_cmt
                      )
                      VALUES ('%s', '%s', '%s', '%s', '%s','%s', '%s', '%s', '%s', '%s', '%s', '%s',
                          '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
                      ON DUPLICATE KEY UPDATE
                          id = '%s', name = '%s', status = '%s',is_special = '%s', opr_stat = '%s', trip_type = '%s',
                          province_id = '%s', description = '%s', adminstartor_cmt = '%s',
                          start_date = '%s', end_date = '%s', departure_place = '%s', departure_time = '%s',
                          attractions = '%s', opr_type = '%s', experties_level = '%s', requiremnt_course = '%s',
                          requirment_stuff = '%s', capacity = '%s', pric_type = '%s', price = '%s', wage = '%s',
                          price_decs = '%s', contract_type = '%s', start_order = '%s', end_order = '%s', invis_cmt = '%s'";

        $sql = sprintf($sql,
            $this->id, $this->name, $this->status, $this->is_special ,$this->opr_stat, $this->trip_type,
            $this->province_id, $this->description, $this->adminstartor_cmt,
            $this->start_date, $this->end_date, $this->departure_place, $this->departure_time,
            $this->attractions, $this->opr_type, $this->experties_level, $this->requiremnt_course,
            $this->requirment_stuff, $this->capacity, $this->pric_type, $this->price, $this->wage,
            $this->price_decs, $this->contract_type, $this->start_order, $this->end_order, $this->invis_cmt,
            $this->id, $this->name, $this->status, $this->is_special, $this->opr_stat, $this->trip_type,
            $this->province_id, $this->description, $this->adminstartor_cmt,
            $this->start_date, $this->end_date, $this->departure_place, $this->departure_time,
            $this->attractions, $this->opr_type, $this->experties_level, $this->requiremnt_course,
            $this->requirment_stuff, $this->capacity, $this->pric_type, $this->price, $this->wage,
            $this->price_decs, $this->contract_type, $this->start_order, $this->end_order, $this->invis_cmt);

        runQuery($sql);
    }

    public static function loadById($id)
    {
        $sql = sprintf("select * from trip where id = '%s'", $id);

        return runSingleSelect($sql);
    }

    public static function getMaxId()
    {
        $sql = "select * from trip";

        return runCount($sql);
    }

    public static function get6Trips()
    {
        $sql = "select * from trip limit 6";

        $raws = runSelect($sql);

        $specials = array();
        foreach($raws as $raw){
            array_push($specials, new Trip($raw->id, $raw->name, $raw->status, $raw->opr-stat, $raw->trip_type, $raw->province_id, $raw->description, $raw->adminstartor_cmt,
                    $raw->start_date, $raw->end_date, $raw->departure_place, $raw->departure_time,
                    $raw->attractions, $raw->opr_type, $raw->experties_level, $raw->requiremnt_course,
                    $raw->requirment_stuff, $raw->capacity, $raw->pric_type, $raw->price, $raw->wage,
                    $raw->price_decs, $raw->contract_type, $raw->start_order, $raw->end_order, $raw->invis_cmt,
                    $raw->id, $raw->name, $raw->status, $raw->opr_stat, $raw->trip_type,
                    $raw->province_id, $raw->description, $raw->adminstartor_cmt,
                    $raw->start_date, $raw->end_date, $raw->departure_place, $raw->departure_time,
                    $raw->attractions, $raw->opr_type, $raw->experties_level, $raw->requiremnt_course,
                    $raw->requirment_stuff, $raw->capacity, $raw->pric_type, $raw->price, $raw->wage,
                    $raw->price_decs, $raw->contract_type, $raw->start_order, $raw->end_order, $raw->invis_cmt));
        }

        return $specials;
    }

    public static function getTripList()
    {
        $sql = "select * from trip";

        $raws = runSelect($sql);

        $specials = array();
        foreach($raws as $raw){
            array_push($specials, new Trip($raw->id, $raw->name, $raw->status, $raw->opr-stat, $raw->trip_type, $raw->province_id, $raw->description, $raw->adminstartor_cmt,
                    $raw->start_date, $raw->end_date, $raw->departure_place, $raw->departure_time,
                    $raw->attractions, $raw->opr_type, $raw->experties_level, $raw->requiremnt_course,
                    $raw->requirment_stuff, $raw->capacity, $raw->pric_type, $raw->price, $raw->wage,
                    $raw->price_decs, $raw->contract_type, $raw->start_order, $raw->end_order, $raw->invis_cmt,
                    $raw->id, $raw->name, $raw->status, $raw->opr_stat, $raw->trip_type,
                    $raw->province_id, $raw->description, $raw->adminstartor_cmt,
                    $raw->start_date, $raw->end_date, $raw->departure_place, $raw->departure_time,
                    $raw->attractions, $raw->opr_type, $raw->experties_level, $raw->requiremnt_course,
                    $raw->requirment_stuff, $raw->capacity, $raw->pric_type, $raw->price, $raw->wage,
                    $raw->price_decs, $raw->contract_type, $raw->start_order, $raw->end_order, $raw->invis_cmt));
        }

        return $specials;
    }

}

function getAllTrips()
{
    $sql = "select id, name, status, description from trip";

    return runSelect($sql);
}

function getAllSpecialTrips()
{
    $sql = "select id, name, status, description from trip where is_special = 224";

    return runSelect($sql);
}

function getAllUsersOfTrip($tripId)
{
    $sql = sprintf("select * from users where id in (select user_id from user_trip where trip_id = '%s')", $tripId);

    return runSelect($sql);
}

?>

