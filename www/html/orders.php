<?php
//読み込み
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'order.php';
//セッション開始
session_start();
//
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
$token=get_csrf_token();

$db = get_db_connect();
$user = get_login_user($db);
if(is_admin($user) === true){
  $orders = get_all_orders($db);
}else{

  $orders = get_order($db, $user['user_id']);
}

include_once VIEW_PATH . 'order_view.php';