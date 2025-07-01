// button change color
function setRating(rating, container) {
  const stars = container.querySelectorAll(".star img");

  stars.forEach((star, index) => {
    if (index < rating) {
      star.classList.add("active");
      star.classList.remove("inactive");
    } else {
      star.classList.remove("active");
      star.classList.add("inactive");
    }
  });
}

// modal
document.addEventListener("click", function (event) {
  const starElement = event.target.closest(".star img");

  if (starElement) {
    const container = starElement.closest(".custom-card, .modal-body");

    const stars = Array.from(container.querySelectorAll(".star img"));
    const clickedIndex = stars.indexOf(starElement);

    setRating(clickedIndex + 1, container);
  }
});
// collapsable comment
function toggleCommentInput(button) {
  const commentInputContainer = button
    .closest(".custom-card")
    .querySelector(".comment-input-container");
  commentInputContainer.style.display =
    commentInputContainer.style.display === "none" ||
    commentInputContainer.style.display === ""
      ? "block"
      : "none";
}

function toggleActive(button) {
  button.classList.toggle("active");
}
