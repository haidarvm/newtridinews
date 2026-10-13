<?php

namespace app\admin\controller;

use app\admin\model\AdminModel;
use app\admin\model\BacaModel;
use app\admin\model\CategoryModel;
use app\admin\model\GalleryModel;
use app\admin\model\UserModel;
use Gumlet\ImageResize;
use JasonGrimes\Paginator;
use support\Request;

use \AllowDynamicProperties;

class Posts {

    protected $madmin;
    protected $mcategory;
    protected $muser;
    protected $mgallery;

    public function __construct() {
        $this->madmin = new AdminModel();
        $this->mgallery = new GalleryModel();
        $this->mcategory = new CategoryModel();
        $this->muser = new UserModel();
    }

    public function index(Request $request) {
        if ($request->session()->get('user_id')) {
            return redirect('/admin/posts/all/all/all/all/all/all/1');
        }
        return redirect('/');
        //return view('login', ['session' => $request->session()->all()]);
    }

    public function all(Request $request, $category, $daterange, $search, $author, $reporter , $page ) {
        $data['title'] = 'Admin Posts';
        $data['cat'] = $category;
        $data['author'] = $author;
        $data['reporter'] = $reporter;
        $data['search'] = $search;
        $data['daterange'] = $daterange;
        $limit = 20;
        $data['page'] = $page;
        $category = 'all' != $category ? $category : null;
        // $date = 'all' != $date ? $date : null;
        $daterange =  'all' != $daterange ? $daterange : null;
        $search = 'all' != $search ? cleanSearch($search) : null;
        $author = 'all' != $author ? $author : null;
        $reporter = 'all' != $reporter ? $reporter : null;
        $data['latest'] = $this->madmin->getLatest($page, $category, $daterange, $search, $author, $reporter, $limit);
        $data['madmin'] = $this->madmin;
        $data['request'] = $request;
        $data['categories'] = $this->mcategory->getAllCategory();
        $data['authors'] = $this->muser->getAllUser();
        $data['reporters'] = $this->madmin->getAllReporter();
        $url_pattern = '/admin/posts/all/' . nullSearch($category) . '/' . nullSearch($daterange) . '/' . nullSearch($search) . '/' . nullSearch($author) . '/' . nullSearch($reporter) . '/(:num)';
        $data['total'] = $this->madmin->getLatestTotal($category, $daterange, $search, $author, $reporter);
        $data['paginator'] = new Paginator($data['total'], $limit, $page, $url_pattern);
        return view('post_list_view', $data);
    }

    public function photos(Request $request, $daterange=null, $search=null, $author=null, $page=1 ) {
        $data['title'] = 'Admin Posts';
        $data['author'] = $author;
        $data['search'] = $search;
        $data['daterange'] = $daterange;
        $limit = 20;
        $data['page'] = $page;
        $daterange =  'all' != $daterange ? $daterange : null;
        $search = 'all' != $search ? cleanSearch($search) : null;
        $author = 'all' != $author ? $author : null;
        $data['latest'] = $this->madmin->getLatest($page, 619, $daterange, $search, $author, "", $limit);
        $data['request'] = $request;
        $data['authors'] = $this->muser->getAllUser();  
        $url_pattern = '/admin/posts/gallery/'  . nullSearch($daterange) . '/' . nullSearch($search)  . '/(:num)';
        $data['total'] = $this->madmin->getLatestTotal(619, $daterange, $search, $author );
        $data['paginator'] = new Paginator($data['total'], $limit, $page, $url_pattern);
        return view('photos_list', $data);
    }

    public function filter_posts(Request $request) {
        $post = $request->post();
        return redirect('/admin/posts/all/' . nullSearch($post['category_id']) . '/' . nullSearch($post['daterange']) . '/' . nullSearch(urlSearch($post['search'])) . '/' . nullSearch($post['author_id']) . '/' . nullSearch($post['reporter_id']) . '/1');
    }

    public function filter_photos(Request $request) {
        $post = $request->post();
        return redirect('/admin/posts/all/' . nullSearch($post['category_id']) . '/' . nullSearch($post['daterange']) . '/' . nullSearch(urlSearch($post['search'])) . '/' . nullSearch($post['author_id']) . '/' . nullSearch($post['reporter_id']) . '/1');
    }

    public function add_post(Request $request) {
        $getDraftEmpty = $this->madmin->getDraftEmptyUser($request->session()->get('user_id'));
        // echo $getDraftEmpty;
        if (empty($getDraftEmpty)) {
            $post_id = $this->madmin->newPost($request->session()->get('user_id'));
            if (!empty($post_id)) {
                return redirect('/admin/posts/edit_post/' . $post_id);
            } else {
                return false;
            }
        } else {
            return redirect('/admin/posts/edit_post/' . $getDraftEmpty->ID);
        }
    }

