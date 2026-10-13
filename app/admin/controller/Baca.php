<?php

namespace app\admin\controller;

use app\admin\model\BacaModel;
use app\admin\model\UserModel;

use support\Request;
use JasonGrimes\Paginator;

class Baca {
    protected $mbaca;
    protected $muser;

    public function __construct() {
        $this->mbaca = new BacaModel();
        $this->muser = new UserModel();
    }

    public function index(Request $request, $page, $limit=null, $search = null) {
        // $data['request'] = $request;
        // $limit =100;
        $data['items'] = $this->mbaca->getTitle($page, $limit, $search);
        // print_r($data['items']);
        return json($data);
    }

    public function all(Request $request, $daterange=null, $search=null, $author=null, $page=1) {
        $data['title'] = 'Admin Posts';
        $data['author'] = $author;
        $data['search'] = $search;
        $data['daterange'] = $daterange;
        $limit = 200;
        $data['page'] = $page;
        $daterange =  'all' != $daterange ? $daterange : null;
        $search = 'all' != $search ? cleanSearch($search) : null;
        $author = 'all' != $author ? $author : null;
        $data['latest'] = $this->mbaca->getTitle($page, $limit, $search);
        $data['request'] = $request;
        $data['authors'] = $this->muser->getAllUser();
        $url_pattern = '/admin/posts/gallery/' . nullSearch($daterange) . '/' . nullSearch($search) . '/(:num)';
        $data['total'] = $this->mbaca->getTitleTotal($search);
        $data['paginator'] = new Paginator($data['total'], $limit, $page, $url_pattern);
        return view('baca', $data);
    }
}