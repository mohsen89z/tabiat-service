<?php

/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/19/2016
 * Time: 9:53 PM
 */
class UserInfo
{
    public $id;
    public $status;
    public $black_list;
    public $sexuality;
    public $name;
    public $surename;
    public $father_name;
    public $birthdate;
    public $nationality;
    public $national_code;
    public $national_id;
    public $passport_number;
    public $married;
    public $marriage_date;
    public $introduction;
    public $refrence;
    public $description;
    public $blood_type;
    public $illness;
    public $nativ_lnag;
    public $first_lang;
    public $sec_lang;
    public $edu_level;
    public $edu_field;
    public $job_loc;
    public $job_desc;
    public $creatio;

    /**
     * UserInfo constructor.
     * @param $id
     * @param $status
     * @param $black_list
     * @param $sexuality
     * @param $name
     * @param $surename
     * @param $father_name
     * @param $birthdate
     * @param $nationality
     * @param $national_code
     * @param $national_id
     * @param $passport_number
     * @param $married
     * @param $marriage_date
     * @param $introduction
     * @param $refrence
     * @param $description
     * @param $blood_type
     * @param $illness
     * @param $nativ_lnag
     * @param $first_lang
     * @param $sec_lang
     * @param $edu_level
     * @param $edu_field
     * @param $job_loc
     * @param $job_desc
     */
    public static function withMoreData($id, $status, $black_list, $sexuality, $name, $surename, $father_name, $birthdate, $nationality, $national_code, $national_id, $passport_number, $married, $marriage_date, $introduction, $refrence, $description, $blood_type, $illness, $nativ_lnag, $first_lang, $sec_lang, $edu_level, $edu_field, $job_loc, $job_desc)
    {
        $instance = new UserInfo($id);
        $instance->status = $status;
        $instance->black_list = $black_list;
        $instance->sexuality = $sexuality;
        $instance->name = $name;
        $instance->surename = $surename;
        $instance->father_name = $father_name;
        $instance->birthdate = $birthdate;
        $instance->nationality = $nationality;
        $instance->national_code = $national_code;
        $instance->national_id = $national_id;
        $instance->passport_number = $passport_number;
        $instance->married = $married;
        $instance->marriage_date = $marriage_date;
        $instance->introduction = $introduction;
        $instance->refrence = $refrence;
        $instance->description = $description;
        $instance->blood_type = $blood_type;
        $instance->illness = $illness;
        $instance->nativ_lnag = $nativ_lnag;
        $instance->first_lang = $first_lang;
        $instance->sec_lang = $sec_lang;
        $instance->edu_level = $edu_level;
        $instance->edu_field = $edu_field;
        $instance->job_loc = $job_loc;
        $instance->job_desc = $job_desc;

        return $instance;
    }

    /**
     * UserInfo constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function save()
    {
        $sql = sprintf("INSERT INTO user_info (
                      id, status, black_list, sexuality,
                      name, surename, father_name, birthdate,
                      nationality, national_code, national_id,
                      passport_number, married, marriage_date,
                      introduction, refrence, description,
                      blood_type, illness, nativ_lnag, first_lang,
                      sec_lang, edu_level, edu_field, job_loc, job_desc)
              VALUES ('%s', '%s', '%s', '%s',
                      '%s', '%s', '%s', '%s',
                      '%s', '%s', '%s',
                      '%s', '%s', '%s',
                      '%s', '%s', '%s',
                      '%s', '%s', '%s', '%s',
                      '%s', '%s', '%s', '%s', '%s')
              ON DUPLICATE KEY UPDATE
                      id = '%s', status = '%s', black_list = '%s', sexuality = '%s',
                      name = '%s', surename = '%s', father_name = '%s', birthdate = '%s',
                      nationality = '%s', national_code = '%s', national_id = '%s',
                      passport_number = '%s', married = '%s', marriage_date = '%s',
                      introduction = '%s', refrence = '%s', description = '%s',
                      blood_type = '%s', illness = '%s', nativ_lnag = '%s', first_lang = '%s',
                      sec_lang = '%s', edu_level = '%s', edu_field = '%s', job_loc = '%s', job_desc = '%s'",
            $this->id, $this->status, $this->black_list, $this->sexuality,
            $this->name, $this->surename, $this->father_name, $this->birthdate,
            $this->nationality, $this->national_code, $this->national_id,
            $this->passport_number, $this->married, $this->marriage_date,
            $this->introduction, $this->refrence, $this->description,
            $this->blood_type, $this->illness, $this->nativ_lnag, $this->first_lang,
            $this->sec_lang, $this->edu_level, $this->edu_field, $this->job_loc, $this->job_desc,
            $this->id, $this->status, $this->black_list, $this->sexuality,
            $this->name, $this->surename, $this->father_name, $this->birthdate,
            $this->nationality, $this->national_code, $this->national_id,
            $this->passport_number, $this->married, $this->marriage_date,
            $this->introduction, $this->refrence, $this->description,
            $this->blood_type, $this->illness, $this->nativ_lnag, $this->first_lang,
            $this->sec_lang, $this->edu_level, $this->edu_field, $this->job_loc, $this->job_desc
        );

        runQuery($sql);
    }

    public static function loadById($id)
    {
        $sql = sprintf("select * from user_info where id = '%s'", $id);

        return runSingleSelect($sql);
    }

    public static function initUserInfos()
    {
        initDbBySQLFile("../sql/user_info.sql");
    }

    public static function getMaxId()
    {
        $sql = "select * from user_info";

        return runCount($sql);
    }
}