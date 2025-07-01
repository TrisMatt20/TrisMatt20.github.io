    document.querySelectorAll('.card').forEach(card => {
      // card style
      card.style.position = 'relative';
      card.style.overflow = 'hidden';
      card.style.borderRadius = '8px';

      // dark overlay
      const overlay = document.createElement('div');
      overlay.style.position = 'absolute';
      overlay.style.top = '0';
      overlay.style.left = '0';
      overlay.style.width = '100%';
      overlay.style.height = '100%';
      overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.65)'; // darker overlay
      overlay.style.zIndex = '2';
      overlay.style.pointerEvents = 'none';
      overlay.style.borderRadius = '8px';
      card.appendChild(overlay);

      // Keep card content above overlay
      const contentElements = card.querySelectorAll('.card-body, .card-title, .card-text, .btn, .fst-italic, .text-muted');
      contentElements.forEach(el => {
        el.style.position = 'relative';
        el.style.zIndex = '3';
      });

      // Darken the image
      const img = card.querySelector('img');
      if (img) {
        img.style.filter = 'brightness(0.65)';
      }
    });
