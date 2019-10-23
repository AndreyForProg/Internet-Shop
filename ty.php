<?
  print_r($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>заказ оформлен</title>
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
          <div class="cart_goods">0</div>
        </div>
      </a>
    </header>
  <!-- AND ШАПКА -->

  <h2 class="tyText">Спасибо. С вами в скором времени свяжутся!</h2>
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
<!-- end футер -->
</body>
</html>