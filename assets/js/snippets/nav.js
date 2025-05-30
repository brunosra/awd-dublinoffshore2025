let burger = document.querySelector('.burger');
let floating_nav = document.querySelector('nav .expander');

let toggles = document.querySelectorAll('li.has-children');
let floating_subnavs = document.querySelectorAll('div.expander-sub');

burger.addEventListener('click', (evt) => {
	burger.classList.toggle('close');
	floating_nav.classList.toggle('open');
});

toggles.forEach((item) => {
	item.addEventListener("click", () => {
		item.classList.toggle('open');
	})
});