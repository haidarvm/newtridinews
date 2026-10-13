<?php

namespace app\admin\controller;

use app\admin\model\ReportModel;
use support\Request;
use app\admin\controller\Report;
use \AllowDynamicProperties;


class Dashboard {
    protected $mreport;
    protected $report;

    public function __construct() {
        $this->mreport = new ReportModel();
        $this->report = new Report();
    }

    public function index(Request $request) {
        $data['request'] = $request;
        return view('dashboard', $data);
    }

    public function traffic(Request $request) {
       return $this->report->traffic($request);
    }

    public function author() {
        $data['data'] = $this->mreport->getAllAuthor();
        return json($data);
    }

    public function cat(Request $request) {
       $cat =  $this->mreport->getReportCat(1);
       return json($cat);
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
