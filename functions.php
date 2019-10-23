<?php
require_once 'db.php';
// получаем товоры категории
function getGoods($category = '', $id = '') {
  global $bd;
  $good = "SELECT * FROM goods";
  if (!empty($category)) {
    $good .= " WHERE category = '{$category}'";
  }

  if (!empty($category) && !empty($id)) {
    $good .= " AND";
  }

  if (!empty($id)) {
    $good .= " WHERE id = '{$id}'";
  }

  $query = mysqli_query($bd, $good);
  return mysqli_fetch_all($query, MYSQLI_ASSOC);
}

// колличество товаров в корзине
function getCountforCart() {
  if ($_SESSION['CartId']) {
    $goodsInCart = count($_SESSION['CartId']);
    return $goodsInCart;
  } else {
    return 0;
  }
}

// текст после формы отправки заказа
function formText() {
  if ( isset($_GET['phone']) && isset($_GET['name'])) {
    session_destroy();
    return 'Спасибо за заказ. С вами скоро свяжутся!';
  } else {
    return 'оформить заказ';
  }
}

?>