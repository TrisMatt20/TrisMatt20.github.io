var albumName = ["Cherry On Top", "Pantropiko", "Salamin, Salamin", "Talaarawan", "Karera", "Feel Good", "Lagi", "Born to Win"];
var albumType = ["Single", "Single", "Album", "Album", "Album", "Single", "Album", "Single"];
var yearReleased = ["2024", "2023", "2024", "2024", "2023", "2022", "2022", "2021"];
var albumContent = ["1 Song", "1 Song", "6 Songs", "6 Songs", "1 Song", "7 Songs", "1 Song", "12 Songs"];
var albumLinks = [
    "https://open.spotify.com/album/3ZIjUhwlei1sT2yetvypvJ?si=h6L2jUZZRROd9nXdRDSpwQ",
    "https://open.spotify.com/album/3NYOeU6Uwj2FP1Zz1rWVz8?si=l7KvSFw2Rh2vrFXKSDIQKA",
    "https://open.spotify.com/album/2eT1XApzS0GmkJLMlCBdVv?si=iCNuDb5IQjOvCy7vaw3iFQ",
    "https://open.spotify.com/album/2eT1XApzS0GmkJLMlCBdVv?si=iCNuDb5IQjOvCy7vaw3iFQv",
    "https://open.spotify.com/album/2eT1XApzS0GmkJLMlCBdVv?si=iCNuDb5IQjOvCy7vaw3iFQ",
    "https://open.spotify.com/album/7H64wogfyQUcRqFZFbMV9S?si=c0k0vtF6SDyUuCi5ZZe53w",
    "https://open.spotify.com/album/7H64wogfyQUcRqFZFbMV9S?si=c0k0vtF6SDyUuCi5ZZe53w",
    "https://open.spotify.com/album/28rgW6IXDsrk4YtTcFtGGK?si=mVPf-IKPScaHHEzujS4KIA"
];
var albumCover = [
    "https://e-cdn-images.dzcdn.net/images/cover/5c234483ede6dfed6cf1ed1328916101/500x500-000000-80-0-0.jpg",
    "https://preview.redd.it/bini-releases-their-coverart-for-v0-zvpj73qe0xzb1.jpg?width=1080&crop=smart&auto=webp&s=b549fc7c9e80e697b0f5a9096f44aa65cdf950f9",
    "https://i.pinimg.com/736x/7c/77/69/7c77696b2be737259b5df146ba789812.jpg",
    "https://i.pinimg.com/736x/7c/77/69/7c77696b2be737259b5df146ba789812.jpg",
    "https://bini.abs-cbn.com/_next/image?url=https%3A%2F%2Fartist-images.abs-cbn.com%2Fwp-content%2Fuploads%2F2024%2F07%2F29120659%2Faeb43e840aceb781b54bfb727fe291b1.jpeg&w=640&q=75",
    "https://bini.abs-cbn.com/_next/image?url=https%3A%2F%2Fartist-images.abs-cbn.com%2Fwp-content%2Fuploads%2F2024%2F07%2F18120357%2Ffeelgood.png&w=640&q=75",
    "https://bini.abs-cbn.com/_next/image?url=https%3A%2F%2Fartist-images.abs-cbn.com%2Fwp-content%2Fuploads%2F2024%2F07%2F29120643%2Flagi.png&w=640&q=75",
    "https://bini.abs-cbn.com/_next/image?url=https%3A%2F%2Fartist-images.abs-cbn.com%2Fwp-content%2Fuploads%2F2024%2F07%2F18120355%2Fborntowin.png&w=640&q=75"
];


function populateAlbumDetails() {
    const albumsContainer = document.querySelector('.albums-container'); 
    albumsContainer.innerHTML = ''; 

    for (var i = 0; i < albumName.length; i++) {
        // Create a new album card
        let albumCard = document.createElement("div");
        albumCard.className = "album-card"; 

        // HTML structure for each album
        albumCard.innerHTML = `
            <img src="${albumCover[i]}" class="img-fluid" alt="${albumName[i]}">
            <h5 class="album-title">${albumName[i]}</h5>
            <div class="album-details">${albumType[i]} • ${yearReleased[i]} • ${albumContent[i]}</div>
            <a href="${albumLinks[i]}" class="btn btn-primary" target="_blank" style="color: white; text-decoration: none;">Stream Now</a>
        `;

        // Add onmouseenter and onmouseleave for hover zoom effect
        let albumImage = albumCard.querySelector("img");
        albumImage.addEventListener("mouseenter", function() {
            albumImage.style.transform = "scale(1.2)"; 
            albumImage.style.transition = "transform 0.3s ease"; 
        });
        albumImage.addEventListener("mouseleave", function() {
            albumImage.style.transform = "scale(1)"; 
        });

        albumsContainer.appendChild(albumCard);
    }
}


populateAlbumDetails();

