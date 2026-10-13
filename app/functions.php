<?php
/**
 * Here is your custom functions.
 */
function haidar($name) {
    return $name . 's';
}

function base_url() {
    // $base_url = env('BASE_URL');
    $request = request();
    $base_url = env('PROTOCOL') . $request->header('host') . '/';
    return $base_url;
}

function imgFullPath() {
    $fullpath = '/assets/uploads/' . date('Y') . '/' . date('m') . '/';
    if (file_exists($fullpath)) {
        return $fullpath;
    }
    return  createImgPath();
}

function imgFull() {
    return  '/assets/uploads/' . date('Y') . '/' . date('m') . '/';
}

function imgPath() {
    return date('Y') . '/' . date('m') . '/';
}

function imgPathUrl() {
    return base_url() . 'assets/uploads/' . date('Y') . '/' . date('m') . '/';
}

function imgBasePathUrl($img) {
    return base_url() . 'assets/uploads/' . $img;
}

function imgAdsUrl() {
    return base_url() . 'assets/img/';
}

function imgAdsPathUrl($img) {
    return base_url() . 'assets/img/' . $img;
}

function readUrl($date, $title) {
    return base_url() . wpDate($date) . '/' . str_slug($title);
    // return base_url() . 'read/' . $ID . '/' . str_slug($title);
}

function productUrl($title) {
    return base_url() . 'store/' . str_slug($title);
    // return base_url() . 'read/' . $ID . '/' . str_slug($title);
}

function readAmpUrl($date, $title) {
    return base_url() . 'amp/' . wpDate($date) . '/' . str_slug($title);
    // return base_url() . 'read/' . $ID . '/' . str_slug($title);
}

function readUrlOld($date, $title = null) {
    return base_url() . wpDate($date) . '/' . str_slug($title);
    // return base_url() . 'read/' . $ID . '/' . str_slug($title);
}

function getExtMime($mime) {
    $str = explode('/', $mime);
    return $str[1];
}

function readContent($content) {
    // single newline dont use br
    $text = allowTags(nl2br($content));
    // return preg_replace('#<br />(\s*<br />)+#', '<br />', ($text));
    // var_dump($text);
    return $text;
}

function newbr($text) {
    return str_replace("\n", '<br />', $text);
}

function countBr($content) {
    return substr_count($content, '<br />');
}

function countEOL($content) {
    return substr_count($content, "\r\n");
}

function getCenter($total) {
    return floor($total / 2);
}

function cleanDesc($text) {
    return  preg_replace('/[^a-zA-Z]/', '', $text);
}

function metaDescription($content) {
    $clearApp = str_ireplace('REPUBLIK BOBOTOH', ' ', $content);
    $cleanContent = strip_tags(html_entity_decode($clearApp));
    $cleanContents = strip_tags(html_entity_decode(trim($cleanContent)));
    $removeEmpty = preg_replace('/\s*$/', ' ', $cleanContents);
    $cleanChar = preg_replace('/[^A-Za-z0-9 !@#$%^&*().]/u', ' ', strip_tags($removeEmpty));
    $arrText = array_filter(explode(' ', $cleanChar));
    $lastText = implode(' ', $arrText);
    return substr($lastText, 0, 170);
    // return $content;
}

function getPage($text, $page_index, $page_length=10) {
    $page = $page_index -1;
    $texts = explode("\n", readContent($text));
    $text_clean = preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $texts);
    // var_dump($text_clean);
    $real_text =  preg_replace("/<br\W*?\/>/", '', $text_clean);
    $full_text = [];
    foreach ($real_text as $num => $text) {
        if (strlen(trim($text)) > $page_length) {
            // var_dump($text);
            $full_text[] = ($text) . '';
        }
    }
    $page_lines = array_slice($full_text, $page*$page_length, $page_length);
    $new_lines = implode("\n", $page_lines);
    return preg_replace('/(<br>)+$/', '', $new_lines);
    // return ;
}

function countPage($text) {
    $texts = explode("\n", readContent($text));
    $text_clean = preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $texts);
    // var_dump($texts);
    $real_text =  preg_replace("/<br\W*?\/>/", '', $text_clean);
    $full_text = [];
    foreach ($real_text as $num => $text) {
        $clean_text = trim($text);
        if (strlen(trim($clean_text)) > 8) {
            // var_dump($text);
            $full_text[] = trim($text) . '';
        }
    }
    return ceil(count($full_text)/8);
}

function singArray($array, $column) {
    $array = json_decode(json_encode($array), true);

    $arraySearch = array_column($array, $column);
    $arraySearch = str_replace('-', ' ', $arraySearch);
    $arraySearchTrim = array_map('trim', $arraySearch);
    // var_dump($arraySearchTrim);
    return $arraySearchTrim;
}

function urlKeyword($keyword) {
    return '<a href="' . base_url() . 'tag/' . $keyword . '">' . $keyword . '</a>';
}

