function toggleTheme(button) {
    console.log("Function running");

    const icon = button.querySelector('.theme-icon');
    const currentTheme = document.body.getAttribute("data-bs-theme");
    const navbar = document.querySelector('.navbar.bg-body-tertiary');

    if (currentTheme === "light" || !currentTheme) {
        document.body.setAttribute("data-bs-theme", "dark");
        icon.src = "assets/img/icons/lightMode.png";
        icon.alt = "lightmode";

        document.querySelectorAll('.sidebarCard').forEach(card => {
            card.style.backgroundColor = "#10808a";
        });

        if (navbar) {
            navbar.style.setProperty("background-color", "#10808a", "important");
        }
    } else {
        document.body.setAttribute("data-bs-theme", "light");
        icon.src = "assets/img/icons/darkMode.png";
        icon.alt = "darkmode";

        document.querySelectorAll('.sidebarCard').forEach(card => {
            card.style.backgroundColor = "#7ACAD2";
        });

        if (navbar) {
            navbar.style.setProperty("background-color", "#7ACAD2", "important");
        }
    }

    button.classList.add('clicked');
    void button.offsetWidth;
    setTimeout(() => {
        button.classList.remove('clicked');
    }, 400);
}