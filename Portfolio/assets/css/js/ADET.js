const projects = [
  {
    title: "Revamped BINI Website using MVC Architecture",
    href: "A02/index.php",
    imgSrc: "A02/assets/img/discography/bt_cover.jpg",
    btnText: "Download PHP project"
  },
  {
    title: "MCU's Spider-Man Suit Showcase using Bento layout",
    href: "A03/index.html",
    imgSrc: "A03/assets/img/cover.png",
    btnText: "View project",
    imgStyle: "height: 316px; width: 316px;"
  },
  {
    title: "One-Page POS System using HTML, CSS, and JS",
    href: "A04/index.html",
    imgSrc: "A04/assets/img/logo.png",
    btnText: "View project",
    imgStyle: "height: 316px; width: 316px;"
  },
  {
    title: "Embedded Poll for BINI Website using Embeddable HTML",
    href: "A07/index.html",
    imgSrc: "A02/assets/img/discography/bt_cover.jpg",
    btnText: "View Project"
  }
];

const container = document.getElementById("projectContainer");

projects.forEach((project, index) => {
  const col = document.createElement("div");
  col.className = "col-lg-4 col-md-6 col-sm-6 animate-up";

  col.innerHTML = `
    <div class="single-project text-center mt-30">
      <div class="project">
        <a href="#" style="display: inline-block; position: relative;">
          <img src="${project.imgSrc}" alt="project${index + 1}" class="rounded-5" ${project.imgStyle ? `style="${project.imgStyle}"` : ""}>
        </a>
      </div>
      <div class="project-overlay">
        <div class="project-content text-center">
          <h3 class="project-title" style="margin-top: 10px; color: black; font-weight: bold;">
            ${project.title}
          </h3>
          <div class="project-more">
            <a class="main-btn" href="${project.href}" target="_blank">
              <i class="fa-solid fa-eye fa-2xl" style="color: #ffffff;"></i> ${project.btnText}
            </a>
          </div>
        </div>
      </div>
    </div>
  `;

  container.appendChild(col);
});
