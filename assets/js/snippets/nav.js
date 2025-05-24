let burger = document.querySelector('.burger');
let floating_nav = document.querySelector('nav .expander');
burger.addEventListener('click', (evt) => {
	burger.classList.toggle('close');
	floating_nav.classList.toggle('open');
});