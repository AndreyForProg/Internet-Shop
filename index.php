<?
  require_once 'categories.php';
  require_once 'actions.php';

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Green Shop</title>
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">
  <link rel="stylesheet" href="styles/main.css">
  <script src="./script/jquery.js"></script>
</head>
<body>


<div class="container">

<!-- шапка магазина -->
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

    <a href="cart.php" class="link-cart">
      <div class="cart">
        <img src="images/cart.png">
        <div class="cart_goods"><?= getCountforCart(); ?></div>
      </div>
    </a>
  </header>
<!-- end header -->

  <!-- слайдер -->
  <section class="slider">
    <div class="slider_cantainer">
      <img src="images/slider1.jpg" class="img-slider img-slider1">
      <img src="images/slider2.jpg" class="img-slider img-slider2">
      <img src="images/slider3.jpg" class="img-slider img-slider3">
      <img src="images/slider4.jpg" class="img-slider img-slider4">
    </div>
    <!-- стрелки -->
    <img src="images/buttonSlider.png" class="slider-button slider-button_left">
    <img src="images/buttonSlider.png" class="slider-button slider-button_right">
  </section>
  <!-- and слайдер -->


  <main class="main" id="main">
<!--список категорий Фрукты Животные Разное -->
    <nav>
      <ul class="categories">
        <?php foreach ($categories as $category) { ?>
          <li data-category="<?php echo $category['title']; ?>">
            <img src="images/<?php echo $category['icon']; ?>" class="categories_img">
            <?php echo $category['title']; ?>
          </li>
        <?php } ?>
      </ul>
    </nav>

    <!-- все товары -->
      <div class="all_goods" id="all_goods">
        <? foreach (getGoods() as $item) { ?>
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
        <? } ?>
      </div>
  </main>
  <div class="added_to_cart" id="gg">товар добавлен в корзину</div>

</div>

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