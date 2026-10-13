<?php

namespace app\controller;

use app\model\CategoryModel;
use app\model\PopularModel;
use support\Request;
use JasonGrimes\Paginator;

class Category {
    
    protected $mcat;

    public function __construct() {
        $this->mcat = new CategoryModel();
    }

    public function index(Request $request, $slug, $page = 1) {
        $data = $request->data;
        $data['request'] = $request;
        $data['ads'] = $data['mads'];
        $data['mpop'] = new PopularModel();
        $data['mpop']->daily();
        $data['cat_name'] = strtoupper($slug);
        $data['cat_slug'] = $slug;
        $page = is_numeric($page) ? $page : null;
        $limit = 12;
        if($slug == 'bobotoh' || $slug == 'catatan-balad-bobotoh') {
            $data['categories'] = $data['mhome']->getLatestCatParent('bobotoh', $limit, null, null, null, $page);
        } else {
            $data['categories'] = $data['mhome']->getLatestCat($slug, $limit, null, null, null, $page);
        }
        $data['latest'] = $data['mhome']->getLatestCat('', 7);
        $data['total']  = $data['mhome']->getLatestTotal($slug);
        $url_pattern = "/category/".$slug."/(:num)";
        $data['paginator'] = new Paginator($data['total'], $limit, $page, $url_pattern);
        return view('category_view', $data);
    }
}
