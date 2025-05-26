let alimentoId = '';
let alimentoNombre = '';
let heartLink = null;

function addAlimento() {
    const alimentoArticle = document.getElementById('alimento');
    alimentoArticle.style.display = 'grid';
    alimentoArticle.scrollIntoView({ behavior: 'smooth' });
}

function addPesoBruto(event, id, nombre, link) {
    event.preventDefault();
    const popUp = document.getElementById('pop-up-pb');
    popUp.style.display = 'block';
    alimentoId = id;
    alimentoNombre = nombre;
    heartLink = link;
}

function closePopUp(event) {
    event.preventDefault();
    const popUp = document.getElementById('pop-up-pb');
    popUp.style.display = 'none';
}

function submitPesoBruto() {
    const peso = document.getElementById('peso').value.trim();
    console.log(alimentoId);
    console.log(alimentoNombre);

    if (peso) {
        let cesta = {};
        const cookie = document.cookie.split('; ').find(row => row.startsWith('cesta='));
        if (cookie) {
            cesta = JSON.parse(decodeURIComponent(cookie.split('=')[1]));
        }

        // Agregar o actualizar el alimento
        cesta[alimentoId] = {
            nombre: alimentoNombre,
            peso: peso
        };

        // Guardar cookie como JSON string
        document.cookie = `cesta=${encodeURIComponent(JSON.stringify(cesta))}; path=/; max-age=31536000`;
        // Cambiar el ícono a corazón relleno
        if(heartLink) {
            const heartIcon = heartLink.querySelector('i');
            heartIcon.classList.remove('far');
            heartIcon.classList.add('fas');
        }

        closePopUp(event);
    } else {
        document.getElementById("error").textContent = 'Por favor, introduce un peso válido.';
    }
}

function addCesta() {
    const cesta = document.getElementById('cesta');
    cesta.style.display = 'block';
}

function closeCesta() {
    const cesta = document.getElementById('cesta');
    cesta.style.display = 'none';
}