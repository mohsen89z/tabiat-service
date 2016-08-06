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
        $price_decs, $contract_type, $start_order, $end_order, $invis_cmt)
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
    }

    public function save()
    {
        $sql = "INSERT INTO trip (id, name, status, opr_stat, trip_type,
                          province_id, description, adminstartor_cmt,
                          start_date, end_date, departure_place, departure_time,
                          attractions, opr_type, experties_level, requiremnt_course,
                          requirment_stuff, capacity, pric_type, price, wage,
                          price_decs, contract_type, start_order, end_order, invis_cmt
                      )
                      VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',
                          '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
                      ON DUPLICATE KEY UPDATE
                          id = '%s', name = '%s', status = '%s', opr_stat = '%s', trip_type = '%s',
                          province_id = '%s', description = '%s', adminstartor_cmt = '%s',
                          start_date = '%s', end_date = '%s', departure_place = '%s', departure_time = '%s',
                          attractions = '%s', opr_type = '%s', experties_level = '%s', requiremnt_course = '%s',
                          requirment_stuff = '%s', capacity = '%s', pric_type = '%s', price = '%s', wage = '%s',
                          price_decs = '%s', contract_type = '%s', start_order = '%s', end_order = '%s', invis_cmt = '%s'";

        $sql = sprintf($sql,
            $this->id, $this->name, $this->status, $this->opr_stat, $this->trip_type,
            $this->province_id, $this->description, $this->adminstartor_cmt,
            $this->start_date, $this->end_date, $this->departure_place, $this->departure_time,
            $this->attractions, $this->opr_type, $this->experties_level, $this->requiremnt_course,
            $this->requirment_stuff, $this->capacity, $this->pric_type, $this->price, $this->wage,
            $this->price_decs, $this->contract_type, $this->start_order, $this->end_order, $this->invis_cmt,
            $this->id, $this->name, $this->status, $this->opr_stat, $this->trip_type,
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

    public static function getMaxId(){
        $sql = "select * from trip";

        return runCount($sql);
    }
}

function getAllTrips()
{
    $sql = "select id, name, status, description from trip";

    return runSelect($sql);
}

?>

