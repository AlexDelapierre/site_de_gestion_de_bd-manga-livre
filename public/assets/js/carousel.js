
const carouselArray = document.getElementsByClassName('carousel-container');

[...carouselArray].forEach(element => {
  const carousel = element;
  const prev = element.querySelector(".prev");
  const next = element.querySelector(".next");
  const track = element.querySelector(".track");
  const cards = element.getElementsByClassName('card-container');
  let width = carousel.offsetWidth;
  let index = 0;

  window.addEventListener("resize", function () {
    width = carousel.offsetWidth;
  });
  
  if (cards.length <= 4) {
    next.classList.add("display");
  }

  if (cards.length > 4) {
    // next.classList.add("hide");

    next.addEventListener("click", function (e) {
      e.preventDefault();
      index = index + 1;
      prev.classList.add("show");
      track.style.transform = "translateX(" + index * -width + "px)";
      if (track.offsetWidth - index * width < index * width) {
        next.classList.add("hide");
      }
    });
  };

  prev.addEventListener("click", function () {
    index = index - 1;
    next.classList.remove("hide");
    if (index === 0) {
      prev.classList.remove("show");
    }
    track.style.transform = "translateX(" + index * -width + "px)";
  });
  
});









