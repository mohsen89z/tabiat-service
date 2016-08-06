<?php

/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/6/2016
 * Time: 3:32 PM
 */
include_once '../util/dbManager.php';
include_once '../util/logger.php';

class User
{
    public $id;
    public $username;
    public $password;
    public $group_id;
    public $info_id;

    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $password
     * @param $group_id
     * @param $info_id
     */
    public function __construct($id, $username, $password, $group_id)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->group_id = $group_id;
    }

    public function save()
    {
        $sql = sprintf("INSERT INTO users (id, username, password, group_id)
              VALUES ('%s', '%s', '%s', '%s')
              ON DUPLICATE KEY UPDATE
              id = '%s', username = '%s', password = '%s', group_id = '%s'",
            $this->id,
            $this->username,
            $this->password,
            $this->group_id,
            $this->id,
            $this->username,
            $this->password,
            $this->group_id
        );

        runQuery($sql);
    }

    public function updateUserInfo()
    {
        $sql = sprintf("update users set info_id = '%s' where id = '%s'",
            $this->info_id,
            $this->id
        );

        runQuery($sql);
    }


    public static function getAll()
    {
        $sql = "select id, username, password, group_id, info_id from users";

        return runSelect($sql);
    }

    public static function loadById($id)
    {
        $sql = sprintf("select * from users where id = '%s'", $id);

        return runSingleSelect($sql);
    }

    public static function initUsers()
    {
        initDbBySQLFile("../sql/users.sql");
    }

    public static function getMaxId()
    {
        $sql = "select * from users";

        return runCount($sql);
    }
}

?>