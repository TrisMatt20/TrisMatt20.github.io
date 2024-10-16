// Member information arrays
var fnames = ["MIKHA", "MALOI", "AIAH", "GWEN", "SHEENA", "STACEY", "COLET", "JHOANNA"];
var names = ["Mikhaela Janna Lim", "Mary Loi Yves Ricalde", "Maraiah Queen Arceta", "Gweneth L. Apuli", "Sheena Mae Catacutan", "Stacey Aubrey Sevilleja", "Ma. Nicollete Vergara", "Jhoanna Christine Robles"];
var birthdays = ["November 8, 2003", "May 27, 2002", "January 27, 2001", "June 19, 2003", "May 9, 2004", "July 13, 2003", "September 14, 2001", "January 26, 2004"];
var pics = ["mikha-hp.png", "maloi-hp.png", "aiah-hp.png", "gwen-hp.png", "sheena-hp.png", "stacey-hp.png", "colet-hp.png", "jhoanna-hp.png"];

// Select all img elements inside the carousel
var picElements = document.querySelectorAll(".carousel-item img");

for (var i = 0; i < picElements.length; i++) {
    picElements[i].addEventListener('click', function () {
        updateMemberInfo(i);
    });
    picElements[i].addEventListener('mouseenter', function() {
        addHover(picElements[i].id);  // Add hover class to the image
    });
    picElements[i].addEventListener('mouseleave', function() {
        removeHover(picElements[i].id); // Remove hover class from the image
    });
}

function updateMemberInfo(index) {
    document.getElementById("fnames").innerText = fnames[index];
    document.getElementById("names").innerText = "Name: " + names[index];
    document.getElementById("birthdays").innerText = "Birthday: " + birthdays[index];
}

// Hover functions
function addHover(id) {
    document.getElementById(id).classList.add("hover");
}

function removeHover(id) {
    document.getElementById(id).classList.remove("hover");
}

// Carousel event listener
var carousel = document.getElementById('carouselExample');
carousel.addEventListener('slide.bs.carousel', function (event) {
    var nextIndex = event.to;
    updateMemberInfo(nextIndex);
});