    public function edit_post(Request $request, $id) {
        $data['request'] = $request;
        $data['title'] = 'Admin Post';
        $data['post'] = $this->madmin->getPost($id);
        // print_r($data['post']);
        $data['cat'] = $this->mcategory->getListCategoryPostId($id);
        $data['categories'] = $this->mcategory->getAllCategory();
        $data['keywords'] = $this->madmin->getAllKeyword($id);
        $data['reporters'] = $this->madmin->getAllReporter();
        $data['ajax'] = 'admin/get_gallery_ajax/';
        $data['gallery'] = $this->mgallery->getGallery(1, 200, null);
        // $mbaca = new BacaModel();
        // $data['baca'] = $mbaca->getTitle(1, 200, null);
        $data['latest'] = $this->madmin->getLatest(1, '', '', '', '', '', 100);
        // print_r($data['gallery']);
        return view('post_view_form', $data);
    }

    public function add_photo(Request $request) {
        $getDraftEmpty = $this->madmin->getDraftEmptyUser($request->session()->get('user_id'));
        if (empty($getDraftEmpty)) {
            $post_id = $this->madmin->newPost($request->session()->get('user_id'));
            if (!empty($post_id)) {
                return redirect('/admin/posts/edit_photo/' . $post_id);
            } else {
                return false;
            }
        } else {
            return redirect('/admin/posts/edit_photo/' . $getDraftEmpty->ID);
        }
    }

    public function edit_photo(Request $request, $id) {
        $data['request'] = $request;
        $data['title'] = 'Admin Post';
        $data['post'] = $this->madmin->getPost($id);
        // print_r($data['post']);
        $data['photos'] = $this->madmin->getPhotos($id);
        $data['cat'] = $this->mcategory->getListCategoryPostId($id);
        $data['categories'] = $this->mcategory->getAllCategory();
        $data['keywords'] = $this->madmin->getAllKeyword($id);
        $data['reporters'] = $this->madmin->getAllReporter();
        $data['ajax'] = 'admin/get_gallery_ajax/';
        $data['gallery'] = $this->mgallery->getGallery(1, 30, null);
        // print_r($data['gallery']);
        return view('photo_view', $data);
    }

    public function save(Request $request) {
        $post = $request->post();
        // return json($post);
        $post_id = $this->madmin->savePost($post);
        // echo $post_id;
        return redirect('/admin/posts/all/all/all/all/all/all/1');
    }

    public function pages(Request $request) {
        $data['request'] = $request;
        $data['title'] = 'Admin Pages';
        $data['latest'] = $this->madmin->getLatestNewPage();
        $data['listAuthor'] = $this->madmin->getAllAuthor();
        return view('pages', $data);
    }

    public function add_page(Request $request) {
        echo $request->session()->get('user_id');
        $getDraftEmpty = $this->madmin->getDraftEmptyUser($request->session()->get('user_id'));
        // echo $getDraftEmpty;
        if (empty($getDraftEmpty)) {
            $post_id = $this->madmin->newPost($request->session()->get('user_id'));
            if (!empty($post_id)) {
                return redirect('/admin/posts/edit_page/' . $post_id);
            } else {
                return false;
            }
        } else {
            return redirect('/admin/posts/edit_page/' . $getDraftEmpty->ID);
        }
    }

    public function save_page(Request $request) {
        $post = $request->post();
        $post_id = $this->madmin->savePage($post);
        return redirect('/admin/posts/pages/all/all/all/1');
    }

    public function edit_page(Request $request, $id) {
        $data['request'] = $request;
        $data['title'] = 'Admin Page';
        $data['post'] = $this->madmin->getPost($id);
        return view('page_view', $data);
    }

    public function haidar(Request $request) {
        return json('haidar' . shortUniq());
    }

    public function img(Request $request, $id) {
        $file = $request->file('filename');
        if ($file && $file->isValid()) {
            $fileloc = public_path() . imgFull() . getFileName($file->getUploadName()) . '-' . shortUniq() . '.' . $file->getUploadExtension();
            $file->move($fileloc);
            $data_ori = [
                'post_id' => $id,
                'full_path' => imgPath() . getFileName($fileloc) . '.' . $file->getUploadExtension(),
                'filename' => getFileName($fileloc),
                'original_name' => $file->getUploadName(),
            ];
            if (empty($this->madmin->checkFeaturedImgExists($id))) {
                $this->madmin->insertImg($data_ori);
            } else {
                $this->madmin->updateImg($data_ori, $id);
            }
            $img_thumb = $this->resizeThumb($request, $fileloc, $id);
            $img_mid = $this->resizeMid($request, $fileloc, $id);
            $data['upload_data']['url'] = $img_thumb;
            $data['success'] = true;
            $data['status'] = 200;
            return json($data);
        }
        return response('file not found');
    }

