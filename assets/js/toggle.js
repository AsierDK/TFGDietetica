if (document.addEventListener)
	window.addEventListener("load", inicio)
else if (document.attachEvent)
	window.attachEvent("onload", inicio);

function inicio() {
    const hash = window.location.hash;
    if (hash === '#all') {
        toggleSection('all'); // Activa la sección correspondiente
    }
    // Encuentra qué sección está activa al inicio
    const activeSection = document.querySelector('main > section.active');

    if (activeSection) {
        const id = activeSection.id;
        toggleSection(id); // Alinea el círculo al botón correspondiente
    }
};
function toggleSection(id) {
    // Oculta todas las secciones
    document.querySelectorAll('main > section').forEach(sec => sec.classList.remove('active'));
    document.getElementById(id).classList.add('active');

    // Mueve el círculo (mayor) al borde del botón activo
    const btn = document.getElementById('btn' + id.charAt(0).toUpperCase() + id.slice(1));
    console.log(btn);
    const mayor = document.querySelector('.mayor');

    // Obtenemos la posición del botón en la pantalla (sin rotación)
    const rect = btn.getBoundingClientRect();
    console.log(rect);

    // Posicionamos el marcador (.mayor) verticalmente en el centro del botón (VISUALMENTE)
    // Porque aunque el botón esté rotado, su posición en pantalla es horizontal.
    const top = rect.top + rect.height / 2 - mayor.offsetHeight / 2;
    console.log(top);
    mayor.style.top = `${top}px`;
}