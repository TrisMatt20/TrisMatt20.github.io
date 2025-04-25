var suitNames = [
    "Homemade Suit", "Stark Suit", "Iron Spider Suit", "Stealth Suit",
    "Upgraded Suit", "Integrated Suit", "Final Suit"
  ];

  var suitDescriptions = [
    "Worn by Peter Parker in Spider-Man: Homecoming, the Homemade Suit is his self-made, DIY suit before getting the Stark-designed suit. It's basic but reflects Peter's early days as Spider-Man.",
    "The Stark Suit is given to Peter Parker by Tony Stark in Spider-Man: Homecoming. It's equipped with advanced technology and gadgets, showcasing Tony's mentorship and support for Peter.",
    "The Iron Spider Suit first appears in Avengers: Infinity War and is designed by Tony Stark. It's a high-tech suit with enhanced features, including mechanical legs and advanced durability for battle.",
    "The Stealth Suit, introduced in Spider-Man: Far From Home, is given to Peter Parker by Nick Fury. It's designed for covert operations with a sleek black design and enhanced invisibility capabilities.",
    "The Upgraded Suit, seen in Spider-Man: Far From Home, is a redesign of the Stark Suit with additional features like web wings and a new color scheme. Peter uses it to fight villains in Europe.",
    "The Integrated Suit, appearing in Spider-Man: No Way Home, combines elements from both the Stark Suit and the Iron Spider Suit, featuring magic-enhanced abilities courtesy of Doctor Strange.",
    "The Final Suit, also featured in Spider-Man: No Way Home, is Peter Parker's new suit after the events of the multiverse chaos. It's a fresh, homemade look representing his independence as Spider-Man."
  ];

  var suitNameElement = document.getElementById('suit-name');
  var suitDescriptionElement = document.getElementById('suit-description');

  // Function that returns the suit name and description based on the index
  function updateSuitDetails(index) {
    return {
      name: suitNames[index],
      description: suitDescriptions[index]
    };
  }

  var carousel = document.getElementById('carouselExampleCaptions');
  carousel.addEventListener('slide.bs.carousel', function (event) {
    var index = event.to; 
    var suitDetails = updateSuitDetails(index);
    suitNameElement.textContent = suitDetails.name;
    suitDescriptionElement.textContent = suitDetails.description;
  });