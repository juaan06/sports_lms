// Variables del slider
let indiceSlide = 0;
mostrarSlide(indiceSlide);

function cambiarSlide(n) {
    mostrarSlide(indiceSlide += n);
}

function mostrarSlide(n) {
    let slides = document.getElementsByClassName("slide");
    if (n >= slides.length) { indiceSlide = 0; }
    if (n < 0) { indiceSlide = slides.length - 1; }
    for (let slide of slides) {
        slide.style.display = "none";
    }
    slides[indiceSlide].style.display = "block";
}

// Modal del menú
function abrirMenu() {
    document.getElementById("menuModal").style.display = "block";
}

function cerrarMenu() {
    document.getElementById("menuModal").style.display = "none";
}
