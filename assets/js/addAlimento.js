function addAlimento() {
    const alimentoArticle = document.getElementById('alimento');
    alimentoArticle.style.display = 'grid';
    // Scroll hacia esa sección
    alimentoArticle.scrollIntoView({ behavior: 'smooth' });
}

function addPesoBruto(event) {
    event.preventDefault();
    const popUp = document.getElementById('pop-up-pb');
    popUp.style.display = 'block';
}

function closePopUp(event) {
    event.preventDefault();
    const popUp = document.getElementById('pop-up-pb');
    popUp.style.display = 'none';
}

function submitPesoBruto() {
    const peso = document.getElementById('peso').value;
    console.log(peso);

    if (peso.trim() !== '') {
        console.log('Peso bruto añadido:', peso);
        alert('Peso añadido: ' + peso);

        // Cambiar el ícono a corazón relleno
        const heartIcon = document.getElementById('heart-icon');
        heartIcon.classList.remove('far'); // sin relleno
        heartIcon.classList.add('fas');    // con relleno

        closePopUp(event);
    } else {
        alert('Por favor, introduce un peso válido.');
    }
}