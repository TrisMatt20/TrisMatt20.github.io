// var isAlbumVisible = false; // Use a boolean to track visibility

// function expandContent() {
//     var album = document.getElementById("imageAlbum"); // Target the image album
//     var btnShow = document.getElementById("btnShow");

//     // Toggle the display based on the current visibility state
//     if (!isAlbumVisible) {
//         // Create and append images if not already created
//         if (album.children.length === 0) {
//             const images = [
//                 "assets/img/expand pictures/Aiah-2.JPG",
//                 "assets/img/expand pictures/Colet-3.JPG",
//                 "assets/img/expand pictures/Gwen-1.JPG",
//                 "assets/img/expand pictures/Jhoanna-3.JPG",
//                 "assets/img/expand pictures/Maloi-1.JPG",
//                 "assets/img/expand pictures/Mikha-4.JPG",
//                 "assets/img/expand pictures/Sheena-1.JPG",
//                 "assets/img/expand pictures/Stacey-4.JPG"
//             ];

//             for (let i = 0; i < images.length; i++) {
//                 let img = document.createElement("img");
//                 img.src = images[i];
//                 img.alt = `Image ${i + 1}`;
//                 img.className = "img-thumbnail";
//                 img.style.width = "500px";
//                 img.style.margin = "5px";
//                 album.appendChild(img); // Append the new image to the album
//             }
//         }

//         album.style.display = "flex"; // Show the album
//         isAlbumVisible = true; // Update the visibility state
//         btnShow.innerHTML = "Collapse"; // Change button text to Collapse
//     } else {
//         album.style.display = "none"; // Hide the album
//         isAlbumVisible = false; // Update the visibility state
//         btnShow.innerHTML = "Show more"; // Change button text back to Show more
//     }
// }


 