function strKeyword($keyword) {
    return str_replace('', '-', $keyword);
}

function readAlso($text, $adsone = null, $adstwo = null, $adstrhee = null, $tags = null) {
    // $texts_tag = addTags($text);
    // $centerx = getCenter(countBr(nl2br($texts_tag)));
    $pexists = 1;
    $texts = explode(PHP_EOL, $text);
    // var_dump($texts);
    $newline = "\r\n";
    $i = 0;
    $full_text = '';
    $count = count($texts);
    foreach ($texts as $text) {
        $tagtext = addTags($text, $tags);
        // var_dump($tagtext);
        $full_text .= $pexists == true ? replaceP($tagtext) : $tagtext;
        if ($i == 8 && !empty($adstwo)) {
            $full_text .= $adstwo . '</br>' . $newline;
            $full_text .= $adstrhee;
        }
        if ($i == 9 && !empty($adsone)) {
            $full_text .= $adsone . $newline. '</br>';
        }
        $i++;
    }
    return $full_text ;
}
function addTag($search, $string) {
    // var_dump($string);
    $arraySearch = singArray($search, 'keyword');
    if (!is_array($arraySearch)) {
        $arraySearch = [$arraySearch];
    }
    $arraySearch = str_replace('/', '\/', $arraySearch);
    return preg_replace("/\b(" . implode('|', $arraySearch) . ")\b/i", urlKeyword('$1'), $string);
}

function addTags($text, $tags = null) {
    $search = '<a';
    $img = '<img';
    if (preg_match("/{$search}/i", $text)) {
        $newText =  $text;
    } elseif (preg_match("/{$img}/i", $text)) {
        $newText =  $text;
    } else {
        $newText =  !empty($tags) ? addTag($tags, $text) : $text;
    }
    return $newText;
}

function removeiframe($str) {
    $string = preg_replace('/<iframe.*?\/iframe>/i', '', $str);
    return $string;

}

function remscript($html) {
    $html  =  preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
    return $html;
}

function matchytb($content) {
    $str = '<iframe width="560" height="315" src="https://www.youtube.com/embed/RrigwiPQ9RE?si=dyZVFvCB8SVhVDHR" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>';
    $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
    if (preg_match($pattern, $content, $match)) {
        $ampytb = '<amp-youtube
        data-videoid='.$match[1].'
        layout="responsive"
        width="480" height="270"></amp-youtube>';
        return $ampytb;
    } else {
        return false;
    }
}

function readAMP($text) {
    $read_text = readAlso($text);
    $content = str_replace('https://www.youtube.com/embed/', '', $read_text);
    $contents = str_replace('xmlns="http://www.w3.org/1999/xhtml"', '', $read_text);
    $watch = matchytb($contents);
    $rems = remscript($contents);
    $remi = removeiframe($rems);
    $html = '';
    $html_old = preg_replace('/<iframe\s+.*?\s+src=(".*?").*?<\/iframe>/', '<amp-youtube
    data-videoid=$1
    layout="responsive"
    width="480" height="270"></amp-youtube>', $contents);
    
    $html .= $remi;
    $html .= $watch;
    return $html;
}


function replaceP($text) {
    return '<p>' . $text . '</p>';
}

function getYoutube($url) {
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
        $values = $id[1];
    } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
        $values = $id[1];
    } elseif (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
        $values = $id[1];
    } elseif (preg_match('/youtube\.com\/live\/([^\&\?\/]+)/', $url, $id)) {
        $values = $id[1];
    } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
        $values = $id[1];
    } elseif (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
        $values = $id[1];
    }
    return $values;
}

function pathToUrl($fullpath) {
    $filename = getFileNameExt($fullpath);
    return imgPathUrl() . $filename;
}

function pathAdsToUrl($fullpath) {
    $filename = getFileNameExt($fullpath);
    return imgAdsUrl() . $filename;
}

function getUri($url, $num) {
    $uri = explode('/', $url);
    $getUri = array_slice($uri, $num, true);
    if (!empty($getUri[0])) {
        return $getUri[0];
    } else {
        return false;
    }
}

function wpDate($date) {
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    return $date->format('Y/m/d');
}

function checkFuture($datetime) {
    $today = strtotime(date('Y-m-d H:i:s'));
    $input = strtotime($datetime);
    if ($input > $today) {
        return 'future';
    }
    return 'publish';
}

function adminBrToNewline($text) {
    $breaks = ['<br />', '<br>', '<br/>'];
    $text = str_ireplace($breaks, "\r\n", $text);
    return $text;
}

function checkCatId($group_cat_id, $find_cat_id) {
    if (!empty($group_cat_id)) {
        $cat_id = explode(',', $group_cat_id);
        return in_array($find_cat_id, $cat_id) ? true : false;
    }
    return false;
}

