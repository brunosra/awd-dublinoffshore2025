let burger = document.querySelector('.burger');
let floating_nav = document.querySelector('nav .expander');

let toggles = document.querySelectorAll('.has-children');
let floating_subnavs = document.querySelectorAll('div.expander-sub a');

burger.addEventListener('click', (evt) => {
	evt.preventDefault();
	burger.classList.toggle('close');
	floating_nav.classList.toggle('open');
});

toggles.forEach((item) => {
	item.addEventListener("click", (evt) => {
		evt.preventDefault();
		item.classList.toggle('open');
	})
	floating_subnavs.forEach((item) => {
		item.addEventListener("click", (evt) => {
			evt.stopPropagation();
		});
	});
});