    public function img_center(Request $request, $id) {
        $file = $request->file('filename');
        if ($file && $file->isValid()) {            
            $fileloc = public_path() . imgFull() . getFileName($file->getUploadName()) . '-' . shortUniq() . '.' . $file->getUploadExtension();
            $file->move($fileloc);
            $data_ori = [
                'post_id' => $id,
                'full_path' => imgPath() . getFileName($fileloc) . '.' . $file->getUploadExtension(),
                'filename' => getFileName($fileloc),
                'original_name' => $file->getUploadName(),
            ];

            $img_id = $this->madmin->insertImgCenter($data_ori);
            $imgMid = $this->resizeMidCenter($request, $fileloc, $img_id);
            $data['data']['url'] = $imgMid;
            $data['data']['link'] = $imgMid;
            $data['success'] = true;
            $data['status'] = 200;
            return json($data);
        }
        return response('file not found');
    }

    public function photo_upload(Request $request, $id) {
        $file = $request->file('filename');
        if ($file && $file->isValid()) {            
            $fileloc = public_path() . imgFull() . getFileName($file->getUploadName()) . '-' . shortUniq() . '.' . $file->getUploadExtension();
            $file->move($fileloc);
            $data_ori = [
                'post_id' => $id,
                'full_path' => imgPath() . getFileName($fileloc) . '.' . $file->getUploadExtension(),
                'filename' => getFileName($fileloc),
                'original_name' => $file->getUploadName(),
            ];

            $photo_id = $this->madmin->insertPhoto($data_ori);
            $img_thumb = $this->resizeThumbPhoto($request, $fileloc, $photo_id);
            $imgMid = $this->resizeMidPhoto($request, $fileloc, $photo_id);
            $data['data']['url'] = $img_thumb;
            $data['data']['link'] = $img_thumb;
            $data['success'] = true;
            $data['status'] = 200;
            return json($data);
        }
        return response('file not found');
    }

    public function path(Request $request) {
        return response(public_path());
    }

    private function resizeThumb($request, $file, $id) {
        $image = new ImageResize($file);
        $image->crop(200, 112, true, ImageResize::CROPCENTER);
        $image->quality_jpg = 70;
        $newfile = saveNewFile($file, 'thumb', public_path());
        $image->save($newfile, IMAGETYPE_JPEG);
        $data['img_thumb'] = imgPath() . getFileNameExt($newfile);
        $this->madmin->updateImg($data, $id);
        return pathToUrl($newfile);
    }

    private function resizeMid($request, $file, $id) {
        $image = new ImageResize($file);
        $image->resizeToBestFit(1280, 720);
        $image->quality_jpg = 80;
        $newfile = saveNewFile($file, 'mid', public_path());
        $image->save($newfile, IMAGETYPE_JPEG);
        $data['img_mid'] = imgPath() . getFileNameExt($newfile);
        $this->madmin->updateImg($data, $id);
        return pathToUrl($newfile);
    }

    private function resizeMidCenter($request, $file, $id) {
        $image = new ImageResize($file);
        $image->resizeToBestFit(720, 389);
        $image->quality_jpg = 90;
        $newfile = saveNewFile($file, 'mid', public_path());
        $image->save($newfile);
        $data['img_mid'] = imgPath() . getFileNameExt($newfile);
        $this->madmin->updateImgCenter($data, $id);
        return pathToUrl($newfile);
    }

    private function resizeThumbPhoto($request, $file, $id) {
        $image = new ImageResize($file);
        $image->crop(200, 112, true, ImageResize::CROPCENTER);
        $image->quality_jpg = 70;
        $newfile = saveNewFile($file, 'thumb', public_path());
        $image->save($newfile, IMAGETYPE_JPEG);
        $data['img_thumb'] = imgPath() . getFileNameExt($newfile);
        $this->madmin->updatePhoto($data, $id);
        return pathToUrl($newfile);
    }

    private function resizeMidPhoto($request, $file, $id) {
        $image = new ImageResize($file);
        $image->resizeToBestFit(720, 389);
        $image->quality_jpg = 90;
        $newfile = saveNewFile($file, 'mid', public_path());
        $image->save($newfile);
        $data['img_mid'] = imgPath() . getFileNameExt($newfile);
        $this->madmin->updatePhoto($data, $id);
        return pathToUrl($newfile);
    }

    public function delete(Request $request, $id) {
        $this->madmin->deletePost($id);
        return redirect('/admin/posts/all/all/all/all/all/1');
    }

    public function delete_photo($request, $photo_id) {
        $photo_id = $request->post('photo_id');
        $this->madmin->deletePhoto($photo_id);
        return $photo_id;
    }
}
