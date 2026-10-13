<?php

namespace app\admin\controller;

use app\admin\model\ReportModel;
use support\Request;

class Report {

    protected $mreport;

    public function __construct() {
        $this->mreport = new ReportModel();
    }

    public function traffic(Request $request) {
        $data['request'] = $request;
        $data['traffic_news_weekly'] = $this->mreport->getHighTraffic(30,7);
        $data['traffic_author'] = $this->mreport->getHighTrafficAuthor(15,7);
        $data['traffic_news_montly'] = $this->mreport->getHighTraffic(30, null, date("m"));
        $data['trending'] = $this->mreport->trending();
        $data['traffic_keyword'] = $this->mreport->getHighTraffic(15,7);
        $data['traffic_reporter'] = $this->mreport->getHighTrafficReporter(15,7);
        $data['daily_traffic'] = $this->mreport->dailyTraffic();
        // $data['monthly_traffic'] = $this->mreport->montlyTraffic();
        return view('dashboard', $data);
    }

    public function val($value_id, $value) {
        if($value_id) {
            $data = [
                "report_category_id" => 1,
                "name" => "persib bandung 2",
                "value" => $value,
                "value_id" => $value_id,
                "date" => date("Y-m-d")
            ];
            return json($this->mreport->generateReport($data));
        }
        return $value_id;
    }

    
}