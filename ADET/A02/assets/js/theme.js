document.addEventListener("DOMContentLoaded", function () {
    const themeBtn = document.querySelector('.themeMode');
    const sidebar = document.querySelector('.sidebarCard');

    themeBtn.addEventListener('click', function () {
        const icon = themeBtn.querySelector('.theme-icon');
        const currentTheme = document.body.getAttribute("data-bs-theme");

        if (currentTheme === "light") {
            // Switch to dark mode
            document.body.setAttribute("data-bs-theme", "dark");
            icon.src = "assets/img/icons/lightMode.png";
            icon.alt = "lightmode";
            sidebar.style.backgroundColor = "#052629";
        } else {
            // Switch to light mode
            document.body.setAttribute("data-bs-theme", "light");
            icon.src = "assets/img/icons/darkMode.png";
            icon.alt = "darkmode";
            sidebar.style.backgroundColor = "#7ACAD2";
        }

        themeBtn.classList.add('clicked');
        setTimeout(() => {
            themeBtn.classList.remove('clicked');
        }, 400);
    });
});
