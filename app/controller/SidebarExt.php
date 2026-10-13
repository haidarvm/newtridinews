<?php

namespace app\controller;

use app\model\HomeModel;
use app\model\PopularModel;
use app\model\AdsModelPublic;
use Illuminate\Redis\RedisManager;
use support\Container;

class SidebarExt {
    public $data = [];
    protected $redis;

    public function __construct() {
        // $mpop = new PopularModel();
        $mhome = new HomeModel();
        $mads = new AdsModelPublic();

        // $this->data['mpop'] = $mpop;
        $this->data['mhome'] = $mhome;
        $redis = Container::get('redis');
        $redis->set('mads', json_encode($mads->getAds(1)));
        $this->data['mads'] = json_decode($redis->get('mads'));
        // print_r($mads->getAds(1));
        print_r(json_decode($redis->get('mads')));
        // return response(Redis::get($key));
        // $this->data['populars'] = $mpop->getPopular();
        // $this->data['bobotohs'] = $mhome->getLatestCat('bobotoh', 5);
        // $this->data['bolnass'] = $mhome->getLatestCat('bolnas', 5);
        // $this->data['ragams'] = $mhome->getLatestCat('ragam', 5);
        // $this->data['terass'] = $mhome->getLatestApiDb();
    }
}
