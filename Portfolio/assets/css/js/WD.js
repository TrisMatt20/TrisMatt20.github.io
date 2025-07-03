const projects = [
  {
    title: "Device Feature",
    href: "activities/activity 4/activity4.html",
    imgSrc: "../Portfolio/assets/css/img/projects/joystick.png"
  },
  {
    title: "Dream Destination",
    href: "activities/activity 5/index.html",
    imgSrc: "../Portfolio/assets/css/img/projects/united-arab-emirates.png"
  },
  {
    title: "Favorite Ppop",
    href: "activities/Activity 6/index.html",
    imgSrc: "../Portfolio/assets/css/img/projects/ppop.png"
  },
  {
    title: "Superhero Nexus",
    href: "activities/activity 7/index.html",
    imgSrc: "../Portfolio/assets/css/img/projects/superhero.png"
  },
  {
    title: "Set-up Guide",
    href: "activities/M01/index.html",
    imgSrc: "../Portfolio/assets/css/img/projects/hacker.png"
  },
  {
    title: "Infinity Stones",
    href: "activities/Parallax/banner.html",
    imgSrc: "../Portfolio/assets/css/img/projects/avengers.png"
  }
];

const container = document.getElementById("projectContainer");

projects.forEach((project, index) => {
  const col = document.createElement("div");
  col.className = "col-lg-4 col-md-6 col-sm-6 animate-up";

  col.innerHTML = `
    <div class="single-project text-center mt-30">
      <div class="project">
        <a href="${project.href}" style="display: inline-block; position: relative;">
          <img src="${project.imgSrc}" alt="project${index + 1}">
        </a>
      </div>
      <div class="project-overlay">
        <div class="project-content text-center">
          <h3 class="project-title" style="margin-top: 10px; color: black; font-weight: bold;">
            ${project.title}
          </h3>
          <div class="project-more">
            <a class="main-btn" href="${project.href}">
              <i class="fa-solid fa-eye fa-2xl" style="color: #ffffff;"></i> View
            </a>
          </div>
        </div>
      </div>
    </div>
  `;

  container.appendChild(col);
});