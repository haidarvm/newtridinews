<?php

namespace app\controller;

use app\model\SingleModel;
use support\Request;

class Page {
    protected $msingle;

    public function __construct() {
        $this->msingle = new SingleModel();
    }

    public function index(Request $request, $slug) {
        $data['request'] = $request;
        // $data['latest'] = $this->mhome->getLatestCat("",7);
        $data['read'] = $this->msingle->read(null, $slug);
        $data['title'] = $data['read']->post_title;
        $data['metaDescription'] = metaDescription($data['read']->post_content);
        $data['imgMid'] = $data['read']->img_mid;
        return view('page_view', $data);
    }

    public function check(Request $request, $id) {
        return json($this->msingle->read($id));
    }
}