import { gsap } from 'gsap'

const logosContainer = document.querySelector('.logo-strip__logos')

if (logosContainer && logosContainer.children.length > 0) {
	// Duplicate content 3 times for seamlessness
	if (!logosContainer.hasAttribute('data-duplicated')) {
		const original = logosContainer.innerHTML
		logosContainer.innerHTML = original + original + original
		logosContainer.setAttribute('data-duplicated', 'true')
	}

	function startMarquee() {
		gsap.killTweensOf(logosContainer)
		gsap.set(logosContainer, { clearProps: 'all' })

		const singleContentWidth = logosContainer.scrollWidth / 3

		// Start with the content shifted left by one set
		gsap.set(logosContainer, {
			x: 0,
			// Use translate3d for hardware acceleration
			transform: 'translate3d(0,0,0)',
		})

		const speed = 90 // px/sec, adjust as needed
		const duration = singleContentWidth / speed

		const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches
		if (prefersReducedMotion) return

		gsap.to(logosContainer, {
			ease: 'none',
			duration: duration,
			x: -singleContentWidth,
			repeat: -1,
			onRepeat: () => {
				gsap.set(logosContainer, { x: 0 })
  		},
		})
	}

	startMarquee()

	let resizeTimeout
	window.addEventListener('resize', () => {
		clearTimeout(resizeTimeout)
		resizeTimeout = setTimeout(startMarquee, 200)
	})
}
