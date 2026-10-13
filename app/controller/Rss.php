<?php

namespace app\controller;

use app\model\HomeModel;
use support\Request;

// use Feed;
class Rss {

    protected $mhome;
    public function __construct() {
        $this->mhome = new HomeModel();
    }

    public function index(Request $request, $cat = null) {
        // $rss = Feed::loadRss($url);
        $title = !empty($cat) ? $cat : 'Berita Terikini';
        // Define your feed data
        $feedTitle = 'My Website Feed';
        $feedDescription = 'News aAnd Service';
        $feedDate = strtotime(date('D d M Y H:i:s O'));


        // Start outputting XML
      
        $data = $this->mhome->getLatestAPI($cat, 30, null, null, null, null, 1);
        $feed = '<?xml version="1.0" encoding="utf-8"?>
                <rss version="2.0">
                <channel>
                <title>'.env("APP"). "- $title".'</title>
                <link>'.base_url().'</link>
                <description>'.$feedDescription.'</description>
                <lastBuildDate>'.$feedDate.'</lastBuildDate>
                <pubDate>'.$feedDate.'</pubDate>
                <ttl>60</ttl>';
        $i = 0;
        foreach ($data as $rss) {
            // $i++;
            // if ($i>14){
            //     break;
            // }
            $keywords = $this->mhome->getAllKeywordByID($rss->ID);
            $description = !empty($rss->description) ? $rss->description : metaDescription($rss->post_content); 
            $feed .= '<item>';
            $feed .= '<title>' . htmlspecialchars($rss->post_title) . '</title>';
            $feed .= '<description>' . htmlspecialchars($description) . '</description>';
            $feed .= '<content>' .htmlspecialchars($rss->post_content) . '</content>';
            $feed .= '<link>' .htmlspecialchars($rss->url) . '</link>';
            $feed .= '<enclosure length="0" type="image/jpeg" url="'.htmlspecialchars($rss->img).'"/>';
            $feed .= '<guid>' .htmlspecialchars($rss->url) . '</guid>';
            foreach($keywords as $keyword) {
                $feed .= '<category>';
                $feed .= htmlspecialchars($keyword->keyword);
                $feed .= '</category>';
            }
            $feed .= '</item>';
        }
        $feed .= '</channel>';
        $feed .= '</rss>';
        $response = response();
        $response->header('Content-Type', 'text/xml');
        $response->withBody($feed);
        return $response;

    }
}
