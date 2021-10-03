<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'order.php';
session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
$token=get_csrf_token();

$db = get_db_connect();
$user = get_login_user($db);
//データの総数
$item_count = count(get_open_items($db));
//１ぺージあたりのデータ件数
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
if(isset($_GET['sort_button'])){

  if($_GET['sort'] == 'cheap'){
    $items = get_open_items_cheap($db,$offset,$limit);
  }else if($_GET['sort'] == 'expensive'){
    $items = get_open_items_expensive($db,$offset,$limit);
  }else{
    $items = get_open_items_new($db,$offset,$limit);
  }
}else{
  $items = get_open_items_new($db,$offset,$limit);
}
$param = '';
if(isset($_GET['sort_button'])){
  $param .= '&sort_button='.$_GET['sort_button'];
}
if(isset($_GET['sort'])){
  $param .= '&sort='.$_GET['sort'];
}
$items_page_count = count($items);
$ranking = get_order_ranking($db);
include_once VIEW_PATH . 'index_view.php';