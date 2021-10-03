<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
$token=get_csrf_token();

$db = get_db_connect();

$user = get_login_user($db);

if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}
$limit = 8;
//最大ページ数
$max_page = ceil($item_count / $limit);
//ページを取得、GETで渡ってこない場合、最初のページにする
if(isset($_GET['page']) && is_numeric($_GET['page'])){  
  $page = $_GET['page'];
}else{
  $page = 1;
}
if($page == 1 || $page == $max_page){ 
  $range = 4;
}else if($page == 2 || $page == $max_page -1){
  $range = 3;
}else{
  $range = 2;
}
if($page == 1 ){
  $offset = 0;
} else{
  $offset = ($page -1) * $limit;
}
$items = get_all_items_new($db,$offset,$limit);
include_once VIEW_PATH . '/admin_view.php';
