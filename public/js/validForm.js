var monImage = document.getElementById("serie_image")

monImage.addEventListener("input", function(event) {
    formatPhoto = event.target.value;
    var regex = /(.png|.jpg)$/;
    var monErreur = document.getElementById("erreur");
    var button = document.getElementById("sauvegarder");

    if (regex.test(formatPhoto)) {
        monErreur.textContent = "";
        button.disabled = false;

    }
    else {
        monErreur.textContent = "Format non accepté (JPG ou PNG)";
        button.disabled = true;
    }
})

