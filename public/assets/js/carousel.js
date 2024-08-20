
const carouselArray = document.getElementsByClassName('carousel-container');

[...carouselArray].forEach(element => {
  const carousel = element;
  const prev = element.querySelector(".prev");
  const next = element.querySelector(".next");
  const track = element.querySelector(".track");
  const cards = element.getElementsByClassName('card-container');

  // Initialise une variable pour stocker la largeur d'une card
  let cardWidth;

  // Initialise une variable pour stocker la somme des largeurs
  let totalWidth = 0;

  // Parcourt chaque élément et ajoute sa largeur à la somme totale
  [...cards].forEach(card => {
    cardWidth = card.offsetWidth;
    totalWidth += card.offsetWidth;
  });

  // Initialise une variable pour stocker la largeur de la pise du carousel
  let trackWidth = track.offsetWidth;

  // Initialise une variable pour stocker l'index de l'avancée du carousel'
  let index = 0;
  
  // console.log(cardWidth);
  // console.log(trackWidth);
  // console.log(totalWidth);

  // // Stocker la largeur actuelle de la fenêtre
  // let windowWidth = window.innerWidth;

  // // Surveiller les redimensionnements pour mettre à jour la variable windowWidth
  // window.addEventListener('resize', function() {
  //   windowWidth = window.innerWidth;
  // });

  // // Vérifier si la fenêtre a été redimensionnée
  // if (window.innerWidth !== windowWidth) {
  //   index = 0;  // Réinitialiser l'index à 0
  //   track.style.transform = "translateX(0px)";  // Revenir à la première carte
  //   windowWidth = window.innerWidth;  // Mettre à jour la largeur de la fenêtre
  // }

  window.addEventListener('resize', function() {
    track.style.transform = "translateX(0px)";  // Revenir à la première carte
    index = 0;  // Réinitialiser l'index à 0
    trackWidth = track.offsetWidth; // Réassigne la valeur de la largeur de la track
    prev.classList.remove("show");
    prev.classList.add("hide");
    next.classList.remove("hide");
    next.classList.add("show");
    console.log(index);
  });

  if (cards.length <= 4) {
    next.classList.add("display");
  }

  if (cards.length > 4) {
    next.addEventListener("click", function (e) {
      e.preventDefault();
      index = index + 1;
      prev.classList.add("show");
      track.style.transform = "translateX(" + index * -cardWidth + "px)";
  
      console.log(index);

      // Cacher le bouton 'next' si on atteint la fin
      if (trackWidth + index * cardWidth >= totalWidth) {
        next.classList.add("hide");
        }
      }
    );
  };

  prev.addEventListener("click", function () {
    index = index - 1;
    next.classList.remove("hide");
    if (index === 0) {
      prev.classList.remove("show");
    }
    track.style.transform = "translateX(" + index * -trackWidth + "px)";
  });
  
});









