<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/23/2016
 * Time: 5:17 PM
 */

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

include_once '../model/Report.php';

Report::initReport();

if (empty($_GET["id"])) {
    exit(-1);
} else {
    $id = $_GET["id"];

    $report = Report::loadById($id);

    $reportResult = new ReportResult($report->name, $report->type , runSelectJson($report->query));

    echo str_replace("cnt", "value", $reportResult->toJson());
}
?>