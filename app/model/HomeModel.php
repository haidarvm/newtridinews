<?php

namespace app\model;

use support\Model;
use app\model\CategoryModel;

class HomeModel extends Model
{
    protected $table = 'posts';

    protected $primaryKey = 'ID';
    protected $mcat;

    public $timestamps = false;
    // const UPDATED_AT = 'last_login';

    public function __construct() {
        $this->mcat = new CategoryModel();
    }

    public function read($id) {
        return $this->where(['ID' => $id])->first();
    }

    public function latest($limit) {
        return $this->orderBy('post_date', 'DESC')->limit($limit)->get();
    }

    public function getLatestCat($category = null, $limit = 6, $date = null, $search = null, $author = null, $page = null) {
        $page_limit = !empty($page) ? ($page - 1) * $limit : '';
        $slug = !empty($category) ? $this->mcat->getCatBySlug($category) : '';
        $category_id = !empty($slug) ? $slug->category_id : null;
        $where[] = ['post_status' => 'publish', 'post_type' => 'post'];
        !empty($category_id) ? $where[] = ['c.category_id' => $category_id] : '';
        !empty($author) ? $where[] = ['post_author' => $author] : '';
        $clean_where = array_reduce($where, 'array_merge', []);
        $data = $this->select('ca.category_name as cat_name', 'p.ID as ID', 'post_title', 'post_date', 'post_author', 'img_thumb',  'img_mid', 'display_name')
        ->from('posts AS p')
        ->leftJoin('users AS u', 'u.ID', '=', 'p.post_author')
        ->leftJoin('list_category AS c', 'c.post_id', '=', 'p.ID')
        ->leftJoin('category AS ca', 'ca.category_id', '=', 'c.category_id')
        ->leftJoin('image_featured AS f', 'p.ID', '=', 'f.post_id')
        ->leftJoin('reporter AS r', 'p.reporter_id', '=', 'r.reporter_id')
        ->where($clean_where)
        ->groupBy('p.ID')
        ->orderByDesc('post_date')
        ->limit($limit);
        $data = !empty($search) ? $data->where('post_content', 'like', '%' . $search . '%')->orWhere('post_title', 'like', '%' . $search . '%') : $data;
        $data = !empty($date) ? $data->whereDate('post_date', $date) : $data;
        return !empty($page) ? $data->offset($page_limit)->get() : $data->get();
    }

    public function getLatestCatParent($category = null, $limit = 6, $date = null, $search = null, $author = null, $page = null) {
        $page_limit = !empty($page) ? ($page - 1) * $limit : '';
        $slug = !empty($category) ? $this->mcat->getCatBySlug($category) : '';
        $category_id = !empty($slug) ? $slug->category_id : null;
        $where[] = ['post_status' => 'publish', 'post_type' => 'post'];
        !empty($category_id) ? $where[] = ['ca.parent_id' => $category_id] : '';
        !empty($author) ? $where[] = ['post_author' => $author] : '';
        $clean_where = array_reduce($where, 'array_merge', []);
        $data = $this->select('ca.category_name as cat_name', 'p.ID as ID', 'post_title', 'post_date', 'post_author', 'img_thumb',  'img_mid', 'display_name')
        ->from('posts AS p')
        ->leftJoin('users AS u', 'u.ID', '=', 'p.post_author')
        ->leftJoin('list_category AS c', 'c.post_id', '=', 'p.ID')
        ->leftJoin('category AS ca', 'ca.category_id', '=', 'c.category_id')
        ->leftJoin('image_featured AS f', 'p.ID', '=', 'f.post_id')
        ->leftJoin('reporter AS r', 'p.reporter_id', '=', 'r.reporter_id')
        ->where($clean_where)
        ->groupBy('p.ID')
        ->orderByDesc('post_date')
        ->limit($limit);
        $data = !empty($search) ? $data->where('post_content', 'like', '%' . $search . '%')->orWhere('post_title', 'like', '%' . $search . '%') : $data;
        $data = !empty($date) ? $data->whereDate('post_date', $date) : $data;
        return !empty($page) ? $data->offset($page_limit)->get() : $data->get();
    }

    public function getLatestHome($category = null, $limit = 6, $date = null, $search = null, $author = null, $page = null) {
        $page_limit = !empty($page) ? ($page - 1) * $limit : '';
        $slug = !empty($category) ? $this->mcat->getCatBySlug($category) : '';
        $category_id = !empty($slug) ? $slug->category_id : null;
        $where[] = ['post_status' => 'publish', 'post_type' => 'post'];
        !empty($category_id) ? $where[] = ['c.category_id' => $category_id] : '';
        !empty($author) ? $where[] = ['post_author' => $author] : '';
        $clean_where = array_reduce($where, 'array_merge', []);
        $data = $this->select('ca.category_name as cat_name', 'p.ID as ID', 'post_title', 'post_date', 'post_author', 'img_thumb', 'display_name')
        ->from('posts AS p')
        ->leftJoin('users AS u', 'u.ID', '=', 'p.post_author')
        ->join('list_category AS c', 'c.post_id', '=', 'p.ID')
        ->leftJoin('category AS ca', 'ca.category_id', '=', 'c.category_id')
        ->leftJoin('image_featured AS f', 'p.ID', '=', 'f.post_id')
        ->leftJoin('reporter AS r', 'p.reporter_id', '=', 'r.reporter_id')
        ->where($clean_where)
        ->where('ca.parent_id', '<>', 613)
        ->where('c.category_id', '<>', 613)
        ->groupBy('p.ID')
        ->orderByDesc('post_date')
        ->limit($limit);
        $data = !empty($search) ? $data->where('post_content', 'like', '%' . $search . '%') : $data;
        $data = !empty($date) ? $data->whereDate('post_date', $date) : $data;
        return !empty($page) ? $data->offset($page_limit)->get() : $data->get();
    }

