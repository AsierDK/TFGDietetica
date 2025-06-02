if (document.addEventListener)
	window.addEventListener("load", inicio)
else if (document.attachEvent)
	window.attachEvent("onload", inicio);

let items = [];
let currentIndex = 0;

function inicio() {
    const tipo = window.tipo;
    console.log(tipo);
    fetch(`../controllers/Carrusel.php?tipo=${tipo}`)
    .then(correctoCarrusel)
    .catch(erroresCarrusel);
}

function correctoCarrusel(res){
    if(res.ok){
        res.text().then(recibidoCarrusel);
    }
}

function erroresCarrusel(){
    alert('Error en la conexión');
}

function recibidoCarrusel(datos){
    items = JSON.parse(datos);
    console.log(items);
    if (items !== undefined) {
        onSlideClick(0);
    }
}

function onSlideClick(index) {
    currentIndex = index;
    updateInfo();
    updateTransform();
    updateActiveClass();
}

function getTransform() {
    const slides = document.querySelectorAll(".slide");
    const track = document.querySelector(".carousel-track");
    let translateX = '';

    if (slides.length === 0 || !track) {
        translateX = "translateX(0)";
    }

    const slideWidth = slides[0].offsetWidth;
    const style = window.getComputedStyle(track);
    const gap = parseFloat(style.gap || style.columnGap || "0");

    const totalSlideWidth = slideWidth + gap;
    translateX = `translateX(-${currentIndex * totalSlideWidth}px)`
    return translateX;
}

function updateTransform() {
    const track = document.getElementById("carouselTrack");
    track.style.transform = getTransform();
}

function updateInfo() {
    const a = items[currentIndex];
    console.log(a);
    if (tipo === 'alimentos') {
        document.getElementById("pc").textContent = a.PC;
        document.getElementById("e_100").textContent = a.e_100;
        document.getElementById("prot_100").textContent = a.prot_100;
        document.getElementById("grasa_100").textContent = a.grasa_100;
        document.getElementById("ags_100").textContent = a.ags_100;
        document.getElementById("agmi_100").textContent = a.agmi_100;
        document.getElementById("agpi_100").textContent = a.agpi_100;
        document.getElementById("col_100").textContent = a.col_100;
        document.getElementById("hc_100").textContent = a.hc_100;
        document.getElementById("fibra_100").textContent = a.fibra_100;
        document.getElementById("vit_c_100").textContent = a.vit_c_100;
        document.getElementById("vit_b6_100").textContent = a.vit_b6_100;
        document.getElementById("vit_e_100").textContent = a.vit_e_100;
        document.getElementById("fe_100").textContent = a.fe_100;
        document.getElementById("na_100").textContent = a.na_100;
        document.getElementById("ca_100").textContent = a.ca_100;
        document.getElementById("k_100").textContent = a.k_100;
        document.getElementById("vit_d_100").textContent = a.vit_d_100;
    } else {
        document.getElementById("descipcionReceta").textContent = a.desc_receta;
        const alimentos = document.querySelector('.alimentosReceta');
        while (alimentos.firstChild) {
            alimentos.removeChild(alimentos.firstChild);
        }
        for (let ali of a.alimentos) {
            const divAli = document.createElement('div');
            divAli.classList.add('info');
            divAli.textContent = ali.nombreAlimento;
            alimentos.appendChild(divAli);
        }
    }
}

function updateActiveClass() {
    const slides = document.querySelectorAll(".slide");
    slides.forEach((slide, index) => {
        slide.classList.toggle("active", index === currentIndex);
    });
}

// Reajustar al cambiar tamaño de pantalla
window.onresize = () => {
    updateTransform();
    updateActiveClass();
};