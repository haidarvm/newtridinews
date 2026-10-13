<?php

namespace app\controller;

use app\model\SingleModel;
use app\model\PopularModel;
use support\Request;

class Read {
    protected $msingle;

    public function __construct() {
        $this->msingle = new SingleModel();
    }

    public function single($request, $read) {
        if (!empty($read->ID)) {
            $data = $this->defread($request, $read);
            $data['ads'] = $data['mads'];
            // $data['latest'] = $data['mhome']->getLatestCat('', 3);
            checkCatId($read->cat_id, 619) ? $data['photos'] = $this->msingle->getPhotos($read->ID) : "";
            return empty($data['photos']) ? view('read_view', $data) : view("photo_view", $data);
        } else {
            return redirect('/');
        }
    }

    protected function defread($request, $read) {
        $data = $request->data;
        $data['mpop'] = new PopularModel();
        $data['mpop']->daily();
        $data['request'] = $request;
        $data['read'] = $read;
        $data['id'] = $read->ID;
        $page = $request->get("page") ?: 1 ;
        $data['content'] = $read->post_content;
        $data['title'] = $read->post_title;
        $data['author'] = $read->display_name;
        $data['video'] = checkCatId($read->cat_id, 89) ? $this->msingle->getVid($read->ID) : false;
        $data['metaDescription'] = !empty($read->description) ? $read->description : metaDescription($read->post_content);
        $data['imgMid'] = $read->img_mid;
        $data['url'] = readUrl($read->post_date, $read->post_title);
        $data['image'] = imgBasePathUrl($read->img_mid);
        $data['image_thumb'] = imgBasePathUrl($read->img_thumb);
        $data['total_pageviews'] = $data['mpop']->updatePopularPosts($read->ID);
        $data['postBefore'] = $this->msingle->getPost($read->ID, '<');
        $data['postAfter'] = $this->msingle->getPost($read->ID, '>');
        $data['keywords'] = $this->msingle->getAllKeyword($read->ID);
        return $data;
    }

    public function index(Request $request, $id) {
        return $this->single($request, $this->msingle->read($id));
    }

    public function year(Request $request, $year) {
        return $year;
    }

    public function slug(Request $request, $slug) {
        return $this->single($request, $this->msingle->read(null, $slug));
    }

    public function date_slug(Request $request, $year, $month, $date, $slug) {
        return $this->single($request, $this->msingle->read(null, $slug));
    }

    public function date_slug_amp(Request $request, $year, $month, $date, $slug) {
        $read = $this->msingle->read(null, $slug);
        if (!empty($read->ID)) {
            $data = $this->defread($request, $read);
            $data['latest'] = $data['mhome']->getLatestCat('', 5);
            return view('read_amp', $data);
        } else {
            return redirect('/');
        }
    }

    public function amp_slug(Request $request, $slug) {
        $read = $this->msingle->read(null, $slug);
        if (!empty($read->ID)) {
            $data = $this->defread($request, $read);
            $data['latest'] = $data['mhome']->getLatestCat('', 5);
            return view('read_amp', $data);
        } else {
            return redirect('/');
        }
    }

    public function check(Request $request, $id) {
        return json($this->msingle->read($id));
    }
}
