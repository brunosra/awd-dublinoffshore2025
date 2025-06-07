// Homepage Hero Video Modal Logic
// Handles showing/hiding a YouTube video overlay modal on the homepage hero section

import gsap from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'
gsap.registerPlugin(ScrollTrigger)

document.addEventListener('DOMContentLoaded', () => {
	const OVERLAY_ID = 'homepage-hero-video-overlay'
	const OVERLAY_CLASS = 'homepage-hero__video-overlay'
	const MODAL_CLASS = 'homepage-hero__video-modal'
	const CLOSE_BTN_CLASS = 'homepage-hero__video-close'
	const IFRAME_WRAPPER_CLASS = 'homepage-hero__video-iframe-wrapper'
	const THUMBNAIL_LINK_CLASS = 'homepage-hero__thumbnail-link'
	const YOUTUBE_EMBED_URL = 'https://www.youtube.com/embed/KdL94bHxz6M?si=jd-rKixT9zIdfDT8'

	/**
	 * Create the overlay modal if it doesn't exist in the DOM.
	 * @returns {HTMLElement} The overlay element.
	 */
	function ensureOverlayExists() {
		let overlay = document.getElementById(OVERLAY_ID)
		if (!overlay) {
			overlay = document.createElement('div')
			overlay.id = OVERLAY_ID
			overlay.className = OVERLAY_CLASS
			overlay.style.display = 'none'
			overlay.innerHTML = `
        <button class="${CLOSE_BTN_CLASS}" aria-label="Close">&times;</button>
				<div class="${MODAL_CLASS}">
					<div class="${IFRAME_WRAPPER_CLASS}"><!-- YouTube iframe injected here --></div>
				</div>
			`
			document.body.appendChild(overlay)
		}
		return overlay
	}

	/**
	 * Show the overlay modal and inject the YouTube iframe.
	 */
	function showVideoModal(overlay, iframeWrapper) {
		overlay.style.display = 'flex'
		// Force reflow for CSS transition
		void overlay.offsetHeight
		overlay.classList.add('is-active')
		document.body.style.overflow = 'hidden'
		iframeWrapper.innerHTML = `
			<iframe src="${YOUTUBE_EMBED_URL}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
		`
	}

	/**
	 * Hide the overlay modal and remove the YouTube iframe.
	 */
	function hideVideoModal(overlay, iframeWrapper) {
		overlay.classList.remove('is-active')
		document.body.style.overflow = ''
		iframeWrapper.innerHTML = ''
	}

	// Initialize overlay and modal elements
	const overlay = ensureOverlayExists()
	const closeBtn = overlay.querySelector(`.${CLOSE_BTN_CLASS}`)
	const iframeWrapper = overlay.querySelector(`.${IFRAME_WRAPPER_CLASS}`)
	const thumbnailLink = document.querySelector(`.${THUMBNAIL_LINK_CLASS}`)

	// Event: Open modal on thumbnail click
	if (thumbnailLink) {
		thumbnailLink.addEventListener('click', (event) => {
			event.preventDefault()
			showVideoModal(overlay, iframeWrapper)
		})
	}

	// Event: Close modal on close button click
	if (closeBtn) {
		closeBtn.addEventListener('click', () => {
			hideVideoModal(overlay, iframeWrapper)
		})
	}

	// Event: Close modal when clicking outside the modal content
	overlay.addEventListener('click', (event) => {
		if (event.target === overlay) {
			hideVideoModal(overlay, iframeWrapper)
		}
	})

	// Event: After transition, hide overlay from layout if not active
	overlay.addEventListener('transitionend', () => {
		if (!overlay.classList.contains('is-active')) {
			overlay.style.display = 'none'
		}
	})

	// Ensure overlay is hidden on page load
	overlay.style.display = 'none'

	// GSAP Scroll Animation for Hero Video
	const heroVideo = document.querySelector('.homepage-hero__bg-video')
	if (heroVideo) {
		// Responsive animation configs
		const width = window.innerWidth
		// Define breakpoints
		const breakpoints = {
			sm: 0,
			md: 700,
			lg: 1024,
		}

		// Animation configs for each breakpoint
		const animConfigs = {
			sm: {
				startWidth: '320px',
				startHeight: '320px',
				endWidth: '120px',
				endHeight: '120px',
				endMarginTop: '40px',
			},
			md: {
				startWidth: '520px',
				startHeight: '520px',
				endWidth: '220px',
				endHeight: '220px',
				endMarginTop: '60px',
			},
			lg: {
				startWidth: '900px',
				startHeight: '900px',
				endWidth: '300px',
				endHeight: '300px',
				endMarginTop: '120px',
			},
		}

		// Determine which config to use
		let anim
		if (width < breakpoints.md) {
			anim = animConfigs.sm
		} else if (width < breakpoints.lg) {
			anim = animConfigs.md
		} else {
			anim = animConfigs.lg
		}

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: heroVideo,
				start: 'top top',
				end: 'top+=900 top',
				scrub: true,
				markers: false,
			},
		})

		tl.to(heroVideo, {
			borderRadius: '100%',
			width: anim.startWidth,
			height: anim.startHeight,
			minHeight: '0px',
			maxWidth: 'none',
			marginTop: '0px',
			duration: 0.250,
		}).to(heroVideo, {
			width: anim.endWidth,
			height: anim.endHeight,
			marginTop: anim.endMarginTop,
			maxWidth: 'none',
			minHeight: '0px',
			duration: 0.750,
		})
	}
})
