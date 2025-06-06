if (document.addEventListener)
	window.addEventListener("load", inicio)
else if (document.attachEvent)
	window.attachEvent("onload", inicio);

let calendar;
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

              calendar = new FullCalendar.Calendar(calendarEl, {
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
                      body: `accion=visualizar&start=${fetchInfo.startStr}&end=${fetchInfo.endStr}&idCliente=${idCliente}`
                    })
                    .then(response => {
                      if (!response.ok) throw new Error('Error en la respuesta del servidor');
                      return response.json();
                    })
                    .then(eventos => {
                      console.log('Eventos recibidos:', eventos);
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
                  },
                  datesSet: function(info) {
                    calendar.refetchEvents();
                  }
              });

              calendar.render();
              calendarArticle.dataset.rendered = 'true';
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
            const { nombre_receta, id_receta } = datosConvertidos[id];
            const divReceta = document.createElement('div');
            divReceta.textContent = `${nombre_receta}`;

            const btn = document.createElement('button');
            btn.textContent = 'Añadir';
            btn.onclick = () => annadirFecha(id_receta);

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

function annadirRecetasFecha(event){
  if(event) event.preventDefault();
  const mes = document.getElementById('mes').value;
  const dia = document.getElementById('dia').value;
  const tipoComida = document.getElementById('tipoComida').value;
  const idReceta = document.getElementById('receta_id').value;
  const idCliente = document.getElementById('dni_cliente').value;
  console.log(idReceta);

  if (mes && dia && tipoComida && idReceta && idCliente) {
    const fecha = `${new Date().getFullYear()}-${mes.toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;
    console.log(fecha);
    fetch('../controllers/Calendario.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: `accion=annadir&fecha=${fecha}&tipoComida=${tipoComida}&idReceta=${idReceta}&idCliente=${idCliente}`
    })
    .then(correctoRecetasFecha)
    .catch(erroresRecetasFecha);
  }
}

function correctoRecetasFecha(res){
    if(res.ok){
        res.text().then(recargar);
    }
}

function erroresRecetasFecha(){
    alert('Error en la conexión');
}

function recargar(){
  if (calendar) calendar.refetchEvents();
  const datosFecha = document.getElementById('fecha');
  datosFecha.style.display = 'none';
}

async function rellenarPDF(calendar) {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();

  const currentView = calendar.view.type;
  const visibleEvents = calendar.getEvents();
  const title = calendar.view.title;

  // Traducción básica de vistas para mostrar en PDF
  const viewNames = {
    dayGridMonth: "Vista Mensual",
    timeGridWeek: "Vista Semanal",
    timeGridDay: "Vista Diaria"
  };
  const viewText = viewNames[currentView] || currentView;

  doc.setFillColor(40, 90, 130); // azul oscuro
  doc.rect(0, 0, 210, 25, 'F'); // rectángulo relleno ancho A4 (210mm)
  
  doc.setTextColor(255, 255, 255); // texto blanco
  doc.setFontSize(20);
  doc.setFont("helvetica", "bold");
  doc.text(`Planificación de Recetas`, 10, 16);

  doc.setFontSize(14);
  doc.setFont("helvetica", "normal");
  doc.text(`Tipo de vista: ${viewText}`, 10, 30);
  doc.setTextColor(0, 0, 0);

  let y = 40;

  if (visibleEvents.length === 0) {
    doc.setFontSize(12);
    doc.text("No hay eventos visibles en esta vista.", 10, y);
  } else {
    visibleEvents.forEach((event, index) => {
      const fechaInicio = event.start.toISOString().slice(0, 10);
      const tipoComida = event.extendedProps?.tipoComida || '';

      doc.setFontSize(14);
      doc.setFont("helvetica", "bold");
      doc.text(`${fechaInicio} - ${tipoComida}`, 10, y);
      y += 7;

      doc.setFontSize(12);
      doc.setFont("helvetica", "normal");
      doc.text(`Receta: ${event.title}`, 10, y);
      y += 7;

      const alimentos = event.extendedProps?.alimentos || [];

      if (alimentos.length > 0) {
        const tableColumn = ["Nombre", "Peso (g)"];
        const tableRows = alimentos.map(ali => [
          ali.nombreAlimento || ali.nombre || 'N/A',
          ali.pesoBruto ?? ali.pesobruto ?? 'N/A'
        ]);

        doc.autoTable({
          startY: y,
          head: [tableColumn],
          body: tableRows,
          theme: 'grid',
          headStyles: { fillColor: [40, 90, 130], textColor: 255 },
          styles: { fontSize: 10 },
          margin: { left: 10, right: 10 }
        });

        y = doc.lastAutoTable.finalY + 10;
      } else {
        doc.setFontSize(10);
        doc.setTextColor(100);
        doc.text("Sin alimentos registrados", 10, y);
        doc.setTextColor(0);
        y += 10;
      }

      if (y > 270 && index !== visibleEvents.length - 1) {
        doc.addPage();
        y = 20;
      }
    });
  }

  doc.save("planificacion_recetas.pdf");
}