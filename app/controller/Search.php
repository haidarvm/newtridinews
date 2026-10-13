<?php

namespace app\controller;

use support\Request;
use JasonGrimes\Paginator;

class Search {
    public $mhome;
    protected $mpop;
    protected $mads;

    public function __construct() {
    }

    public function index(Request $request, $search, $page = 1) {
        $data = $request->data;
        $data['request'] = $request;
        $data['ads'] = $data['mads'];
        $search = cleanSearch($search);
        $data['search_name'] = $search;
        $limit = 12;
        $data['searching'] = $data['mhome']->getLatestCat(null, $limit, null, $search, null, $page);
        $data['latest'] = $data['mhome']->getLatestCat('', 7);
        $data['total']  = $data['mhome']->getLatestTotal(null, null, $search);
        $url_pattern = "/search/".$search."/(:num)";
        $data['paginator'] = new Paginator($data['total'], $limit, $page, $url_pattern);
        return view('search_view', $data);
    }

    public function post(Request $request) {
        $post = $request->post();
        return redirect('/search/' . nullSearch(urlSearch($post['search'])));
    }
    
}
