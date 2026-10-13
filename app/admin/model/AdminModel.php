<?php

namespace app\admin\model;

use support\Model;
use support\Db;

class AdminModel extends Model {
    protected $table = 'posts';

    protected $primaryKey = 'ID';

    public $timestamps = false;

    private $tb_posts = 'posts';
    private $tb_list_category = 'list_category';
    private $tb_list_keyword = 'list_keyword';
    private $tb_keyword = 'keyword';
    private $tb_popular_posts = 'popular_posts';
    private $tb_category = 'category';
    private $tb_image_featured = 'image_featured';
    private $tb_image_center = 'image_center';
    private $tb_photos = 'photos';
    private $tb_video = 'video';

    public function getLatest($page = 1, $category = null, $daterange = null, $search = null, $author = null, $reporter = null,  $limit = null) {
        $page_limit = ($page - 1) * $limit;
        $where[] = ['post_type' => 'post'];
        !empty($category) ? $where[] = ['c.category_id' => $category] : '';
        !empty($author) ? $where[] = ['post_author' => $author] : '';
        !empty($reporter) ? $where[] = ['p.reporter_id' => $reporter] : '';
        $clean_where = array_reduce($where, 'array_merge', []);
        $data = $this->select('ca.category_name as cat_name', 'p.ID as ID', 'post_title', 'post_date', 'post_author', 'post_status', 'img_thumb', 'display_name', $this->raw('LEFT(keyword, 20) as keyword'), 'r.name as reporter_name')
            ->from('posts AS p')
            ->leftJoin('users AS u', 'u.ID', '=', 'p.post_author')
            ->leftJoin('list_category AS c', 'c.post_id', '=', 'p.ID')
            ->leftJoin('category AS ca', 'ca.category_id', '=', 'c.category_id')
            ->leftJoin('list_keyword AS lk', 'p.ID', '=', 'lk.post_id')
            ->leftJoin('keyword as k', 'lk.keyword_id', '=', 'k.keyword_id')
            ->leftJoin('image_featured AS f', 'p.ID', '=', 'f.post_id')
            ->leftJoin('reporter AS r', 'p.reporter_id', '=', 'r.reporter_id')
            ->where($clean_where)
            ->groupBy('p.ID')
            ->orderByDesc('post_date')
            ->limit($limit);
        $data = !empty($search) ? $data->where('post_content', 'like', '%' . $search . '%')->orWhere('post_title', 'like', '%' . $search . '%') : $data;
        // $data->addSelect($this->raw('SUM(DISTINCT '.Db::getTablePrefix().'po.total_pageviews) as total_pageviews'))
        // ->leftJoin('popular_posts AS po', 'po.post_id', '=', 'p.ID');
        // $data = !empty($daterange) ? $data->whereDate('post_date', $daterange) : $data;
        $dateranger = !empty($daterange) ? explode("_", $daterange) : null ;
        $data = !empty($dateranger) ?  $data->whereDate('post_date','>=',$dateranger[0])->whereDate('post_date','<=', $dateranger[1]) : $data;
        return !empty($page) ? $data->offset($page_limit)->get() : $data->get();
    }

    public function getPageViewByID($post_id) { 
        $data = $this->from('popular_posts')->select($this->raw('SUM(DISTINCT ' . Db::getTablePrefix() . 'popular_posts.total_pageviews) as total_pageviews'))->where('post_id', '=', $post_id);
        return $data->first();
    }

    public function getLatestTotal($category = null, $daterange = null, $search = null, $author = null, $reporter = null) {
        $where[] = ['post_type' => 'post'];
        !empty($category) ? $where[] = ['c.category_id' => $category] : '';
        !empty($author) ? $where[] = ['post_author' => $author] : '';
        !empty($reporter) ? $where[] = ['reporter_id' => $reporter] : '';
        $clean_where = array_reduce($where, 'array_merge', []);
        $data = $this->select($this->raw('count(DISTINCT ID) as total'))
            ->from('posts AS p')
            // ->join('users AS u', 'u.ID', '=', 'p.post_author')
            ->leftJoin('list_category AS c', 'c.post_id', '=', 'p.ID')
            // ->groupBy('p.ID')
            ->where($clean_where);
        $dateranger = !empty($daterange) ? explode("_", $daterange) : null ;
        $data = !empty($dateranger) ?  $data->whereDate('post_date','>=',$dateranger[0])->whereDate('post_date','<=', $dateranger[1]) : $data;
        $data = !empty($search) ? $data->where('post_content', 'like', '%' . $search . '%') : $data;
        // $data = !empty($date) ? $data->whereDate('post_date', $date) : $data;
        return $data->first()->total;
    }

    public function getAllAuthor() {
        return Db::table('users')->get();
    }

    public function getAllReporter() {
        return Db::table('reporter')->where('active', '1')->get();
    }

