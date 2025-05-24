// Processing static assets with VITE 
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

// Lightbox
Array.from(document.querySelectorAll("[data-lightbox]")).forEach(element => {
  element.onclick = (e) => {
    e.preventDefault();
    basicLightbox.create(`<img src="${element.href}">`).show();
  };
});
