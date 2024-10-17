var myGallery = ["OT8-1.png", "OT8-2.png", "OT8-3.JPG", "OT8-4.JPG", "OT8-5.JPG"];

for(i=0; i<myGallery.length;i++) {
    var my = document.getElementById("picContainer");
    // myGallery.innerHTML += "<div class=\"pictures\"><img src="+ myGallery[i] + "\" class=\"rounded float-start\" alt=\"...\"style=\"width: 400px;\" id=\"pic1\" onmouseenter=\"addShadow('pic1');\" onmouseleave=\"removeShadow('pic1');\"><img src=" + myGallery[i] + "\" class=\"rounded float-end\" alt=\"...\" id=\"pic2\" onmouseenter=\"addShadow('pic2');\"onmouseleave=\"removeShadow('pic2')\"><img src="+ myGallery[i] + "\" class=\"rounded float-start\" alt=\"...\"style=\"width: 400px; margin-top: 5px; id=\"pic3\" onmouseenter=\"addShadow('pic3');\" onmouseleave=\"removeShadow('pic3');\"><img src=" + myGallery[i] + "\" class=\"rounded float-end\" alt=\"...\"style=\"width: 690px; margin-top: 5px;\" id=\"pic4\" onmouseenter=\"addShadow('pic4');\"onmouseleave=\"removeShadow('pic4');\"><img src=" + myGallery[i] + "\" class=\"rounded float-end\" alt=\"...\"style=\"width: 395px; margin-top: 5px; margin-right: 5px;\" id=\"pic5\" onmouseenter=\"addShadow('pic5');\" onmouseleave=\"removeShadow('pic5');\"></div>
    let galleryHTML = "<div class=\"pictures\">" +
    "<img src=\"" + myGallery[i] + "\" class=\"rounded float-start\" alt=\"...\" style=\"width: 400px;\" id=\"pic1\" " +
    "onmouseenter=\"addShadow('pic1');\" onmouseleave=\"removeShadow('pic1');\">" +
    "<img src=\"" + myGallery[i] + "\" class=\"rounded float-end\" alt=\"...\" id=\"pic2\" " +
    "onmouseenter=\"addShadow('pic2');\" onmouseleave=\"removeShadow('pic2');\">" +
    "<img src=\"" + myGallery[i] + "\" class=\"rounded float-start\" alt=\"...\" style=\"width: 400px; margin-top: 5px;\" " +
    "id=\"pic3\" onmouseenter=\"addShadow('pic3');\" onmouseleave=\"removeShadow('pic3');\">" +
    "<img src=\"" + myGallery[i] + "\" class=\"rounded float-end\" alt=\"...\" style=\"width: 690px; margin-top: 5px;\" " +
    "id=\"pic4\" onmouseenter=\"addShadow('pic4');\" onmouseleave=\"removeShadow('pic4');\">" +
    "<img src=\"" + myGallery[i] + "\" class=\"rounded float-end\" alt=\"...\" style=\"width: 395px; margin-top: 5px; margin-right: 5px;\" " +
    "id=\"pic5\" onmouseenter=\"addShadow('pic5');\" onmouseleave=\"removeShadow('pic5');\">" +
    "</div>";

}

function addShadow (id) {
    document.getElementById(id).classList.add('shadow');
}

function removeShadow (id) {
    document.getElementById(id).classList.remove('shadow');
}