    public function getPost($id) {
        return $this->select('p.ID', 'p.post_title', 'p.post_date', 'p.post_author', 'p.post_status', 'image_featured_id', 'f.img_thumb as img_thumb', 'f.img_mid', 'u.display_name', 'p.headline', 'p.post_content', 'p.reporter_id', 'img_caption', 'img_author',  'v.link', 'description')
            ->from('posts AS p')
            // ->orderByDesc('post_date')
            ->leftJoin('users as u', 'u.ID', '=', 'p.post_author')
            ->leftJoin('image_featured as f', 'p.ID', '=', 'f.post_id')
            ->leftJoin('video as v', 'p.ID', '=', 'v.post_id')
            ->where('p.ID', '=', $id)
            ->first();
    }
    
    public function getPhotos($post_id) {
        return $this->from("photos")->where("post_id", $post_id)->get();
    }

    public function getAllKeyword($id) {
        return $this->select('k.keyword_id', 'keyword')->from('keyword as k')
            ->leftJoin('list_keyword AS lk', 'lk.keyword_id', '=', 'k.keyword_id')
            ->where('lk.post_id', $id)
            ->get();
    }

    public function getLatestNewPage() {
        $where[] = ['post_type' => 'page'];
        !empty($author) ? $where[] = ['post_author' => $author] : '';
        $clean_where = array_reduce($where, 'array_merge', []);
        $data = $this->select('p.ID as ID', 'post_title', 'p.post_date as post_date', 'p.post_author as post_author', 'p.post_status as post_status', 'img_thumb', 'u.display_name')
            ->from('posts AS p')
            ->join('users AS u', 'u.ID', '=', 'p.post_author')
            ->leftJoin('image_featured AS f', 'p.ID', '=', 'f.post_id')
            ->where($clean_where)
            ->groupBy('p.ID')
            ->orderByDesc('post_date')
            ->limit(30);
        return $data->get();
    }

    public function savePost($data) {
        $headline = !empty($data['headline']) ? 1 : 0;
        !empty($data['image_featured_id']) ? $this->insertSameImg($data['image_featured_id'], $data['ID']) : '';
        $data_status = 'future' == checkFuture(sqlDate($data['post_date']) . ' ' . $data['post_time']) ? 'future' : $data['submit'];
        $data_post = [
            'post_title' => $data['post_title'],
            // 'sub_heading' => $data['sub_heading'],
            'post_name' => str_slug($data['post_title']),
            'post_content' => adminSaveContent($data['post_content']),
            'post_status' => $data_status,
            'reporter_id' => !empty($data['reporter_id']) ? $data['reporter_id'] : 0,
            'post_date' => sqlDate($data['post_date']) . ' ' . $data['post_time'],
            'post_date_gmt' => sqlDate($data['post_date']) . ' ' . $data['post_time'],
            'headline' => $headline,
            'description' => $data['description'],
            'img_caption' => !empty($data['img_caption']) ? $data['img_caption'] : '',
            'img_author' => !empty($data['img_author']) ? $data['img_author'] : '',
            'reporter_id' => !empty($data['reporter_id']) ? $data['reporter_id'] : '',
        ];
        $post_id = $data['ID'];
        // delete & insert to category
        if ($this->checkListCategory($post_id)) {
            Db::table($this->tb_list_category)->where('post_id', $post_id)->delete();
        }
        $data_category = [
            'post_id' => $post_id,
            'category_id' => $data['category_id'],
        ];
        Db::table($this->tb_list_category)->insert($data_category);

        if ($this->checkListVideo($post_id)) {
            Db::table($this->tb_video)->where('post_id', $post_id)->delete();
        }
        $data_video = [
            'post_id' => $post_id,
            'link' => $data['link'],
        ];
        !empty($data['link']) ? Db::table($this->tb_video)->insert($data_video) : '';
        // update keyword
        $keywords = $data['keywords'];
        if (!empty($keywords)) {
            $keyword_all = explode(',', $keywords);
            // print_r( $keyword_all);
            if ($this->checkListKeyword($post_id)) {
                Db::table($this->tb_list_keyword)->where('post_id', $post_id)->delete();
            }
            foreach ($keyword_all as $keyword) {
                if (is_numeric($keyword)) {
                    $data_keyword = [
                        'post_id' => $post_id,
                        'keyword_id' => $keyword,
                    ];
                    Db::table($this->tb_list_keyword)->insert($data_keyword);
                } else {
                }
            }
        }
        if (!empty($data['new_keywords'])) {
            $keyword_new_all = explode(',', $data['new_keywords']);
            // print_r($keyword_new_all);
            foreach ($keyword_new_all as $keyword) {
                $keyword_id = $this->insertKeyword($keyword);
                // echo $keyword_id ;
                $data_keyword = [
                    'post_id' => $post_id,
                    'keyword_id' => $keyword_id,
                ];
                Db::table($this->tb_list_keyword)->insert($data_keyword);
            }
        }
        // $this->db->set('post_modified', 'NOW()', false);
        return $this->where('ID', $data['ID'])
            ->update($data_post);
    }

