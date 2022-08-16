<?php 
/*
* Code by DTT ( https://www.facebook.com/207DTT.MMO1 )
* Create date : 28/9/2020
*/
function getServices ($type = '') {
    global $db;
    $lists = array();
    if (!empty($type)) {
        $db->where('type', $type);
    }
    $data = $db->get('service', NULL, array(
        'service.*',
        '(SELECT COUNT(*) FROM data_service WHERE data_service.type_id = service.id AND data_service.status = 1) AS count_max'
    ));
    foreach ($data as $x) {
        $lists[$x['type']][] = $x;
    }
    return $lists;
}

function getHistory ($type = '') {
    global $db;
    $his = $db->join('users', '(users.uid = history.uid)', 'INNER')->orderBy('history.id', 'DESC');
    if (!empty($type)) {
        $his->where('history.type', $type);
    }
    $lists = $his->get('history', 10, array(
        'history.*',
        'users.username',
        'users.uid'
    ));
    return $lists;
}

function s ($code) {
    $code = trim($code);
    $code = htmlspecialchars($code, ENT_QUOTES);
    $code = addslashes($code);
    return $code;
}

function d ($arr = array()) {
    if (!is_array($arr)) {
        $arr = json_decode($arr, true);
    }
    header('Content-type: application/json');
    echo json_encode($arr, JSON_PRETTY_PRINT);
    exit();
}

function text_style ($t) {
    $t = str_replace("\n", '<br>', $t);
    $t = preg_replace_callback('/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', function ($a) {
        return '<a href="' . $a[0] . '" target="_blank">' . $a[0] . '</a>';
    }, $t);
    return $t;
}

function time_text ($t) {
    $musty = array('giây', 'phút', 'giờ', 'ngày', 'tuần', 'tháng', 'năm', 'thập kỷ');
    $format = array('60', '60', '24', '7', '4.35', '12', '10');
    $textTime = time() - $t;
    for ($i = 0; $textTime >= $format[$i] && $i < count($format) - 1; $i++) {
        $textTime /= $format[$i];   
    }
    return round($textTime) . ' ' . $musty[$i] . '  trước';
}

function str_rand ($length = 10) {
    $str = '';
    foreach (range(0, 9) as $a) {
        $text .= $a;
    }
    foreach (range('a', 'z') as $b) {
        $text .= $b;
    }
    foreach (range('A', 'z') as $c) {
        $text .= $c;
    }
    for ($i = 0; $i < $length; $i++) {
        $str .= $text[mt_rand(0, mb_strlen($text) - 1)];
    }
    return $str;
}

function move ($url) {
    header('Location: ' . $url);
    exit();
}

function custom_download ($path) {
    header('Content-Description: File Transfer');
    header('Content-type: application/zip');
    header('Content-disposition: attachment; filename=' . basename($path));
    header("Content-Transfer-Encoding: Binary");
    header("Content-length: " . filesize($path));
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    readfile("$path");
}

function cURL ($url, $data = NULL, $cookie = NULL, $headers = NULL, $proxy = NULL) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    // curl_setopt($ch, CURLOPT_HEADER, true);
    if (is_null($headers) === false) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    if (is_null($data) === false) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    }
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($ch, CURLOPT_TCP_NODELAY, 1);
    if (is_null($cookie) === false) {
        if ($cookie != 'is_cookie') {
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        } else {
            curl_setopt($ch, CURLOPT_COOKIE, 1);
        }
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    }
    if (is_null($proxy) === false) {
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
    }
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
?>