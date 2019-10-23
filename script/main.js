const sliderInit = () => {
  // СЛАЙДЕР
  let images = document.querySelectorAll('.img-slider');
  let buttons = document.querySelectorAll('.slider-button');
  let current = 0;

  if (!images || !buttons || !images[current]) return;

  images[current].classList.add('opacity1');


  // кнопка в лево
  buttons[0].addEventListener('click', () => {
    clearInterval(interval);
    setInterval(slider, 10000);
    if ( current === 0 ) {
      images[current].classList.remove('opacity1');
      current = 3;
      images[current].classList.add('opacity1');
    } else {
    images[current].classList.remove('opacity1');
    images[current-1].classList.add('opacity1');
    current--;
    }
  })

  // кнопка в право
  buttons[1].addEventListener('click', slider);

  // для цыкла слайда
  function slider() {
    if ( current == (images.length - 1) ) {
      images[current].classList.remove('opacity1');
      current = 0;
      images[current].classList.add('opacity1');
    } else {
      images[current].classList.remove('opacity1');
      images[current+1].classList.add('opacity1');
      current++;
    }
  }

  let interval = setInterval(slider, 5000);
  // and слайдер
};

document.addEventListener('DOMContentLoaded', () => {

  sliderInit();

  // КОРЗИНА
  let inCart = document.querySelector('.in_cart');
  let inCartProd = document.querySelector('.product_in-cart');
  let cartGoodsCurrent = document.querySelector('.cart_goods');
  let allGoods = document.querySelector('.all_goods');
  const added = document.querySelector('.added_to_cart');
  let currentGoods = 0;
  let cartArrayId = [];


// отправляем запрос на сервер, передаем данные о товаре, который добавили в корзину
  if (allGoods) {
    allGoods.addEventListener('click', (e) => {
      if ( e.target.className === 'in_cart' ) {
        currentGoods++;
      $.ajax({
        method: 'GET',
        url: './actions.php',
        data: {
          id: e.target.dataset['inсart'],
          action: 'add',
        },
        success: function(data) {
          data = JSON.parse(data);
          cartGoodsCurrent.textContent = Object.keys(data).length;
        }
      });

      // надпись "товар добавлен в корзину"
      added.style.opacity = 1;
      function addedOp() {
        added.style.opacity = 0;
      }
      setTimeout(addedOp, 3000);
      // end корзина
      } else {
        //переход на страничку товара
        $.ajax({
          method: 'GET',
          url: './actions.php',
          data: {
            product_id: e.target.dataset['toproductpage'],
            currentGoods: currentGoods,
            action: 'toProductPage',
          },
          success: function(data) {
            console.log(data);
          }
        });
      }
    });
  }

  if (inCartProd) {
  // добавление товара в корзину со страницы товара
  inCartProd.addEventListener('click', function(e) {
      currentGoods++;
      $.ajax({
        method: 'GET',
        url: './actions.php',
        data: {
          id: e.target.dataset['inсart'],
          action: 'add',
        },
        success: function(data) {
          data = JSON.parse(data);
          cartGoodsCurrent.textContent = data.length;
        }
      });
      // надпись "товар добавлен в корзину"
      added.style.opacity = 1;
      function addedOp() {
        added.style.opacity = 0;
      }
      setTimeout(addedOp, 3000);
    })
  }

  // ТАБЫ
  const categories = document.querySelector('.categories');
  const product = document.querySelectorAll('.good');

  if (categories) {
    categories.addEventListener('click', (e) => {
      if (e.target.tagName === 'LI') {
        let category = e.target.dataset.category;
        if (category === 'Все товары') category = '';
        getProducts(category);
      }
    });
  }

  function getProducts(category = '') {
    const request = {
      method: 'GET',
      url: './actions.php',
      data: {
        category: category,
        action: 'getGoods',
      },
      success: function(data) {
        document.getElementById('all_goods').innerHTML = data;
      },
    };
    $.ajax(request);
  }
// end табы

// переход на товар с раздела подобные товары
  let goodImg = document.querySelectorAll('.good_image');
  // переход на товар с корзины
  let productImg = document.querySelectorAll('.product_img');

  if (goodImg) {
    toGood(goodImg);
  }

  if (productImg) {
    for( let i = 0; i < productImg.length; i++ ) {
      productImg[i].addEventListener('click', (e) => {
        console.log(e.target.dataset['toproductpage']);
        $.ajax({
          method: 'GET',
          url: './actions.php',
          data: {
            product_id: e.target.dataset['toproductpage'],
            currentGoods: currentGoods,
            action: 'toProductPage',
          },
          success: function(data) {
            console.log(data);
          }
        });
      })
    }
  }

  function toGood(arr) {
    for( let i = 0; i < arr.length; i++ ) {
      arr[i].addEventListener('click', (e) => {
        console.log(e.target.dataset['toproductpage']);
        $.ajax({
          method: 'GET',
          url: './actions.php',
          data: {
            product_id: e.target.dataset['toproductpage'],
            currentGoods: currentGoods,
            action: 'toProductPage',
          },
          success: function(data) {
            console.log(data);
          }
        });
      })
    }
  }
})