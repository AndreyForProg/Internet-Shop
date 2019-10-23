// убираем лишний текст
let text = document.querySelector('.box'),
    link = document.querySelector('#link');

link.addEventListener('click', () => {
  console.log('click');
  text.classList.toggle('open');
})

// выводим в консоль, то что набирает юзер
const inputText = document.querySelector('#text');

inputText.addEventListener('keypress', (e) => {
  console.log('New simbol: ' + String.fromCharCode(e.which));
});