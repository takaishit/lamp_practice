<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';


function get_order($db, $user_id){
    $sql = "
      SELECT
        orders.id,
        orders.order_date,
        SUM(order_details.price * order_details.amount) AS total
      FROM
        orders
      JOIN
        order_details
      ON
        orders.id = order_details.order_id
      WHERE
        orders.user_id = ?
      GROUP BY
        order_id DESC;
    ";
    return fetch_all_query($db, $sql,[$user_id]);
  }
  function get_all_orders($db){
    $sql = "
      SELECT
        orders.id,
        orders.order_date,
        SUM(order_details.price * order_details.amount) AS total
      FROM
        orders
      JOIN
        order_details
      ON
        orders.id = order_details.order_id
      GROUP BY
        order_id DESC;
    ";
    return fetch_all_query($db, $sql);
  }

  function get_order_detail($db, $order_id, $user_id){
    $sql = "
      SELECT
        order_details.name,
        order_details.price,
        order_details.amount,
        SUM(order_details.price * order_details.amount) AS subtotal,
        orders.user_id
      FROM
        order_details
      JOIN
        orders
      ON
      order_details.order_id = orders.id
      WHERE
        order_details.order_id = ?
      AND
        orders.user_id = ?
      GROUP BY
      order_details.name,
      order_details.price,
      order_details.amount,
      orders.user_id
    ";
    return fetch_all_query($db, $sql,[$order_id,$user_id]);
  }
?>