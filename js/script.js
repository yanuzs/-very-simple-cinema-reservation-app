const slider = document.querySelector('.slider');
let scrollAmount = 0;

setInterval(() => {
  scrollAmount += slider.offsetWidth; 
  if (scrollAmount > slider.scrollWidth) {
    scrollAmount = 0; 
  }
  slider.style.transform = `translateX(-${scrollAmount}px)`;
}, 3000); 