// Funcionalidades principales del sitio
document.addEventListener('DOMContentLoaded', function() {
  // Inicialización de tooltips de Bootstrap
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Control del video
  const video = document.querySelector('video');
  if (video) {
    // Autoplay con mute para cumplir con políticas de navegadores
    video.muted = true;
    const playPromise = video.play();
    
    if (playPromise !== undefined) {
      playPromise.catch(error => {
        console.log('Autoplay prevented, showing controls');
        video.controls = true;
      });
    }
  }

  // Cargar más contenido al hacer scroll (lazy loading)
  window.addEventListener('scroll', function() {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 500) {
      // Aquí podrías cargar más contenido dinámicamente
    }
  });

  // Manejo del formulario de contacto (si existe)
  const contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      e.preventDefault();
      // Aquí iría la lógica para enviar el formulario
      console.log('Formulario enviado');
    });
  }
});