    public function savePage($data) {
        $data_post = [
            'post_title' => $data['post_title'],
            'post_name' => str_slug($data['post_title']),
            'post_content' => allowTags(adminBrToNewline($data['post_content'])),
            'post_status' => 'publish',
            'post_date' => sqlDate($data['post_date']) . ' ' . $data['post_time'],
            'post_date_gmt' => sqlDate($data['post_date']) . ' ' . $data['post_time'],
            'img_caption' => !empty($data['img_caption']) ? $data['img_caption'] : '',
        ];
        $post_id = $data['ID'];
        if ($post_id) {
            $this->where('ID', $data['ID'])
                ->update($data_post);
        } else {
            $this->insertGetId($data_post);
        }
    }

    public function getCategoryName($id) {
        $row = Db::table($this->tb_category)->where('category_id', $id)->first();
        return $row->slug;
    }

    public function checkListCategory($post_id) {
        return Db::table($this->tb_list_category)->where('post_id', $post_id)->first();
    }

    public function checkListKeyword($post_id) {
        return Db::table($this->tb_list_keyword)->where('post_id', $post_id)->first();
    }

    public function checkListVideo($post_id) {
        return Db::table($this->tb_video)->where('post_id', $post_id)->first();
    }

    // set to draft
    public function deletePost($id) {
        $data['post_status'] = 'draft';
        return $this->where('ID', $id)->update($data);
    }

    public function getDraftEmptyUser($user_id) {
        return $this->where(['post_status' => 'draft', 'post_type' => 'post', 'post_author' => $user_id, 'post_title' => '', 'post_content' => ''])->first();
    }

    public function newPost($user_id) {
        $data['post_status'] = 'draft';
        $data['post_type'] = 'post';
        $data['post_author'] = $user_id;
        $data['post_date'] = date('Y-m-d H:i:s');
        $post_id = $this->insertGetId($data);
        $this->insertPopularPosts($post_id);
        return $post_id;
    }

    public function newPage($user_id) {
        $data['post_status'] = 'draft';
        $data['post_type'] = 'page';
        $data['post_author'] = $user_id;
        $data['post_date'] = date('Y-m-d H:i:s');
        $post_id = $this->insertGetId($data);
        $this->insertPopularPosts($post_id);
        return $post_id;
    }

    public function insertKeyword($keyword) {
        // if(!empty($this->checkKeyword($keyword)->keyword)) {
        return Db::table($this->tb_keyword)->insertGetId(['keyword' => $keyword]);
        // }
    }

    public function checkKeyword($keyword) {
        return Db::table($this->tb_keyword)->where('keyword', $keyword)->first();
    }

    public function insertPopularPosts($post_id) {
        return Db::table($this->tb_popular_posts)->insertGetId(['post_id' => $post_id, 'total_pageviews' => 1]);
    }

    public function saveDraft($data) {
        $data['post_type'] = 'draft';
        return Db::table($this->tb_popular_posts)->where('ID', $data['ID'])->update($data);
    }

    public function checkFeaturedImgExists($post_id) {
        return Db::table($this->tb_image_featured)->where('post_id', $post_id)->first();
    }

    public function insertSameImg($id, $post_id) {
        Db::table($this->tb_image_featured)->where('post_id', $post_id)->delete();
        $data = Db::table($this->tb_image_featured)->where('image_featured_id', $id)->first();
        unset($data->image_featured_id);
        $data->post_id = $post_id;
        return $this->insertImgSame($data);
    }

    public function insertImgSame($data) {
        $data_img = ['filename' => $data->filename, 'img_thumb' => $data->img_thumb, 'img_mid' => $data->img_mid, 'full_path' => $data->full_path, 'created' => $data->created, 'original_name' => $data->original_name,  'caption' => $data->caption, 'update_date' => $data->update_date, 'post_id' => $data->post_id];
        return Db::table($this->tb_image_featured)->insertGetId($data_img);
    }

    public function insertImg($data) {
        return Db::table($this->tb_image_featured)->insertGetId($data);
    }

    public function insertImgCenter($data) {
        return Db::table($this->tb_image_center)->insertGetId($data);
    }

    public function insertPhoto($data) {
        return Db::table($this->tb_photos)->insertGetId($data);
    }

    public function updateImg($data, $id) {
        unset($data['post_id']);
        return Db::table($this->tb_image_featured)->where('post_id', $id)->update($data);
    }

    public function updateImgCenter($data, $id) {
        unset($data['post_id']);
        return Db::table($this->tb_image_center)->where('image_center_id', $id)->update($data);
    }

    public function updatePhoto($data, $id) {
        unset($data['post_id']);
        return Db::table($this->tb_photos)->where('photo_id', $id)->update($data);
    }

    public function deletePhoto($photo_id) {
        return Db::table($this->tb_photos)->where('photo_id', $photo_id)->delete();
    }

    public function getReporterMonthly($code, $month, $year) {
        $sql = "SELECT p.ID, post_title, post_date, post_author, RIGHT(post_content, 100) as last_red, display_name FROM `{PRE}posts` p
        INNER JOIN {PRE}users u ON u.ID = p.post_author
        WHERE post_content LIKE '%(" . $code . ")%'
                AND MONTH(post_date) = '" . $month . "' AND YEAR(post_date) = '" . $year . "' AND post_status='publish'";
        $query = $this->query($sql);
        return $query;
    }
}
