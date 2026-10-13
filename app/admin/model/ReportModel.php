<?php

namespace app\admin\model;

use support\Model;
use support\Db;

class ReportModel extends Model {
    protected $table = 'report';

    protected $primaryKey = 'report_id';

    public $timestamps = false;

    public function insertReport($data) {
        return $this->insertGetId($data);
    }

    public function updateReport($report_id, $data) {
        unset($data['report_id']);
        return $this->where('report_id', $report_id)->update($data);
    }

    public function generateReport($data) {
        $check = $this->checkValueId($data['value_id']);
        $report_id = $check['report_id'];
        if (!empty($check['report_id'])) {
            $this->updateReport($check['report_id'], $data);
        } else {
            $report_id  =  $this->insertGetId($data);
        }
        return $this->getReport($report_id);
    }

    public function checkValueId($value_id) {
        $data = $this->select('value_id', 'report_id');
        return $data->where('value_id', $value_id)->first();
    }

    public function getReport($report_id) {
        return $this->where('report_id', $report_id)->first();
    }

    public function getReportCat($report_category_id) {
        $data = $this->from('report_category');
        return $data->where('report_category_id', $report_category_id)->first();
    }

    public function getHighTraffic($limit = null, $day = null, $month = null) {
        $day =  empty($day) ? 7 : $day;
        $limit = empty($limit) ? 15 : $limit;
        $data = $this->select('ca.category_name as cat_name', 'p.ID as ID', 'post_title', 'post_date', 'display_name', 'last_view', $this->raw('GROUP_CONCAT(DISTINCT keyword) as keyword, LEFT(post_title, 70) as title, SUM(DISTINCT total_pageviews) as total_pageviews, DATE_FORMAT(post_date,  "%d-%b %H:%i") as date'))
        ->from('popular_posts AS pop')
        ->leftJoin('posts AS p', 'p.ID', '=', 'pop.post_id')
        ->leftJoin('users AS u', 'u.ID', '=', 'p.post_author')
        ->leftJoin('list_category AS c', 'c.post_id', '=', 'p.ID')
        ->leftJoin('category AS ca', 'ca.category_id', '=', 'c.category_id')
        ->leftJoin('list_keyword AS lk', 'lk.post_id', '=', 'p.ID')
        ->leftJoin('keyword AS k', 'k.keyword_id', '=', 'lk.keyword_id')
        ->groupBy('pop.post_id')
        ->orderByDesc('total_pageviews')
        ->limit($limit);
        $range = !empty($month) ? $data->whereMonth('post_date', '=', date('m'))->whereYear('post_date', '=', date('Y')) : $data->whereDate('post_date', '>=', date('Y-m-d', strtotime("-$day day")));
        return $range->get();
    }


    public function trending() {
        $data = $this->select('post_title', 'date', 'p.post_date', 'display_name', 'total_pageviews', $this->raw('LEFT(post_title, 70) as title,  DATE_FORMAT(post_date,  "%d-%b %H:%i") as date'))
        ->from('popular_posts as pop')
        ->leftJoin('posts AS p', 'p.ID', '=', 'pop.post_id')
        ->leftJoin('users AS u', 'u.ID', '=', 'p.post_author')
        ->where('total_pageviews', '>=', '40')
        ->whereDate('date', '=', date('Y-m-d'))
        ->orderByDesc('total_pageviews')
        ->limit(30);
        return $data->get();
    }

    //  repair total news
    public function getHighTrafficAuthor($limit = null, $day = null, $month = null) {
        $day =  empty($day) ? 7 : $day;
        $limit = empty($limit) ? 15 : $limit;
        $data = $this->select('p.ID as ID', 'post_title', 'post_date', $this->raw('SUM(DISTINCT total_pageviews) as total, COUNT(DISTINCT ' . Db::getTablePrefix() . 'p.ID) as total_news, DATE_FORMAT(MAX(post_date),  "%d-%b %H:%i") as date, CEIL(SUM(DISTINCT total_pageviews) / COUNT(DISTINCT ' . Db::getTablePrefix() . 'p.ID)) as avg'), 'display_name', 'last_view')
        ->from('posts AS p')
        ->leftJoin('popular_posts AS pop', 'p.ID', '=', 'pop.post_id')
        ->leftJoin('users AS u', 'u.ID', '=', 'p.post_author')
        // ->whereDate("post_date", ">=" , date("Y-m-d", strtotime("-$day day")))
        ->whereMonth('post_date', '=', date('m'))->whereYear('post_date', '=', date('Y'))
        ->groupBy('p.post_author')
        ->orderByDesc('total')
        ->limit($limit);
        return $data->get();
    }

    public function getHighTrafficReporter($limit = null, $day = null, $month = null) {
        $day =  empty($day) ? 7 : $day;
        $limit = empty($limit) ? 15 : $limit;
        $data = $this->select('p.ID as ID', 'post_title', 'post_date', $this->raw('SUM(DISTINCT total_pageviews) as total, COUNT(DISTINCT ' . Db::getTablePrefix() . 'p.ID) as total_news, CEIL(SUM(DISTINCT total_pageviews) / COUNT(DISTINCT ' . Db::getTablePrefix() . 'p.ID)) as avg, DATE_FORMAT(MAX(post_date),  "%d-%b %H:%i") as date'), 'name', 'last_view')
        ->from('popular_posts AS pop')
        ->leftJoin('posts AS p', 'p.ID', '=', 'pop.post_id')
        ->leftJoin('reporter AS r', 'r.reporter_id', '=', 'p.reporter_id')
        // ->whereDate("post_date", ">=" , date("Y-m-d", strtotime("-$day day")))
        ->whereMonth('post_date', '=', date('m'))->whereYear('post_date', '=', date('Y'))
        ->groupBy('p.reporter_id')
        ->orderByDesc('total')
        ->limit($limit);
        return $data->get();
    }

    public function getTotalReporter($limit = null, $day = null, $month = null) {
        $day =  empty($day) ? 7 : $day;
        $limit = empty($limit) ? 15 : $limit;
        $data = $this->select('p.ID as ID', 'post_title', 'post_date', $this->raw(' COUNT(' . Db::getTablePrefix() . 'p.ID) as total_news'), 'name')
        ->from('posts AS p')
        ->leftJoin('reporter AS r', 'r.reporter_id', '=', 'p.reporter_id')
        // ->whereDate("post_date", ">=" , date("Y-m-d", strtotime("-$day day")))
        ->whereMonth('post_date', '=', date('m'))->whereYear('post_date', '=', date('Y'))
        ->groupBy('p.reporter_id')
        ->orderByDesc('total_news')
        ->limit($limit);
        return $data->get();
    }

    public function dailyTraffic($month = null) {
        $data = $this->select('total_views', 'date')
        ->from('daily_traffic AS pop')
        ->whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))
        ->groupBy("date")
        ->orderBy('date');
        return $data->get();
    }

    public function montlyTraffic() {
        $data = $this->select($this->raw('SUM(total_pageviews) total, MONTH(last_view) as month'))
        ->from('popular_posts')
        ->groupBY('month')
        ->orderByDesc('month');
        return $data->get();
    }

}
