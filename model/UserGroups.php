<?php

/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/17/2016
 * Time: 9:45 PM
 */

include_once '../util/dbManager.php';
include_once '../util/logger.php';

class UserGroups
{
    public $id;
    public $name;
    public $title;

    public static function getAll(){
        $sql = "select id, name, title from user_groups";

        return runSelect($sql);
    }

    public function loadById(){
        $sql = sprintf("select id, name, title from user_groups where id = '%s'" , $this->id);

        return runSelect($sql);
    }

    public static function findById($id){
        $sql = sprintf("select id, name, title from user_groups where id = '%s'" , $id);

        return runSelect($sql);
    }

    public static function initUserGroups(){
        initDbBySQLFile("../sql/user_groups.sql");
    }

}