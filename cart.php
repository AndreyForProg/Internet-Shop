<?php
  include 'functions.php';
  include 'actions.php';
  // error_reporting(0);
  // echo '<pre>';
  // var_dump($_SESSION['CartId']);
  // var_dump($_GET);
  // echo '<pre>';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Корзина</title>
  <link rel="stylesheet" href="styles/main.css">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">
  <script src="./script/jquery.js"></script>
</head>
<body>

<div class="container">

<!-- ШАПКА КОРЗИНЫ -->
  <header class="header">
    <a href="index.php #main" class="logo_link">
      <div class="logo">
        <img src="images/logofrut.png" class="imag_logo">
        <p class="logo_text">green shop</p>
      </div>
    </a>

    <div class="phone">
      <h5 class="phone_nomber">+38 099 148 30 27</h5>
    </div>

    <div class="navigation_header">
      <a href="index.php" class="navigation_header-item">Главная</a>
      <a href="index.php #main" class="navigation_header-item">Категории</a>
      <a href="delivery.php" class="navigation_header-item">Оплата и доставка</a>
      <a href="about.php" class="navigation_header-item">О нас</a>
    </div>

    <a href="cart.php">
      <div class="cart">
        <img src="images/cart.png">
        <div class="cart_goods"><?= getCountforCart()?></div>
      </div>
    </a>
  </header>
<!-- AND ШАПКА -->

<!-- СОДЕРЖИМОЕ КОРЗИНЫ -->
  <div class="cart-content">
    <div class="cart-header">
      <div class="cart-prod border">Товар</div>
      <div class="cart-price border">Цена</div>
      <div class="cart-current border">Количество</div>
      <div class="cart-sum border">Сумма</div>
    </div>

    <? if (!count($_SESSION['CartId'])) {
      echo 'в корзине пусто!';
      }  else {
       foreach ($_SESSION['CartId'] as $item) {
         $good = getGoods('', $item['id'])[0];
         $sum += $good['price']*$item['quantity'];
         $_SESSION['sum'] = $sum;
        ?>
  <div class="product">
    <div class="cart-prod_name">

      <!-- удалить товар -->
      <form action="" method="GET">
      <input type="hidden" name="delProd" value="<?= $good['id']?>">
        <button type="submit" class="del-but"><div class="del">&#10008;</div></button>
      </form>
      <a href="product.php">
        <img src="<? echo $good['img'] ?>" alt="picture" class="product_img" data-toProductPage="<?= $good['id']; ?>">
      </a>

      <p><? echo $good['good']; ?></p>
    </div>
    <div class="cart-price border-left"><? echo $good['price']; ?></div>
    <div class="cart-current border-left">
<!-- отнять еденицу товара -->
      <form action="" method="GET">
        <input type="hidden" name="action" value="delOneGood">
        <input type="hidden" name="product-id" value="<?= $good['id']; ?>">
        <button type="submit" class="delOneGood">-</button>
      </form>
      <!-- колличество едениц товара в корзине-->
      <input type="text" placeholder="<?= $item['quantity']; ?>" readonly>

<!-- прибавить еденицу товара -->

      <form action="" method='GET'>
        <input type="hidden" name="action" value="addOneGood">
        <input type="hidden" name="product-id" value="<?= $good['id']; ?>">
        <button type="submit" class="addOneGood">+</button>
      </form>

    </div>
    <div class="cart-sum border-left"><? echo ($good['price']*$item['quantity']); ?></div>
  </div>
      <? }} ?>
    </div>
  <div class="summ"><h4>общая сумма:</h4><?= $sum; ?></div>

<? require_once 'form.php' ?>

</div>
  <!-- футер -->
  <div class="footer_index">
      <div class="phone_nomber">+38 099 148 30 27</div>

      <form action="mailForBell.php" class="footer_form" method="POST">
        <input type="name" name="nameForBell" placeholder="введите ваше имя" required>
        <input type="phone" name="phoneForBell" placeholder="введите ваш телефон" required>
        <button type="submit">заказать звонок</button>
      </form>

      <a href="index.php" class="navigation_header-item">Главная</a>
    </div>

  <script src="script/main.js"></script>
</body>
</html>