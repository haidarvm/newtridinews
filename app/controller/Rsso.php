<?php

namespace app\controller;

use app\model\HomeModel;
use support\Request;
use Bhaktaraz\RSSGenerator\Item;
use Bhaktaraz\RSSGenerator\Feed;
use Bhaktaraz\RSSGenerator\Channel;

class Rss
{
    public function __construct() {
        $this->mhome = new HomeModel();
    }

    public function index(Request $request, $cat = null) {
        $feed = new Feed();
        $channel = new Channel();
        $title = !empty($cat) ? $cat : 'Berita Terikini';
        $channel
                ->title(env("APP")." - $title")
                ->description('News And Service')
                ->url(base_url())
                ->language('id-ID')
                ->copyright('Copyright ' . date('Y') . ', '.env("APP") )
                ->pubDate(strtotime(date('D d M Y H:i:s O')))
                ->lastBuildDate(strtotime(date('D d M Y H:i:s O')))
                ->updateFrequency(1)
                ->updatePeriod('hourly')
                ->ttl(60)
                ->appendTo($feed);

        $data = $this->mhome->getLatestAPI($cat, 30, null, null, null, null, 1);
        foreach ($data as $rss) {
            $keywords = $this->mhome->getAllKeywordByID($rss->ID);
            $description = !empty($rss->description) ? $rss->description : metaDescription($rss->post_content); 
            $item = new Item();
            $item
                ->title($rss->post_title)
                ->creator($rss->display_name)
                ->description($description)
                ->content($rss->post_content)
                ->url($rss->url)
                ->pubDate(strtotime($rss->post_date))
                ->enclosure($rss->img, 25000, 'image/jpeg')
                ->guid($rss->url, true)
                ->appendTo($channel);
                foreach($keywords as $keyword) {
                    $item->category($keyword->keyword);
                }
        }
        $response = response();
        $response->header('Content-Type', 'text/xml');
        $response->withBody($feed->render());
        return $response;
    }
}
