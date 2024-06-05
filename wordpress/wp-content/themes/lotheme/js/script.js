console.log("miao")

const flicking = new Flicking("#carousel", {
    circular: true,
});


document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImage");
    const closeModal = document.querySelector(".modal .close");

    // Aggiunge l'event listener a ogni immagine nel carosello
    document.querySelectorAll('.flicking-viewport .panel img').forEach(img => {
        img.addEventListener('click', function () {
            const imgSrc = this.getAttribute('src');
            modal.style.display = "inline-flex";
            modalImg.src = imgSrc;
        });
    });

    // Chiude la modale quando si clicca sul simbolo (x)
    closeModal.onclick = function () {
        modal.style.display = "none";
    }
});