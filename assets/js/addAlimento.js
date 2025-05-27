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
        fetch('../controllers/Cesta.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `accion=annadir&id=${alimentoId}&nombre=${alimentoNombre}&peso=${peso}`
        })
        .then(correcto)
        .catch(errores);

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

function eliminarAlimento(idAlimento){
    fetch('../controllers/Cesta.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `accion=eliminarAlimento&id=${idAlimento}`
        })
        .then(correcto)
        .catch(errores);

    const link = document.querySelector(`#alimento a[data-id="${idAlimento}"]`);
    if(link) {
        const heartIcon = link.querySelector('i');
        heartIcon.classList.remove('fas');
        heartIcon.classList.add('far');
    }
}

function eliminarCesta(){
    const heartIcons = document.querySelectorAll('#alimento a[data-id] i.fas');
        
        heartIcons.forEach(icon => {
            icon.classList.remove('fas');
            icon.classList.add('far');
        });
    fetch('../controllers/Cesta.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `accion=vaciar`
        })
        .then(correcto)
        .catch(errores);
}

function correcto(res){
    if(res.ok){
        res.text().then(recibido);
    }
}

function errores(){
    alert('Error en la conexión');
}

function recibido(datos){
    console.log(datos);
    let datosConvertidos = JSON.parse(datos);
    console.log(datosConvertidos);
    const ul = document.querySelector('.alimentosRecetas');
    ul.textContent = '';

    if(Object.keys(datosConvertidos).length === 0) {
        const li = document.createElement('li');
        li.textContent = 'No hay alimentos en la cesta';
        ul.appendChild(li);
    }
    else {
        for(let id in datosConvertidos) {
            const { nombre, peso } = datosConvertidos[id];
            const li = document.createElement('li');
            li.textContent = `${nombre}: ${peso}g`;

            const btn = document.createElement('button');
            btn.textContent = 'Eliminar';
            btn.onclick = () => eliminarAlimento(id);

            li.appendChild(btn);
            ul.appendChild(li);
        }
    }
}

function verCesta() {
    const cesta = document.getElementById('cesta');
    cesta.style.display = 'block';
}

function closeCesta() {
    const cesta = document.getElementById('cesta');
    cesta.style.display = 'none';
}