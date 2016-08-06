<?php

/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/7/2016
 * Time: 10:07 PM
 */

include_once "../util/dbManager.php";

class Constant
{
    public $id;
    public $name;
    public $classifier;

    public static function loadById($id){
        $sql = sprintf("select id, name, classifier from constant where id = '%s'", $id);

        return runSingleSelect($sql);
    }

    public static function getAllByType($type){
        $sql = sprintf("select id, name from constant where classifier ='%s'", $type);

        return runSelect($sql);
    }
}

function initConstants(){
    initDbBySQLFile("../sql/constant.sql");
}

