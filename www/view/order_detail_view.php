<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入履歴</title>
  <link rel="stylesheet" href="<?php print h(STYLESHEET_PATH . 'admin.css'); ?>">
</head>
<body>
  <?php 
  include VIEW_PATH . 'templates/header_logined.php'; 
  ?>

  <div class="container">
    <h1>購入履歴画面</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

      <table class="table table-bordered text-center">
        <thead class="thead-light">
          <tr>
            <th>注文番号</th>
            <th>購入日時</th>
            <th>合計金額</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($orders as $order){ ?>
          <tr>
            <td><?php print h($order['id']);?></td>
            <td><?php print h($order['order_date']); ?></td>
            <td><?php print h($order['total']); ?>円</td>
            <td>
              <form method="post" action="order_detail.php">
                <input type="submit" value="詳細" class="btn btn-secondary">
                <input type="hidden" name="id" value="<?php print h($order['id']); ?>">
                <input type="hidden" name= "token" value="<?php print h($token); ?>">
              </form>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    <table class="table table-bordered text-center">
        <thead class="thead-light">
          <tr>
            <th>商品名</th>
            <th>商品価格</th>
            <th>購入数</th>
            <th>小計</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($details as $detail){ ?>
          <tr>
            <td><?php print h($detail['name']);?></td>
            <td><?php print h($detail['price']); ?>円</td>
            <td><?php print h($detail['amount']); ?>個</td>
            <td><?php print h($detail['subtotal']); ?>円</td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
  </div>
</body>
</html>