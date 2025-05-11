// Animaciones para el carrusel
function initCarouselAnimations() {
  const carousel = document.querySelector('#mainCarousel');
  
  if (carousel) {
    // Animación para los elementos del carrusel
    carousel.addEventListener('slide.bs.carousel', function (e) {
      const activeCaption = e.relatedTarget.querySelector('.carousel-caption');
      
      // Resetear animación
      gsap.set(activeCaption.children, { 
        opacity: 0,
        y: 30
      });
      
      // Animación de entrada
      gsap.to(activeCaption.children, {
        duration: 0.8,
        opacity: 1,
        y: 0,
        stagger: 0.2,
        ease: "power3.out"
      });
    });
    
    // Animación inicial para el primer slide
    const firstCaption = carousel.querySelector('.carousel-item.active .carousel-caption');
    gsap.from(firstCaption.children, {
      duration: 1,
      opacity: 0,
      y: 30,
      stagger: 0.2,
      delay: 0.5,
      ease: "power3.out"
    });
    
    // Autoplay con pausa al interactuar
    const carouselInstance = new bootstrap.Carousel(carousel, {
      interval: 5000,
      pause: 'hover'
    });
  }
}

// Llamar la función al cargar la página
document.addEventListener('DOMContentLoaded', function() {
  initCarouselAnimations();
});