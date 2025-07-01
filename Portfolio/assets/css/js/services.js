const services = [
    {
      title: "Basic Web Designing",
      icon: "fa-brands fa-sketch",
      color: "#74C0FC",
      description: "I am capable of designing and developing basic webpages tailored to meet specific criteria and requirements."
    },
    {
      title: "Object-Oriented Programming",
      icon: "fa-solid fa-terminal",
      color: "#cf5a0c",
      description: "I can create programs and systems using the basic concepts of Object-Oriented Programming like classes, objects, and methods."
    },
    {
      title: "Back-End Development",
      icon: "fa-solid fa-database",
      color: "#B197FC",
      description: "I can manage the back-end part of systems and make sure they follow best practices and are safe to use."
    },
    {
      title: "Attention to Detail",
      icon: "fa-solid fa-star",
      color: "#FFD43B",
      description: "I pay close attention to small details to make sure everything works as expected and looks clean."
    },
    {
      title: "Communication",
      icon: "fa-solid fa-comment",
      color: "#74C0FC",
      description: "I can communicate effectively and am continuously working to improve my interpersonal skills."
    },
    {
      title: "Consultancy and Support",
      icon: "fa-solid fa-headset",
      color: "#2cbe19",
      description: "I am capable of offering assistance, sharing knowledge, and providing support to others in the development process."
    }
  ];

  const container = document.getElementById("services-container");

  services.forEach(service => {
    const col = document.createElement("div");
    col.className = "col-lg-4 col-md-6 col-sm-8 px-3";

    col.innerHTML = `
      <div class="single-service text-center mt-30 animate-up">
        <div class="service-icon mb-3">
          <i class="${service.icon}" style="color: ${service.color}; font-size: 2em;"></i>
        </div>
        <div class="service-content">
          <h4 style="color: #ffffff; margin-top: 10px;">${service.title}</h4>
          <p class="px-3" style="color: #ffffff; margin-top: 10px;">${service.description}</p>
        </div>
      </div>
    `;

    container.appendChild(col);
  });