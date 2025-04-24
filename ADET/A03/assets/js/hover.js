const img = document.getElementById('ironSpiderImg');

  img.addEventListener('mouseover', () => {
    img.style.opacity = 0;
    setTimeout(() => {
      img.src = 'assets/img/display/ironSpider2.png';
      img.style.opacity = 1;
    }, 300); 
  });

  img.addEventListener('mouseout', () => {
    img.style.opacity = 0;
    setTimeout(() => {
      img.src = 'assets/img/display/ironSpider.png';
      img.style.opacity = 1;
    }, 300);
  });