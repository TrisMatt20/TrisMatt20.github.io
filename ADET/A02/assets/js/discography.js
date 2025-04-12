var albumName = ["BINIverse", "Blink Twice", "Cherry On Top", "Pantropiko", "Salamin, Salamin", "Talaarawan", "Karera", "Feel Good", "Lagi", "Born to Win"];
var albumType = ["Album", "Single", "Single", "Single", "Album", "Album", "Album", "Single", "Album", "Single"];
var yearReleased = ["2025", "2025", "2024", "2023", "2024", "2024", "2023", "2022", "2022", "2021"];
var albumContent = ["6 Songs", "1 Song", "1 Song", "1 Song", "6 Songs", "6 Songs", "1 Song", "7 Songs", "1 Song", "12 Songs"];
var albumLinks = [
    "https://open.spotify.com/album/0N41GI4E4w6irltx8mJhY5?si=ooUcwBdfT-CgYmGbSZhYEQ",
    "https://open.spotify.com/album/3JhgbOO543sMPYpkuIr6Mx?si=LMovswh3TDSVORhSr2S2Sw",
    "https://open.spotify.com/album/3ZIjUhwlei1sT2yetvypvJ?si=h6L2jUZZRROd9nXdRDSpwQ",
    "https://open.spotify.com/album/3NYOeU6Uwj2FP1Zz1rWVz8?si=l7KvSFw2Rh2vrFXKSDIQKA",
    "https://open.spotify.com/album/2eT1XApzS0GmkJLMlCBdVv?si=iCNuDb5IQjOvCy7vaw3iFQ",
    "https://open.spotify.com/album/2eT1XApzS0GmkJLMlCBdVv?si=iCNuDb5IQjOvCy7vaw3iFQ",
    "https://open.spotify.com/album/2eT1XApzS0GmkJLMlCBdVv?si=iCNuDb5IQjOvCy7vaw3iFQ",
    "https://open.spotify.com/album/7H64wogfyQUcRqFZFbMV9S?si=c0k0vtF6SDyUuCi5ZZe53w",
    "https://open.spotify.com/album/7H64wogfyQUcRqFZFbMV9S?si=c0k0vtF6SDyUuCi5ZZe53w",
    "https://open.spotify.com/album/28rgW6IXDsrk4YtTcFtGGK?si=mVPf-IKPScaHHEzujS4KIA"
];
var albumCover = [
    "assets/img/discography/biniverse_cover.png",
    "assets/img/discography/bt_cover.jpg",
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
    const albumsContainer = document.querySelector('#albums-row'); 
    albumsContainer.innerHTML = ''; 

    for (var i = 0; i < albumName.length; i++) {
        let colDiv = document.createElement("div");
        colDiv.className = "col-12 col-sm-6 col-md-4 col-lg-3 mb-5 d-flex justify-content-center";

        // Create the album card structure
        colDiv.innerHTML = `
            <div class="album text-center shadow rounded-4 animate-up-asynch" style="width: 100%; max-width: 250px; background-color: transparent;">
                <img src="${albumCover[i]}" alt="${albumName[i]}" class="img-fluid rounded-top-4 p-3" style="height: 250px; object-fit: cover;">
                <div class="body p-2">
                    <h6 class="albumTitle card-title mb-3">${albumName[i]}</h6>
                    <a href="${albumLinks[i]}" target="_blank">
                        <button type="button" class="stream btn btn-primary rounded-pill w-50 mb-3">Stream Now</button>
                    </a>
                </div>
            </div>
        `;

        // Append the new col to the row container
        albumsContainer.appendChild(colDiv);
    }
}

// Call the function to populate the album details
populateAlbumDetails();
