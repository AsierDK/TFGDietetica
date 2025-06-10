let id;

function verInformacion(idAlumno) {
    id = idAlumno;
    fetch(`../controllers/Clientes.php?alumno=${idAlumno}`)
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
    let items = JSON.parse(datos);
    console.log(items);
    const clientesArticle = document.getElementById('cliente');
    clientesArticle.textContent = '';
    const a = document.createElement('a');
    a.onclick = volver;
    const icono = document.createElement('i');
    icono.className = 'fa fa-arrow-left';
    a.appendChild(icono);
    clientesArticle.appendChild(a);
    const input = document.createElement('input');
    input.type = 'hidden';
    input.id = 'dni_cliente';
    input.name = 'dni_cliente';
    clientesArticle.appendChild(input);

    if(Object.keys(items).length === 0) {
        const div = document.createElement('div');
        div.textContent = 'No hay clientes registrados.';
        clientesArticle.appendChild(div);
    }
    else {
        for(let id in items) {
            const { dni_cliente, nombre, apellido, num } = items[id];
            const div = document.createElement('div');
            div.classList.add('box-cliente');
            div.dataset.id = dni_cliente;
            const datos = document.createElement('p');
            datos.textContent = `${nombre} ${apellido}`;
            const numRecetas = document.createElement('p');
            numRecetas.textContent = `Número de recetas: ${num.num}`;
            div.appendChild(datos);
            div.appendChild(numRecetas);
            clientesArticle.appendChild(div);
        }
        clientesArticle.style.display = 'block';
        const idUsu = id;
        mostrarCalendario(idUsu);
    }
}

function volver() {
    const clientesArticle = document.getElementById('cliente');
    clientesArticle.style.display = 'none';
    const calendar = document.getElementById('calendar');
    calendar.style.display = 'none';
}