    public function getLatestAPI($category = null, $limit = 6, $date = null, $search = null, $author = null, $page = null, $content = null) {
        $page_limit = !empty($page) ? ($page - 1) * $limit : '';
        $slug = !empty($category) ? $this->mcat->getCatBySlug($category) : '';
        $category_id = !empty($slug) ? $slug->category_id : null;
        $where[] = ['post_status' => 'publish', 'post_type' => 'post'];
        !empty($category_id) ? $where[] = ['c.category_id' => $category_id] : '';
        !empty($author) ? $where[] = ['post_author' => $author] : '';
        $clean_where = array_reduce($where, 'array_merge', []);
        $data = $this->select('ca.category_name as cat_name', 'p.ID as ID', 'post_title', 'post_date', $this->raw('CONCAT("' . base_url() . 'assets/uploads/",  img_mid) as img'),  $this->raw('CONCAT("' . base_url() . 'assets/uploads/",  img_thumb) as thumbnail'), 'description', 'display_name', $this->raw('CONCAT("' . base_url() . '", DATE_FORMAT(post_date, "%Y/%m/%d"), "/" , post_name) as url'))
        ->from('posts AS p')
        ->leftJoin('users AS u', 'u.ID', '=', 'p.post_author')
        ->leftJoin('list_category AS c', 'c.post_id', '=', 'p.ID')
        ->leftJoin('category AS ca', 'ca.category_id', '=', 'c.category_id')
        ->leftJoin('image_featured AS f', 'p.ID', '=', 'f.post_id')
        ->leftJoin('reporter AS r', 'p.reporter_id', '=', 'r.reporter_id')
        ->where($clean_where)
        ->groupBy('p.ID')
        ->orderByDesc('post_date')
        ->limit($limit);
        !empty($content) ? $data->addSelect("post_content") : "";
        $data = !empty($search) ? $data->where('post_content', 'like', '%' . $search . '%') : $data;
        $data = !empty($date) ? $data->whereDate('post_date', $date) : $data;
        return !empty($page) ? $data->offset($page_limit)->get() : $data->get();
    }

    public function getLatestHeadline($limit) {
        $where = ['post_status' => 'publish', 'post_type' => 'post', 'headline' => 1];
        $data = $this->select('ca.category_name as cat_name', 'p.ID as ID', 'post_title', 'post_date', 'post_author',  'img_mid', 'display_name')
        ->from('posts AS p')
        ->leftJoin('users AS u', 'u.ID', '=', 'p.post_author')
        ->leftJoin('list_category AS c', 'c.post_id', '=', 'p.ID')
        ->leftJoin('category AS ca', 'ca.category_id', '=', 'c.category_id')
        ->leftJoin('image_featured AS f', 'p.ID', '=', 'f.post_id')
        ->where($where)
        ->groupBy('p.ID')
        ->orderByDesc('post_date')
        ->limit($limit);
        return  $data->get();
    }

    public function getLatestTotal($category = null, $date = null, $search = null, $author = null) {
        $where[] = ['post_type' => 'post'];
        $slug = !empty($category) ? $this->mcat->getCatBySlug($category) : '';
        $category_id = !empty($slug) ? $slug->category_id : null;
        !empty($category_id) ? $where[] = ['c.category_id' => $category_id] : '';
        !empty($author) ? $where[] = ['post_author' => $author] : '';
        $clean_where = array_reduce($where, 'array_merge', []);
        $data = $this->select($this->raw('count(DISTINCT ID) as total'))
        ->from('posts AS p')
        // ->join('users AS u', 'u.ID', '=', 'p.post_author')
        ->leftJoin('list_category AS c', 'c.post_id', '=', 'p.ID')
        // ->groupBy('p.ID')
        ->where($clean_where);
        $data = !empty($search) ? $data->where('post_content', 'like', '%' . $search . '%') : $data;
        $data = !empty($date) ? $data->whereDate('post_date', $date) : $data;
        return $data->first()->total;
    }

    public function getAllKeywords($keyword) {
        $data = $this->select('keyword as value', 'lk.keyword_id as id', 'keyword as label', $this->raw('count(*) as keywords'))->from('keyword as k')
        ->leftJoin('list_keyword AS lk', 'lk.keyword_id', '=', 'k.keyword_id');
        $data->groupBy("lk.keyword_id")->orderByDesc('keywords');
        return $data->where('keyword', 'like', '%' . $keyword . '%')->limit(30)->get();
    }

    public function getAllKeywordByID($id) {
        return $this->select('k.keyword_id', 'keyword')->from('keyword as k')
            ->leftJoin('list_keyword AS lk', 'lk.keyword_id', '=', 'k.keyword_id')
            ->where('lk.post_id', $id)
            ->get();
    }

    public function getFuturePosts() {
        $data = $this->select('post_date','ID','post_title')
        ->whereRaw('post_date <=  NOW()')
        ->where('post_date' ,'>=', 'DATE_SUB(NOW(), INTERVAL 7 MINUTE)')
        ->where('post_status' ,'=', 'future')
        ->orderByDesc('ID');
        return $data->get();
        // return !empty($data->ID) ? $data : false;
    }

    public function setPublishFuturePosts($id) {
        return $this->where('ID', $id)->update(['post_status' => "publish"]);
    }

    public function getLatestApiDb() {
        return $this->from("latest_api")->get();
    }

    public function getLatestApiKlasmen() {
        return $this->from("api")->first();
    }
}
