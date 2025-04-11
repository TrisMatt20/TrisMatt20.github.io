function rotateFlower(button) {
    const img = button.querySelector('.flower-img');

    if (!img) {
      console.log("Image not found!");
      return;
    }

    img.classList.add('rotate');

    setTimeout(() => {
      img.classList.remove('rotate');
    }, 500);
  }