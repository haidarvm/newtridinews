<?php

namespace app\admin\model;

use support\Model;

class AdsModel extends Model {

    protected $table = 'ads';

    protected $primaryKey = 'ads_id';

    public $timestamps = false;

    public function getAllAds() {
        return $this->orderBy('status', 'desc')->get();
    }

    public function getAds($id) {
        return $this->where('ads_id', $id)->first();
    }

    public function saveAds($data) {
        $data_ads = [
            'title' => $data['title'],
            'url' => $data['url'],
            'status' => $data['status'],
        ];
        $ads_id = $data['ads_id'];
        $this->where('ads_id', $ads_id)->update($data_ads);
    }

    public function updateImg($data, $id) {
        unset($data['ads_id']);
        return $this->where('ads_id', $id)->update($data);
    }
}