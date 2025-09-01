const roles = [
    "Tristan Matthew",
    "A PHP Developer",
    "A Back-End Dev",
    "A Student"
];

const typingElement = document.getElementById("typing-text");
let roleIndex = 0;
let charIndex = 0;
let isDeleting = false;
let isPaused = false;

function typeEffect() {
    const currentRole = roles[roleIndex];

    if (!isPaused) {
        if (isDeleting) {
            charIndex--;
            typingElement.textContent = currentRole.substring(0, charIndex);
        } else {
            charIndex++;
            typingElement.textContent = currentRole.substring(0, charIndex);
        }

        if (!isDeleting && charIndex === currentRole.length) {
            isPaused = true;
            setTimeout(() => {
                isPaused = false;
                isDeleting = true;
            }, 1000); 
        }

        if (isDeleting && charIndex === 0) {
            isDeleting = false;
            roleIndex = (roleIndex + 1) % roles.length;
        }
    }

    const typingSpeed = isPaused ? 50 : isDeleting ? 50 : 100;
    setTimeout(typeEffect, typingSpeed); 
}

window.addEventListener("load", typeEffect);