function allowTags($text) {
    // $text ='';
    // $content = preg_replace('#<p(.*?)>(.*?)</p>#is', '$2<br/>', $text);
    // $content = str_replace("</p>", "\r\n", $text);
    $tags = '<strong><h1><h2><h3><h4><br><hr><b><ol><ul><u><li><a><img><iframe><blockquote><script><div><i>';
    return strip_tags(html_entity_decode(trim($text)), $tags);
}

function adminSaveContent($text) {
    $removepend = str_ireplace('</p>', "\r\n\r\n", $text);
    $removep = str_ireplace('<p>', '', $removepend);
    $hapus = ['<br />', '<br>', '<br/>'];
    $removebr = str_ireplace($hapus, "\r\n", $removep);
    return $removebr;
}

function cleanTags($content) {
    return brToNewLine($content);
}

function brToNewLine($text) {
    return str_replace('<br />', '\\n', $text);
}

function getNewLine($text) {
    return str_replace("\n", '\\n', $text);
}

function createImgPath() {
    $path = '/assets/uploads/';
    $year_folder = $path . date('Y');
    $month_folder = $year_folder . '/' . date('m');

    !file_exists($year_folder) && mkdir($year_folder, 0777);
    !file_exists($month_folder) && mkdir($month_folder, 0777);

    $path = $month_folder;
    return $path . $month_folder;
}

function saveNewFile($filecomplete, $prefix, $fullpath) {
    $newFile = getFileName($filecomplete) . '_' . $prefix . '.jpg';
    return  $fullpath . imgFull() . $newFile;
}

function saveAdsFile($filecomplete, $prefix, $fullpath) {
    $newFile = getFileName($filecomplete) . '_' . $prefix . '.jpg';
    return  $fullpath . '/assets/img/' . $newFile;
}

function uniqeID() {
    return base_convert(rand(1000000000, PHP_INT_MAX), 10, 36);
}

function shortUniq() {
    $str=rand();
    $result = md5($str);
    return substr($result, 0, 4);
}

function getFileName($filecomplete) {
    return str_slug(pathinfo($filecomplete, PATHINFO_FILENAME));
}

function getFileNameExt($filecomplete) {
    return pathinfo($filecomplete, PATHINFO_BASENAME);
}

function getFileExt($filecomplete) {
    return '.' . pathinfo($filecomplete, PATHINFO_EXTENSION);
}

function str_slug($string, $separator = '-') {
    // Convert all dashes/underscores into separator
    $flip = '-' == $separator ? '_' : '-';
    $string = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, $string);

    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    $string = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', mb_strtolower($string));

    // Replace all separator characters and whitespace by a single separator
    $string = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $string);
    return trim($string, $separator);
}

function str_unslug($string, $separator = '-') {
    return ucwords(str_replace($separator, ' ', $string));
}

function cleanSearch($search) {
    if ($search) {
        return str_replace('-', ' ', trim($search));
    }
}

function nullSearch($search) {
    return !empty($search) ? $search : 'all';
}

function urlSearch($search) {
    return str_replace(' ', '-', $search);
}

function rupiah($angka) {
    $hasil_rupiah = 'Rp ' . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function uang($angka) {
    $uang = number_format($angka, 0, ',', '.');
    return $uang;
}

function nums($number) {
    $number = number_format($number, 0, ',', ',');
    return $number;
}

function short_desc($desc) {
    return substr($desc, 0, 50);
}

function indoDate($date) {
    return date('d-m-Y', strtotime($date));
    // return strftime('%u %b %y', strtotime($date));
    // return time_elapsed_string($date);
}

function isoDate($date) {
    return date(DATE_ISO8601, strtotime($date));
}

function tglJamDate($date) {
    return date('d-m-Y, H:i', strtotime($date));
    // return strftime('%u %b %y', strtotime($date));
    // return time_elapsed_string($date);
}

function indosDate($date) {
    return date('d M Y', strtotime($date));
}

function indoFullDate($date) {
    return date('d F Y', strtotime($date));
}

function currentDate($date) {
    return date('D, d M Y', strtotime($date));
}

function indoEDate($date) {
    return date('d/m/Y', strtotime($date));
}

function sqlDate($date) {
    $dates = str_replace('/', '-', $date);
    return date('Y-m-d', strtotime($dates));
}

function autoParagraph($content) {
    $style = '';
    if (strpos($content, '<p') !== false) {
        $style = ' style="white-space:normal"';
    }
    return $style;
}
function indoDateTime($date) {
    return date('d-m-Y H:i', strtotime($date));
}

function getTimeOnly($datetime) {
    return date('H:i:s', strtotime($datetime));
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = [
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    ];
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v ;
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) {
        $string = array_slice($string, 0, 1);
    }
    return $string ? implode(', ', $string) . ' yg lalu' : 'baru';
}

function replacePersib($keyword) {
    $search = ['persib,', 'liga 1,'];
    $replace = ['', ''];
    $result = str_ireplace($search, $replace, $keyword);
    return $result;
}
