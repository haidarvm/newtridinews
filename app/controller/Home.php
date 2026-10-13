<?php

namespace app\controller;

use support\Request;
use app\model\ApiModel;
use app\model\PopularModel;

class Home {

    public function index(Request $request) {
        $data = $request->data;
        $data['latest'] = 'latest';
        $data['request'] = $request;
        $data['ads'] = $data['mads'];
        // $data['mpop']->daily();
        $data['headlines'] = $data['mhome']->getLatestHeadline(3);
        $data['latest'] = $data['mhome']->getLatestHome(null, 20);
        $data['videos'] = $data['mhome']->getLatestCat('video', 4);
        return view('home_view', $data);
    }
 
    public function ads(Request $request, $id) {
        $data = $request->data;
        // $data['latest'] = $data['mhome']->getLatestHome(null,20);
        $data['ads'] = $data['mads'];
        $data['ad'] = $data['mads']->getAds($id);
        $url = $data['ad']->url;
        // print_r($data['ad']);
        $data['mads']->totalViewAds($id);
        // get id
        // return $id;
        // echo $url;
        return redirect($url);
        // redirect to
    }


}
