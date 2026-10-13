<?php

namespace app\admin\controller;

use app\admin\model\GalleryModel;
use app\admin\model\UserModel;

use support\Request;
use JasonGrimes\Paginator;

use \AllowDynamicProperties;


class Gallery
{
    protected $admin;
    protected $mcategory;
    protected $mgallery;
    protected $muser;

    public function __construct() {
        $this->mgallery = new GalleryModel();
        $this->muser = new UserModel();
    }

    public function index(Request $request, $page, $limit=null, $search = null) {
        // $data['request'] = $request;
        // $limit =100;
        $data['items'] = $this->mgallery->getGallery($page, $limit, $search);
        // print_r($data['items']);
        return json($data);
    }

    public function all(Request $request, $daterange=null, $search=null, $author=null, $page=1 ) {
        $data['title'] = 'Admin Posts';
        $data['author'] = $author;
        $data['search'] = $search;
        $data['daterange'] = $daterange;
        $limit = 500;
        $data['page'] = $page;
        $daterange =  'all' != $daterange ? $daterange : null;
        $search = 'all' != $search ? cleanSearch($search) : null;
        $author = 'all' != $author ? $author : null;
        $data['latest'] = $this->mgallery->getGallery($page, $limit,  $search);
        $data['request'] = $request;
        $data['authors'] = $this->muser->getAllUser();  
        $url_pattern = '/admin/posts/gallery/'  . nullSearch($daterange) . '/' . nullSearch($search)  . '/(:num)';
        $data['total'] = $this->mgallery->getGalleryTotal($search );
        $data['paginator'] = new Paginator($data['total'], $limit, $page, $url_pattern);
        return view('gallery', $data);
    }


    public function get_detail(Request $request, $id, $limit, $search = null) {
        // $data['request'] = $request;
        $data['items'] = $this->mgallery->getGalleryId($id, $limit, $search);
        // print_r($data['items']);
        return json($data);
    }

    public function update(Request $request, $id, $limit, $search = null) {
        // $data['request'] = $request;
        $data['items'] = $this->mgallery->galUpate($id, $limit, $search);
        // print_r($data['items']);
        return json($data);
    }
       

    public function add_photo() {
        // check if exist empty posts draft before from user
        $getDraftEmpty = $this->madmin->getDraftEmptyUser($this->user_id);
        if (0 == $getDraftEmpty->num_rows()) {
            // insert new id first
            $post_id = $this->madmin->newPost();
            if (!empty($post_id)) {
                redirect('admin/edit_photo/' . $post_id);
            } else {
                return false;
            }
        } else {
            $data = $getDraftEmpty->row();
            redirect('admin/edit_photo/' . $data->ID);
        }
        // redirect to edit_post
    }

    public function edit_photo($id) {
        $data['title'] = 'Javanews TV Admin Post';
        $data['post'] = $this->madmin->getPost($id)->row();
        $data['photos'] = $this->madmin->getPhotos($id);
        $data['getCategory'] = $this->mcategory->getCategory($id);
        $data['listCategory'] = $this->mcategory->listCategory()->result();
        $data['reporters'] = $this->madmin->getAllReporter();
        $data['css'] = $this->uploadCSS();
        // $this->output->enable_profiler(true);
        $this->load->admin_template('admin/photo', $data);
    }

}