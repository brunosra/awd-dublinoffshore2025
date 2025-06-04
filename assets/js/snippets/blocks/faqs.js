document.addEventListener('DOMContentLoaded', function() {
	const faqs = document.querySelectorAll('.item');

	faqs.forEach(faq => {
		const question = faq.querySelector('.question');

		question.addEventListener('click', (evt) => {
			evt.preventDefault();
			faq.classList.toggle('active');
		});
	});
});