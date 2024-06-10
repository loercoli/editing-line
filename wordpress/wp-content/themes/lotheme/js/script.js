console.log("miao")

document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.querySelector('.overlay');
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        item.addEventListener('mouseover', () => {
            overlay.classList.add('active');
        });
        item.addEventListener('mouseout', () => {
            overlay.classList.remove('active');
        });
    });

    overlay.addEventListener('mouseover', () => {
        overlay.classList.remove('active');
    });
});


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



