const img = document.getElementById('ironSpiderImg');

const suitImages = [
  'assets/img/suits/homemade.png',
  'assets/img/suits/starkSuit.png',
  'assets/img/suits/ironSpider.png',
  'assets/img/suits/stealthSuit.png',
  'assets/img/suits/upgradedSuit.png',
  'assets/img/suits/integratedSuit.png',
  'assets/img/suits/finalSuit.png'
];

let currentSuit = 0;

img.addEventListener('mouseover', () => {
  img.style.opacity = 0;
  setTimeout(() => {
    currentSuit = (currentSuit + 1) % suitImages.length;
    img.src = suitImages[currentSuit];
    img.style.opacity = 1;
  }, 300);
});

img.addEventListener('mouseout', () => {
  // reset to original image on mouse out
  img.style.opacity = 0;
  setTimeout(() => {
    img.src = 'assets/img/display/ironSpider.png';
    img.style.opacity = 1;
  }, 300);
});
