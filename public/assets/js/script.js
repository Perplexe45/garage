/* function showText(element) {
	var imageContainer = element;
	var textContainer = element.nextElementSibling;

	imageContainer.style.display = "none";
	textContainer.style.display = "block";
}

function showImage(element) {
	var textContainer = element.parentElement;
	var imageContainer = textContainer.previousElementSibling;

	textContainer.style.display = "none";
	imageContainer.style.display = "block";
} */

// Sélection de tous les boutons radio personnalisés
const customRadioButtons = document.querySelectorAll('.custom-radio input[type="radio"]');

// Parcours de chaque bouton radio personnalisé
customRadioButtons.forEach(button => {
    // Evénements pour le clic
    button.addEventListener('click', () => {
        // Supprime le focus du bouton radio
        button.blur();
    });
});

///////////////Agrandir une photo de voiture////////////
$(document).ready(function() {
  $('.zoomable-image').click(function() {
    $(this).addClass('zoomed-image');
  });
});


