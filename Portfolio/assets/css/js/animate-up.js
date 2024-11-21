document.addEventListener("DOMContentLoaded", () => {
    const targets = document.querySelectorAll('.animate-up');
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
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
    animatedElements.forEach((element) => {
        const rect = element.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            element.classList.add('show');
        }
    });
};

