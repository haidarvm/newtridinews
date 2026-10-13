<?php

namespace app\process;

use Workerman\Crontab\Crontab;
use app\model\HomeModel;
use app\model\PopularModel;
use support\Redis;

class Task {
    public function onWorkerStart() {
        // Run every 5 minute
        new Crontab('0 */5 * * * *', function () {
            Redis::set('hai', "haidar" . date('Y-m-d H:i:s'));
            $mhome = new HomeModel();
            $terkini = json_encode($mhome->getLatestCat('', 3));
            Redis::set('terkini', $terkini);
            // echo date('Y-m-d H:i:s')."\n";
        });

        new Crontab('0 */30 * * * *', function () {
            $mhome = new HomeModel();
            $mpop = new PopularModel();
            $bobotoh =  json_encode($mhome->getLatestCat('bobotoh', 5));
            Redis::set('bobotoh', $bobotoh);
            $bolnas =  json_encode($mhome->getLatestCat('bolnas', 5));
            Redis::set('bolnas', $bolnas);
            $ragam =  json_encode($mhome->getLatestCat('ragam', 5));
            Redis::set('ragam', $ragam);
            $popular = json_encode($mpop->getPopular());
            Redis::set('popular', $popular);
            $teras = json_encode($mhome->getLatestApiDb());
            Redis::set('teras', $teras);
            // echo date('Y-m-d H:i:s')."\n";
        });

    }
}
