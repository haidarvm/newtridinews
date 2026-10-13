<?php

namespace app\model;

use support\Model;

class ApiModel extends Model {
    protected $table = 'latest_api';

    protected $primaryKey = 'ID';
    protected $mcat;

    public $timestamps = false;

    public function insertLatest($data) {
        $this->insertGetId($data);
    }

    public function truncateData() {
        $this->truncate();
    }

    public function truncateDataApi() {
        $this->from("api")->truncate();
    }

    public function insertApi($data) {
        $api['title'] = 'klasmen';
        $api['content'] = $data;
        $this->truncateDataApi();
        $this->from('api')->insertGetId($api);
    }
}