document.addEventListener("DOMContentLoaded", () => {
    const targets = document.querySelectorAll('.animate-up-asynch');
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('show');
                }, index * 200);  
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
            setTimeout(() => {
                element.classList.add('show');
            }, index * 200);  
        }
    });
};

