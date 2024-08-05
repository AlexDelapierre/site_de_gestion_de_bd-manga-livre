// Initialisation du carrousel avec un intervalle de 10 secondes
let carouselInterval = setInterval(() => {
  let activeItem = document.querySelector('#recipeCarousel .carousel-item.active');
  let nextItem = activeItem.nextElementSibling;
  if (!nextItem) {
    nextItem = activeItem.parentElement.children[0];
  }
  activeItem.classList.remove('active');
  nextItem.classList.add('active');
}, 10000);

// Modification du comportement des éléments du carrousel
document.querySelectorAll('.carousel .carousel-item').forEach(item => {
  let minPerSlide = 3;
  let next = item.nextElementSibling;
  if (!next) {
    next = item.parentElement.children[0];
  }
  
  item.appendChild(next.children[0].cloneNode(true));
  
  for (let i = 0; i < minPerSlide - 1; i++) {
    next = next.nextElementSibling;
    if (!next) {
      next = item.parentElement.children[0];
    }
    item.appendChild(next.children[0].cloneNode(true));
  }
});

// Code pour les contrôles Next et Previous
document.addEventListener('DOMContentLoaded', () => {
  const carousel = document.querySelector('#recipeCarousel');
  const items = carousel.querySelectorAll('.carousel-item');
  let currentIndex = 0;

  // Fonction pour afficher un élément spécifique du carrousel
  function showItem(index) {
    items.forEach((item, i) => {
      item.classList.toggle('active', i === index);
    });
    currentIndex = index;
  }

  // Fonction pour aller à l'élément suivant
  function nextItem() {
    const nextIndex = (currentIndex + 1) % items.length;
    showItem(nextIndex);
  }

  // Fonction pour aller à l'élément précédent
  function prevItem() {
    const prevIndex = (currentIndex - 1 + items.length) % items.length;
    showItem(prevIndex);
  }

  // Événement pour le bouton 'Next'
  document.querySelector('.carousel-control-next').addEventListener('click', () => {
    nextItem();
  });

  // Événement pour le bouton 'Previous'
  document.querySelector('.carousel-control-prev').addEventListener('click', () => {
    prevItem();
  });

  // Avancer automatiquement toutes les 10 secondes
  setInterval(nextItem, 1000);
});
