// Récupérer les éléments nécessaires
const thumbnails = document.querySelectorAll('.image_article');
const fullscreen = document.getElementById('fullscreen');
const fullscreenImage = document.getElementById('fullscreen-image');

// Ajouter un écouteur d'événement à chaque image miniature
thumbnails.forEach(function(thumbnail) {
  thumbnail.addEventListener('click', function() {
    fullscreenImage.src = this.src; // Afficher l'image cliquée en plein écran
    fullscreen.style.display = 'flex'; // Afficher la div en plein écran
    console.log("Image cliquée : " + this.alt); // Afficher le texte de l'attribut "alt" de l'image
  });
});

// Fonction pour fermer le mode plein écran
function closeFullscreen() {
  fullscreen.style.display = 'none'; // Masquer la div en plein écran
}

// Ajouter un écouteur d'événement sur le clic en dehors de l'image en plein écran
fullscreen.addEventListener('click', function(event) {
  if (event.target === fullscreen) {
    closeFullscreen();
  }
});

// Ajouter un écouteur d'événement pour la touche "Échap" du clavier
document.addEventListener('keydown', function(event) {
  if (event.key === 'Escape') {
    closeFullscreen();
  }
});

// Ajouter un écouteur d'événement sur le clic en dehors de l'image en plein écran
fullscreen.addEventListener('click', function(event) {
  if (event.target === fullscreen) {
    fullscreen.style.display = 'none'; // Masquer la div en plein écran
  }
});
