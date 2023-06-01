// Récupérer les éléments nécessaires
const thumbnail = document.getElementById('thumbnail');
const fullscreen = document.getElementById('fullscreen');
const fullscreenImage = document.getElementById('fullscreen-image');
const close = document.getElementById('close');

// Ajouter un écouteur d'événement sur le clic de l'image miniature
thumbnail.addEventListener('click', function() {
  fullscreenImage.src = this.src; // Afficher la même image en plein écran
  fullscreen.style.display = 'block'; // Afficher la div en plein écran
});

// Ajouter un écouteur d'événement sur le clic du bouton de fermeture
close.addEventListener('click', function() {
  fullscreen.style.display = 'none'; // Masquer la div en plein écran
});

// Ajouter un écouteur d'événement sur le clic en dehors de l'image en plein écran
fullscreen.addEventListener('click', function(event) {
  if (event.target === fullscreen) {
    fullscreen.style.display = 'none'; // Masquer la div en plein écran
  }
});
