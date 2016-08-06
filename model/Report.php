<?php

/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/23/2016
 * Time: 5:13 PM
 */
include_once '../util/dbManager.php';

class Report
{
    public $id;
    public $name;
    public $type;
    public $query;

    /**
     * Report constructor.
     * @param $id
     * @param $name
     * @param $type
     * @param $query
     */
    public function __construct($id, $name, $type, $query)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->query = $query;
    }

    public static function initReport()
    {
        initDbBySQLFile("../sql/report.sql");
    }

    public static function loadById($id)
    {
        $sql = sprintf("select * from report where id = '%s'", $id);


        $result = runSingleSelect($sql);
        return new Report($result->id, $result->name, $result->type, $result->query);
    }

    public static function getMaxId()
    {
        $sql = "select * from report";

        return runCount($sql);
    }
}