document.addEventListener("DOMContentLoaded", () => {
    const targets = document.querySelectorAll('.animate-up-asynch');
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Add a delay based on the index of the element
                setTimeout(() => {
                    entry.target.classList.add('show');
                }, index * 200);  // Adjust the 200ms for your desired delay between animations
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.5
    });

    targets.forEach(target => observer.observe(target));
});

const animatedElements = document.querySelectorAll('.animate-left, .animate-right, .animate-up');

const handleScroll = () => {
    animatedElements.forEach((element, index) => {
        const rect = element.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            // Add a delay based on the index of the element
            setTimeout(() => {
                element.classList.add('show');
            }, index * 200);  // Adjust the 200ms for staggered animation
        }
    });
};

