<?php
session_start();
require_once 'functions.php';

// принимаем данные AJAX, вывод товара на главной странице по категории
 if (isset($_GET['action']) && $_GET['action'] === 'getGoods') {
  foreach (getGoods($_GET['category']) as $item) { ?>
    <div class="<? echo $item['category']; ?> good">
      <a href="product.php">
        <img src="<? echo $item['img'] ?>" alt="picture" class="good_image" data-toProductPage="<?= $item['id']; ?>">
      </a>
      <h4><? echo $item['good']; ?></h4>
      <p class="in_stoc">
        <?
          if ($item['in_stoc'] == 1) echo $item['category'];
          else echo "нет в наличии";
        ?>
      </p>
      <div class="price"><? echo $item['price']; ?> руб/кг</div>
      <button class="in_cart" data-inсart="<?= $item['id']; ?>">в корзину</button>
    </div>
  <?}
}

// принимаем данные с js и создаем массив $_SESSION['CartId'], в корзину
  if (isset($_GET['id']) && $_GET['action'] === 'add') {
  if (!isset($_SESSION['CartId']) || empty($_SESSION['CartId'])) {
    $_SESSION['CartId'] = [];
    $_SESSION['CartId'][] = [
      'id' => $_GET['id'],
      'quantity' => 1
    ];
  } else {
    $result = false;
    foreach ($_SESSION['CartId'] as &$item) {
      if ($item['id'] === $_GET['id']) {
        $item['quantity']++;
        $result = true;
      }
    }
    if (!$result) {
      $_SESSION['CartId'][] = [
        'id' => $_GET['id'],
        'quantity' => 1
      ];
    }
  }
  echo json_encode($_SESSION['CartId']);
}


// удаляем товар из корзины
if (isset($_GET['delProd'])) {
  foreach($_SESSION['CartId'] as $key => $good) {
    if ($good['id'] == $_GET['delProd']) {
      unset($_SESSION['CartId'][$key]);
    }
  }
}

// минус одна еденица товара
if (isset($_GET['action']) && ($_GET['action'] === 'delOneGood')) {
  $good = getGoods('', $_GET['product-id']);
  foreach( $_SESSION['CartId'] as $key => &$product ) {
    if ( ($product['id'] === $good[0]['id']) ) {
      if ( $product['quantity'] > 1 ) {
        $product['quantity'] -= 1;
      } elseif (( $product['quantity'] <= 1 )) {
        unset( $_SESSION['CartId'][$key] );
      }
    }
  }
}

// плюс одна еденица товара
if ( isset($_GET['action']) && $_GET['action'] === 'addOneGood' ) {
  $good = getGoods('', $_GET['product-id']);
  foreach( $_SESSION['CartId'] as $key => &$product ) {
    if ( ($product['id'] === $good[0]['id']) ) {
        $product['quantity'] += 1;
    }
  }
}

//при переходе на страницу продукта принимаем данные о продукте
if (isset($_GET['product_id']) && $_GET['action'] === 'toProductPage') {
  $_SESSION['toProductPage'] = [];
  $_SESSION['toProductPage'][] = [
    'id' => $_GET['product_id'],
    'currentGoods' => $_GET['currentGoods']
  ];
}