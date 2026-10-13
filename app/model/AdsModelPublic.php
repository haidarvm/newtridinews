<?php

namespace app\model;

use support\Model;

class AdsModelPublic extends Model {

    protected $table = 'ads';

    protected $primaryKey = 'ads_id';

    public $timestamps = true;

    public function getAllAds() {
        return $this->orderBy('ads_id', 'asc')->get();
    }

    public function getAds($id) {
        return $this->where('ads_id', $id)->first();
    }

    public function totalViewAds($id) {
        $this->where(['ads_id' => $id])->increment('total_pageviews', 1);
    }

}