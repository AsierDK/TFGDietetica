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
            document.getElementById('dni_cliente').value = idCliente;
            calendarArticle.style.display = 'block';
            if (!calendarArticle.dataset.rendered) {
              let calendarEl = document.getElementById('calendar');

              let calendar = new FullCalendar.Calendar(calendarEl, {
                  initialView: 'dayGridMonth',
                  locale: 'es',
                  firstDay: 1,
                  editable: true, 
                  eventDrop: function(info) {
                      // Esta función se ejecuta cuando se mueve un evento
                      alert('Evento movido a: ' + info.event.start.toISOString());
                  },
                  events: function(fetchInfo, successCallback, failureCallback) {
                    fetch('../controllers/Calendario.php', {
                      method: 'POST',
                      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                      body: `accion=visualizar&idCliente=${idCliente}`
                    })
                    .then(response => {
                      if (!response.ok) throw new Error('Error en la respuesta del servidor');
                      return response.json();
                    })
                    .then(eventos => {
                      successCallback(eventos);
                    })
                    .catch(error => {
                      console.error('Error cargando eventos:', error);
                      failureCallback(error);
                    });
                  },
                  customButtons: {
                    annadirReceta: {
                      text: 'Añadir Recetas',
                      click: function() {
                        recetas.style.display = 'block';
                        fetch('../controllers/Calendario.php', {
                            method: 'GET',
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        })
                        .then(correctoCalendario)
                        .catch(erroresCalendario);
                      }
                    },
                  generarPDF: {
                      text: 'Descargar PDF',
                      click: function() {
                        rellenarPDF(calendar);
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
    const div = document.querySelector('.recetasClientes');
    div.textContent = '';

    if(Object.keys(datosConvertidos).length === 0) {
        const divReceta = document.createElement('div');
        divReceta.textContent = 'No hay recetas para el cliente';
        div.appendChild(divReceta);
    }
    else {
        for(let id in datosConvertidos) {
            const { nombre_receta } = datosConvertidos[id];
            const divReceta = document.createElement('div');
            divReceta.textContent = `${nombre_receta}`;

            const btn = document.createElement('button');
            btn.textContent = 'Añadir';
            btn.onclick = () => annadirFecha(id);

            divReceta.appendChild(btn);
            div.appendChild(divReceta);
        }
    }
}

function annadirFecha(id) {
  document.getElementById('receta_id').value = id;
  const datosFecha = document.getElementById('fecha');
  datosFecha.style.display = 'block';
}

function closePopUp(event) {
    event.preventDefault();
    const popUp = document.getElementById('recetas');
    popUp.style.display = 'none';
}

function closeFecha(event) {
    event.preventDefault();
    const datosFecha = document.getElementById('fecha');
    datosFecha.style.display = 'none';
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

function annadirRecetasFecha(){
  const mes = document.getElementById('mes').value;
  const dia = document.getElementById('dia').value;
  const tipoComida = document.getElementById('tipoComida').value;
  const idReceta = document.getElementById('receta_id').value;
  const idCliente = document.getElementById('dni_cliente').value;

  if (mes && dia && tipoComida && idReceta && idCliente) {
    const fecha = `${new Date().getFullYear()}-${mes.padStart(2, '0')}-${dia.padStart(2, '0')}`;
    fetch('../controllers/Calendario.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `accion=annadir&fecha=${fecha}&tipoComida=${tipoComida}&idReceta=${idReceta}&idCliente=${idCliente}`
    })
    .then(correctoRecetasFecha)
    .catch(erroresRecetasFecha);
  }
}

async function rellenarPDF(calendar) {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();

  const currentView = calendar.view.type;
  const visibleEvents = calendar.getEvents();
  const title = calendar.view.title;

  doc.setFontSize(18);
  doc.text(`Planificación de Recetas (${currentView})`, 10, 15);
  doc.setFontSize(12);
  doc.text(`Vista actual: ${title}`, 10, 25);

  let y = 35;

  if (visibleEvents.length === 0) {
    doc.text("No hay eventos visibles en esta vista.", 10, y);
  } else {
    visibleEvents.forEach(event => {
      const fechaInicio = event.start.toLocaleString();
      const fechaFin = event.end ? event.end.toLocaleString() : '';
      const tipoComida = event.extendedProps?.tipoComida || '';
      const alimentos = event.extendedProps?.alimentos || [];

      doc.text(`📅 ${fechaInicio} (${tipoComida})`, 10, y);
      y += 6;
      doc.text(`🍽️ Receta: ${event.title}`, 10, y);
      y += 6;

      if (alimentos.length > 0) {
        doc.text("🧾 Alimentos:", 12, y);
        y += 6;
        alimentos.forEach(ali => {
          doc.text(`- ${ali.nombre} (${ali.pesobruto ?? ''}g)`, 15, y);
          y += 5;
          if (y > 270) {
            doc.addPage();
            y = 20;
          }
        });
      } else {
        doc.text("- Sin alimentos registrados", 12, y);
        y += 6;
      }

      y += 6;
      if (y > 270) {
        doc.addPage();
        y = 20;
      }
    });
  }

  doc.save("planificacion_recetas.pdf");
}