<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/23/2016
 * Time: 7:04 PM
 */

include_once '../model/Report.php';


class ReportResult {
    public $name;
    public $type;
    public $result;

    /**
     * ReportResult constructor.
     * @param $name
     * @param $type
     * @param $result
     */
    public function __construct($name, $type, $result)
    {
        $this->name = $name;
        $this->type = $type;
        $this->result = $result;
    }

    public function toJson(){
        return json_encode($this);
    }
}

class Result{
    public $cnt;
    public $reports;

    /**
     * Result constructor.
     * @param $cnt
     */
    public function __construct($cnt)
    {
        $this->cnt = $cnt;
        $this->reports = array();
    }

    public function toJson(){
        return json_encode($this);
    }
}

$result = new Result(Report::getMaxId());

for($i = 1; $i < $result->cnt; $i++){
    $report = Report::loadById($i);

    $reportResult = new ReportResult($report->name, $report->type , runSelectJson($report->query));


    array_push($result->reports, $reportResult);
}

echo $result->toJson();
?>