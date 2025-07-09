const aboutMe = {
  name: "Tristan Matthew Matencio",
  intro: `I’m a passionate 3rd-year Information Technology student at the Polytechnic University of the Philippines – Sto. Tomas. I specialize in full-stack web development, with a strong focus on back-end technologies. I’m passionate about building efficient, scalable, and user-centered applications through clean and reliable back-end systems. Continuously driven to grow and improve, I aim to deliver seamless digital solutions that balance performance and usability.`,
  details: [
    { icon: "fa-cake-candles", color: "#ffffff", text: "April 20, 2004" },
    { icon: "fa-phone", color: "#ededed", text: "Upon request" },
    { icon: "fa-envelope", color: "#ffffff", text: "tmtmatencio@gmail.com" },
    { icon: "fa-location-dot", color: "#f7f7f7", text: "Tanauan City, Batangas" }
  ]
};

const skills = [
  { name: "HTML", icon: "fa-html5", color: "#3c00f0" },
  { name: "PHP", icon: "fa-php", color: "#b197fc" },
  { name: "JavaScript", icon: "fa-js", color: "#FFD43B" },
  { name: "Java", icon: "fa-java", color: "#eb0000" }
];

// Render About Me 
const aboutContent = document.getElementById("about-content");

let aboutHTML = `
    <h5 class="about-title" style="font-weight: bold; color: #ffffff; font-size: 30px;">
      Hi There! I'm ${aboutMe.name}
    </h5>
    <p style="text-align: justify; color: #ffffff;">${aboutMe.intro}</p>
    <ul class="clearfix">`;

aboutMe.details.forEach(item => {
  aboutHTML += `
      <li>
        <div class="single-info d-flex align-items-center">
          <i class="fa-solid ${item.icon} fa-lg" style="color: ${item.color}; margin-right: 10px;"></i>
          <p style="color: #ffffff;">${item.text}</p>
        </div>
      </li>`;
});

aboutHTML += `</ul>`;
aboutContent.innerHTML = aboutHTML;

// Render Skills 
const skillsContent = document.getElementById("skills-content");

let skillsHTML = `
    <div class="skill-item mt-25">
      <h3 class="about-skills" style="font-weight: bold; color: #ffffff; font-size: 30px;">Skills</h3>
    </div>`;

skills.forEach(skill => {
  skillsHTML += `
      <div class="skill-item mt-25">
        <div class="single-info d-flex align-items-center">
          <i class="fa-brands ${skill.icon} fa-2xl" style="color: ${skill.color}; margin-right: 10px;"></i>
          <h4 style="color: #ffffff; margin: 0;">${skill.name}</h4>
        </div>
      </div>`;
});

skillsContent.innerHTML = skillsHTML;