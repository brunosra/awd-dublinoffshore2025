import gsap from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

function splitTextToSpans(selector) {
	const h3 = document.querySelector(selector)
	const words = h3.textContent.split(' ')
	h3.innerHTML = words
		.map(
			(word) =>
				`<span class="word">${[...word]
					.map((c) => `<span class="char">${c === ' ' ? '&nbsp;' : c}</span>`)
					.join('')}</span>`
		)
		.join(' ')
}

splitTextToSpans('.text-fill h3')

const tl = gsap.timeline({
	scrollTrigger: {
		trigger: '.text-fill h3',
		scrub: 1,
		start: 'top 80%',
		end: 'bottom 40%',
	},
})
tl.to('.char', {
	'--highlight-offset': '100%',
	stagger: 0.9,
})
