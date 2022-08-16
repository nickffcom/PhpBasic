<?php 
/*
* Code by DTT ( https://www.facebook.com/207DTT.MMO1 )
* Create date : 28/9/2020
*/

// echo phpinfo();
// return;

require_once 'core/config.php'; // trang nào cũng vào đây , rồi hiển thị page path 

// Đây là trang Index.php
if (!$is_log) {
    $page = 'login';
} else {
    $page = 'home';
}

if (isset($_GET['p']) && !empty($_GET['p'])) {
    $page = s($_GET['p']);
}

if (in_array($page, array('login', 'register'))) {
    if ($is_log) {
        $page = '404';
    }
} else {
    if (!$is_log) {
        $page = '404';
    }
}

$page_title = 'Trang chủ';

switch ($page) {

    case 'login':
        $page_title = 'Đăng nhập';
        $page_path = 'login.php';
        break;

    case 'register':
        $page_title = 'Đăng ký tài khoản';
        $page_path = 'register.php';
        break;

    case 'logout':
        session_destroy();
        move('/');
        break;

    case 'admin':
        if ($is_admin && in_array($_GET['act'], array(
            'settings',
            'users',
            'trans',
            'statics',
            'notify',
            'history',
            'add',
            'manage',
            'type',
            'upload'
        ))) {
            if (in_array($_GET['act'], array('add', 'manage', 'type', 'upload'))) {
                $type = $_GET['type'];
                if (empty($type) || !in_array($type, $typeVaild)) {
                    exit();
                }
                $page_path = 'admin/service/' . $_GET['act'] . '.php';
            } else {
                $page_path = 'admin/' . $_GET['act'] . '.php';
            }
        } else {
            $page = '404';
        }
        break;

    case 'tools':
        if (array_key_exists($_GET['act'], $freeToolsLists)) {
            $page_path = 'tools/' . $_GET['act'] . '.php';
        } else {
            $page = '404';
        }
        break;

    case 'check-limit-bm':
        $page_path = 'tools/check_limit_bm.php';
        break;

    case 'check-live-bm':
        $page_path = 'tools/check_live_bm.php';
        
        break;
    
    case 'check-live-uid':
            $page_path ='tools/check_live_uid.php';
            break;
    case 'tool-mien-phi':
            $page_path ='tools/tool_mien_phi.php';
            break;
    case 'mua-proxy':
            $page_path ='tools/mua_proxy.php';
            break;
    case 'share-clone-to-via':
            $page_path ='tools/share_clone_to_via.php';
            break;
    case 'check-limit-ads':
            $page_path ='tools/check_limit_ads.php';
            break;
    case 'share-clone-to-bm':
            $page_path ='tools/share_clone_to_bm.php';
            break;
    case 'check-info-via':
            $page_path ='tools/check_info_via.php';
            break;
    case 'reg-bm':
            $page_path ='tools/reg_bm.php';
            break;
                
    case 'check-sai-pass':
            $page_path ='tools/check_sai_pass.php';
            break;
               
    case 'kich-momo':
            $page_path ='tools/kich_momo.php';
            break;
    case 'change-info-ads':
            $page_path ='tools/change_info_ads.php';
            break;
    case 'len-camp':
            $page_path ='tools/len_camp.php';
            break;
    case 'note-tool':
             $page_path='tools/note_tool.php';
             break;     
                       
    case 'home':
        $page_path = 'home.php';
        break;

    case 'order':
        $page_path = 'order.php';
        break;
    case 'order_proxy':
        $page_path = 'order_proxy.php';
        break;
    
    case 'tai-khoan':
        $page_path = 'profile.php';
        break;

    case 'nap-tien':
        $page_path = 'pay.php';
        break;

    case 'lich-su-nap-tien':
        $page_path = 'history_pay.php';
        break;

    case 'lich-su-thanh-toan':
        $page_path = 'history_buy.php';
        break;

    case 'ho-tro':
        $page_path = 'support.php';
        break;

    default:
        $page = '404';
        break;
}

if ($page == '404') {
    move('/');
}

$page_title = "$page_title | $header_title";

include 'views/main.php'; // NÓ XÀI CÁI NAVBAR CHUNG , CÒN PHẦN NÀO CŨNG CÓ 
?>