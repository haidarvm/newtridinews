<?php

namespace app\controller;

use app\model\TagModel;
use support\Request;
use JasonGrimes\Paginator;

class Tag {
    public $mtag;

    public function __construct() {
        $this->mtag = new TagModel();
    }

    public function index(Request $request, $slug, $page = 1) {
        $data = $request->data;
        $data['request'] = $request;
        $data['mpop']->daily();
        $data['ads'] = $data['mads'];
        $data['tag_name'] = strtoupper($slug);
        $data['tag_slug'] = $slug;
        $dec_tag = urldecode($slug);
        $slug_tag = str_slug($dec_tag);
        $page = is_numeric($page) ? $page : null;
        $limit = 100;
        $data['tags'] = $this->mtag->getAll($dec_tag, $limit, null, null, null, $page);
        $data['latest'] = $data['mhome']->getLatestCat('', 7);
        $data['total']  = $this->mtag->getTotal($slug);
        $url_pattern = "/tag/".$slug."/(:num)";
        $data['paginator'] = new Paginator($data['total'], $limit, $page, $url_pattern);
        return view('tag_view', $data);
    }
}
