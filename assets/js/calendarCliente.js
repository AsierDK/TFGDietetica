if (document.addEventListener)
	window.addEventListener("load", inicio)
else if (document.attachEvent)
	window.attachEvent("onload", inicio);

function inicio() {
    const clienteBoxes = document.querySelectorAll('.box-cliente');
    const calendarArticle = document.getElementById('calendar');
    const recetas = document.getElementById('recetas');

    clienteBoxes.forEach(box => {
        box.addEventListener('click', function () {
            const idCliente = this.dataset.id;
            calendarArticle.style.display = 'block';
            if (!calendarArticle.dataset.rendered) {
              let calendarEl = document.getElementById('calendar');

              let calendar = new FullCalendar.Calendar(calendarEl, {
                  initialView: 'dayGridMonth',
                  locale: 'es',
                  editable: true, 
                  eventDrop: function(info) {
                      // Esta función se ejecuta cuando se mueve un evento
                      alert('Evento movido a: ' + info.event.start.toISOString());
                  },
                  events: '../assets/js/json/myfeed.php',
                  customButtons: {
                    annadirReceta: {
                      text: 'Añadir Recetas',
                      click: function() {
                        recetas.style.display = 'block';
                        /*fetch('../controllers/Calendario.php', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                            body: `id=${idCliente}`
                        })
                        .then(correctoCalendario)
                        .catch(erroresCalendario);
                      }*/
                      }
                    },
                  generarPDF: {
                      text: 'Generar PDF',
                      click: function() {

                      }
                  }
                },
              
                  headerToolbar: {
                    left: 'prev,next today annadirReceta generarPDF', // Botones de navegación
                    center: 'title',  // Título
                    right: 'dayGridMonth,timeGridWeek,timeGridDay' // Vista del calendario (mensual, semanal, diario)
                  }
              });

              calendar.render();
            }
        });
    });
};

function correctoCalendario(res){
    if(res.ok){
        res.text().then(recibidoCalendario);
    }
}

function erroresCalendario(){
    alert('Error en la conexión');
}

function recibidoCalendario(datos){
    console.log(datos);
    let datosConvertidos = JSON.parse(datos);
    console.log(datosConvertidos);
    const div = document.querySelector('.box-recetasClientes');
    div.textContent = '';

    if(Object.keys(datosConvertidos).length === 0) {
        const divReceta = document.createElement('div');
        divReceta.textContent = 'No hay recetas para el cliente';
        div.appendChild(divReceta);
    }
    else {
        for(let id in datosConvertidos) {
            const { nombre } = datosConvertidos[id];
            const divReceta = document.createElement('div');
            divReceta.textContent = `${nombre}`;

            const btn = document.createElement('button');
            btn.textContent = 'Añadir';
            btn.onclick = () => annadirFecha(id);

            li.appendChild(btn);
            div.appendChild(divReceta);
        }
    }
}

function annadirFecha() {
  const datosFecha = document.getElementById('fecha');
  datosFecha.style.display = 'block';
}

function closePopUp(event) {
    event.preventDefault();
    const popUp = document.getElementById('recetas');
    popUp.style.display = 'none';
}

function actualizarDias() {
  const mes = document.getElementById('mes').value;
  const diaSelect = document.getElementById('dia');

  diaSelect.textContent = '<option value="">-- Seleccionar día --</option>';

  if (mes) {
    const year = new Date().getFullYear();
    const diasEnMes = new Date(year, mes, 0).getDate();

    for (let d = 1; d <= diasEnMes; d++) {
      const option = document.createElement('option');
      option.value = d;
      option.textContent = d;
      diaSelect.appendChild(option);
  }

  }
}