<?
include 'functions.php';
include 'actions.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="styles/product.css">
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

<!-- инфо о товаре -->
<? $good = getGoods('', $_SESSION['toProductPage'][0]['id']); ?>
    <div class="product_page">
      <div class="prod_image">
        <img src="<?= $good[0]['img']; ?>" alt="">
      </div>
      <div class="prod_descr">
        <div><h3><?= $good[0]['good']; ?></h3></div>
        <div class="product_price"><h4><?= $good[0]['price']; ?> руб/кг.</h4></div>
        <div class="descr">Описание: <?= $good[0]['description']; ?>fkjdskljfklasjfaskldjfl jfklasldfjklasjd jsklfjasklfjklasjklfjaskldj fjaskljfklsdjklfjasdkljfklalk</div>
        <button class="product_in-cart" data-inсart="<?= $good[0]['id'];?>">в корзину</button>
      </div>
    </div>
  <div class="added_to_cart">товар добавлен в корзину</div>


  <!-- выводим подобные товары группы -->
  <h3 class="similar-tittle">Подобные товары</h3>
  <? $similarGood = getGoods($good[0]['category'], '');  ?>

  <div class="similar-products">
  <? foreach($similarGood as $item) {?>
    <? if ($item['id'] !== $good[0]['id']) {?>
    <div class="similar-product">
      <a href="product.php">
        <img src="<?= $item['img']; ?>" alt="" data-toProductPage="<?= $item['id']; ?>" class="good_image">
      </a>
      <h5 class="similarGoodTitle"><?= $item['good']; ?></h4>
      <h5><?= $item['price']; ?> руб.</h5>
    </div>
  <?}}?>
  </div>


  <!-- футер -->

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