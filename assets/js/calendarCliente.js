if (document.addEventListener)
	window.addEventListener("load", inicio)
else if (document.attachEvent)
	window.attachEvent("onload", inicio);

let calendar;
//let idUsu;
function inicio() {
  mostrarCalendario(idUsu);
}

function mostrarCalendario(idUsu){
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
                  selectable: true,
                  selectMirror: true,
                  dayMaxEvents: true,
                  select: function () {
                    recetas.style.display = 'block';
                        fetch(`../controllers/Calendario.php?idUsu=${idUsu}`, {
                            method: 'GET',
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        })
                        .then(correctoCalendario)
                        .catch(erroresCalendario);
                  },
                  eventDrop: function(info) {
                    const fecha = info.event.start.toISOString().slice(0, 10);
                    fetch('../controllers/Calendario.php', {
                          method: 'POST',
                          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                          body: `accion=modificar&fecha=${fecha}&idReceta=${info.event.id}&idCliente=${idCliente}&idUsu=${idUsu}`
                      })
                      .then(response => {
                        if (!response.ok) throw new Error('Error en la respuesta del servidor');
                        return;
                      })
                      .then(() => {
                          console.log('Modificación exitosa');
                      })
                      .catch(error => {
                          console.error('Error cargando eventos:', error);
                      });
                  },
                  events: function(fetchInfo, successCallback, failureCallback) {
                    fetch('../controllers/Calendario.php', {
                      method: 'POST',
                      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                      body: `accion=visualizar&start=${fetchInfo.startStr}&end=${fetchInfo.endStr}&idCliente=${idCliente}&idUsu=${idUsu}`
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
                  eventClick: function (info) {
                    let deleteMsg = confirm('¿Quieres eliminar esta receta?');
                    if (deleteMsg) {
                      fetch('../controllers/Calendario.php', {
                          method: 'POST',
                          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                          body: `accion=eliminar&idReceta=${info.event.id}&idCliente=${idCliente}&idUsu=${idUsu}`
                      })
                      .then(response => {
                        if (!response.ok) throw new Error('Error en la respuesta del servidor');
                        return;
                      })
                      .then(() => {
                        calendar.FullCalendar('removeEvent', info.event.id)
                          displayMessage('Receta eliminada');
                      })
                      .catch(error => {
                          console.error('Error cargando eventos:', error);
                      });
                    }
                  },
                  customButtons: {
                    generarPDF: {
                        text: 'Descargar PDF',
                        click: function() {
                          rellenarPDF(calendar, 'descargar');
                        }
                    },
                    visualizarPDF: {
                        text: 'Visualizar Datos',
                        click: function() {
                          rellenarPDF(calendar, 'visualizar');
                        }
                    }
                  },
                headerToolbar: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                footerToolbar: {
                  center: 'generarPDF visualizarPDF'
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
}

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
            btn.className = 'btn';
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
      body: `accion=annadir&fecha=${fecha}&tipoComida=${tipoComida}&idReceta=${idReceta}&idCliente=${idCliente}&idUsu=${idUsu}`
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

async function rellenarPDF(calendar, accion) {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({ orientation: 'landscape', unit: 'mm', format: 'a3' });

  const currentView = calendar.view.type;
  const visibleEvents = calendar.getEvents();
  const viewNames = {
    dayGridMonth: "Vista Mensual",
    timeGridWeek: "Vista Semanal",
    timeGridDay: "Vista Diaria"
  };

  // Cabecera del documento
  doc.setFillColor(40, 90, 130);
  doc.rect(0, 0, 297, 25, 'F');
  doc.setTextColor(255, 255, 255);
  doc.setFontSize(20).setFont("helvetica", "bold");
  doc.text("Planificación de Recetas", 10, 16);
  doc.setFontSize(14).setFont("helvetica", "normal").setTextColor(0);
  doc.text(`Tipo de vista: ${viewNames[currentView] || currentView}`, 10, 30);

  let y = 40;
  if (visibleEvents.length === 0) {
    doc.setFontSize(12).text("No hay eventos visibles en esta vista.", 10, y);
    return doc.save("planificacion_recetas.pdf");
  }

  // Agrupar eventos por fecha
  const eventosPorFecha = agruparEventosPorFecha(visibleEvents);
  const energiaPorDia = calcularEnergiaPorDia(eventosPorFecha);

  for (const fecha of Object.keys(eventosPorFecha).sort()) {
    const eventos = eventosPorFecha[fecha];
    let energiaTotalDia = energiaPorDia[fecha];
    let totalDia = crearObjetoTotales();

    doc.setFontSize(16).setTextColor(40, 90, 130).setFont("helvetica", "bold");
    doc.text(`Día: ${fecha}`, 10, y);
    y += 10;

    for (const event of eventos) {
      const tipoComida = event.extendedProps?.tipoComida || '';
      const alimentos = event.extendedProps?.alimentos || [];

      const totalComida = crearObjetoTotales();
      const datosAlimentos = alimentos.map(ali => calcularDatosAlimento(ali, totalComida));

      // Acumular al total del día
      Object.keys(totalDia).forEach(key => {
        totalDia[key] += totalComida[key];
      });

      // Generar tabla
      doc.setFontSize(12).setTextColor(0).setFont("helvetica", "bold");
      doc.text(`${tipoComida}`, 10, y); y += 6;
      doc.setFont("helvetica", "normal");
      doc.text(`Receta: ${event.title}`, 10, y); y += 7;

      const tableColumn = encabezadoTabla();
      const tableRows = datosAlimentos.map(formatearFilaAlimento);

      const porcentajeEnergia = ((totalComida.energia / energiaTotalDia) * 100).toFixed(2) + "%";
      tableRows.push(formatearFilaTotales("TOTAL", totalComida, porcentajeEnergia));

      doc.autoTable({
        startY: y,
        head: [tableColumn],
        body: tableRows,
        styles: { fontSize: 5.5 },
        headStyles: { fillColor: [40, 90, 130], textColor: 255 },
        margin: { left: 10, right: 10 },
        pageBreak: 'auto'
      });

      y = doc.lastAutoTable.finalY + 15;
      if (y > doc.internal.pageSize.height - 50) {
        doc.addPage(); y = 20;
      }
    }

const energiaProteinas = totalDia.prot * 4 / totalDia.energia;
const energiaGrasas = totalDia.grasa * 9 / totalDia.energia;
const energiaHC = totalDia.hc * 3.75 / totalDia.energia;
const energiaCalculada = energiaProteinas + energiaGrasas + energiaHC;
const porcentajeEnergiaDia = ((totalDia.energia / energiaPorDia[fecha]) * 100).toFixed(2) + "%";

const filaDistribucionEnergetica = [
  "", 
  (energiaProteinas).toFixed(2) + "%",
  (energiaGrasas).toFixed(2) + "%",
  ((totalDia.ags * 9 / totalDia.energia)).toFixed(2) + "%",
  ((totalDia.agmi * 9 / totalDia.energia)).toFixed(2) + "%",
  ((totalDia.agpi * 9 / totalDia.energia) ).toFixed(2) + "%",
  "",
  (energiaHC).toFixed(2),
  "", "", "", "", "", "", "", "", "", (energiaCalculada).toFixed(2) + "%"
];

doc.setFontSize(14);
doc.setTextColor(40, 90, 130);
doc.text("Total del día", 10, y);
y += 8;

doc.autoTable({
  startY: y,
  head: [[
    "Energía", "Proteínas", "Grasas", "AGS", "AGMI", "AGPI", "Colesterol",
    "HC", "Fibra", "Vit C", "Vit B6", "Vit E", "Hierro", "Sodio", "Calcio",
    "Vit D", "Potasio", "% Energía Total"
  ]],
  body: [[
    totalDia.energia.toFixed(2),
    totalDia.prot.toFixed(2),
    totalDia.grasa.toFixed(2),
    totalDia.ags.toFixed(2),
    totalDia.agmi.toFixed(2),
    totalDia.agpi.toFixed(2),
    totalDia.col.toFixed(2),
    totalDia.hc.toFixed(2),
    totalDia.fibra.toFixed(2),
    totalDia.vit_c.toFixed(2),
    totalDia.vit_b6.toFixed(2),
    totalDia.vit_e.toFixed(2),
    totalDia.fe.toFixed(2),
    totalDia.na.toFixed(2),
    totalDia.ca.toFixed(2),
    totalDia.vit_d.toFixed(2),
    totalDia.k.toFixed(2),
    porcentajeEnergiaDia
  ],
  filaDistribucionEnergetica],
  styles: { fontSize: 8 },
  headStyles: { fillColor: [40, 90, 130], textColor: 255 },
  bodyStyles: [
    {},
    { fillColor: [230, 240, 255] }
  ],
  margin: { left: 10, right: 10 },
  theme: 'striped',
  pageBreak: 'auto',
});

y = doc.lastAutoTable.finalY + 15;

if (y > doc.internal.pageSize.height - 50) {
  doc.addPage();
  y = 20;
}

  }

  if (accion === 'descargar'){
    doc.save("planificacion_recetas.pdf");
  } else if (accion === 'visualizar'){
    const pdfBlob = doc.output('blob');
    const blobUrl = URL.createObjectURL(pdfBlob);
    window.open(blobUrl);
  }
}

function agruparEventosPorFecha(events) {
  const grupos = {};
  events.forEach(event => {
    const fecha = event.start.toISOString().slice(0, 10);
    if (!grupos[fecha]) grupos[fecha] = [];
    grupos[fecha].push(event);
  });
  return grupos;
}

function calcularEnergiaPorDia(eventosPorFecha) {
  const energia = {};
  for (const fecha in eventosPorFecha) {
    let total = 0;
    eventosPorFecha[fecha].forEach(event => {
      const alimentos = event.extendedProps?.alimentos || [];
      alimentos.forEach(ali => {
        const pesoNeto = parseFloat(ali.pesoBruto || 0) * parseFloat(ali.PC || 0);
        const e_100 = parseFloat(ali.e_100 || 0);
        total += pesoNeto * e_100 / 100;
      });
    });
    energia[fecha] = total;
  }
  return energia;
}

function crearObjetoTotales() {
  return {
    energia: 0, prot: 0, grasa: 0, ags: 0, agmi: 0, agpi: 0,
    col: 0, hc: 0, fibra: 0, vit_c: 0, vit_b6: 0, vit_e: 0,
    fe: 0, na: 0, ca: 0, vit_d: 0, k: 0
  };
}

function calcularDatosAlimento(ali, total) {
  const parse = v => parseFloat(v || 0);
  const pesoNeto = parse(ali.pesoBruto) * parse(ali.PC);

  const datos = {
    nombre: ali.nombreAlimento,
    pesoBruto: parse(ali.pesoBruto),
    pc: parse(ali.PC),
    pesoNeto,
    e_100: parse(ali.e_100),
    prot_100: parse(ali.prot_100),
    grasa_100: parse(ali.grasa_100),
    ags_100: parse(ali.ags_100),
    agmi_100: parse(ali.agmi_100),
    agpi_100: parse(ali.agpi_100),
    col_100: parse(ali.col_100),
    hc_100: parse(ali.hc_100),
    fibra_100: parse(ali.fibra_100),
    vit_c_100: parse(ali.vit_c_100),
    vit_b6_100: parse(ali.vit_b6_100),
    vit_e_100: parse(ali.vit_e_100),
    fe_100: parse(ali.fe_100),
    na_100: parse(ali.na_100),
    ca_100: parse(ali.ca_100),
    vit_d_100: parse(ali.vit_d_100),
    k_100: parse(ali.k_100)
  };

  datos.energia = pesoNeto * datos.e_100 / 100;
  datos.prot = pesoNeto * datos.prot_100 / 100;
  datos.grasa = pesoNeto * datos.grasa_100 / 100;
  datos.ags = pesoNeto * datos.ags_100 / 100;
  datos.agmi = pesoNeto * datos.agmi_100 / 100;
  datos.agpi = pesoNeto * datos.agpi_100 / 100;
  datos.col = pesoNeto * datos.col_100 / 100;
  datos.hc = pesoNeto * datos.hc_100 / 100;
  datos.fibra = pesoNeto * datos.fibra_100 / 100;
  datos.vit_c = pesoNeto * datos.vit_c_100 / 100;
  datos.vit_b6 = pesoNeto * datos.vit_b6_100 / 100;
  datos.vit_e = pesoNeto * datos.vit_e_100 / 100;
  datos.fe = pesoNeto * datos.fe_100 / 100;
  datos.na = pesoNeto * datos.na_100 / 100;
  datos.ca = pesoNeto * datos.ca_100 / 100;
  datos.vit_d = pesoNeto * datos.vit_d_100 / 100;
  datos.k = pesoNeto * datos.k_100 / 100;

  // Sumar al total
  Object.keys(total).forEach(k => { if (datos[k] !== undefined) total[k] += datos[k]; });

  return datos;
}

function encabezadoTabla() {
  return [
    "Nombre", "Peso Bruto", "PC", "Peso Neto",
    "E/100", "Prot/100", "Grasa/100", "AGS/100", "AGMI/100", "AGPI/100",
    "Col/100", "HC/100", "Fibra/100", "Vit C/100", "Vit B6/100", "Vit E/100",
    "Fe/100", "Na/100", "Ca/100", "Vit D/100", "K/100",
    "Energía", "Proteínas", "Grasas", "AGS", "AGMI", "AGPI", "Colesterol",
    "HC", "Fibra", "Vit C", "Vit B6", "Vit E", "Hierro", "Sodio",
    "Calcio", "Vit D", "Potasio", "% Energía Total"
  ];
}

function formatearFilaAlimento(d) {
  return [
    d.nombre, d.pesoBruto.toFixed(1), d.pc.toFixed(1), d.pesoNeto.toFixed(1),
    d.e_100.toFixed(1), d.prot_100.toFixed(1), d.grasa_100.toFixed(1), d.ags_100.toFixed(1), d.agmi_100.toFixed(1), d.agpi_100.toFixed(1),
    d.col_100.toFixed(1), d.hc_100.toFixed(1), d.fibra_100.toFixed(1), d.vit_c_100.toFixed(1), d.vit_b6_100.toFixed(1), d.vit_e_100.toFixed(1),
    d.fe_100.toFixed(1), d.na_100.toFixed(1), d.ca_100.toFixed(1), d.vit_d_100.toFixed(1), d.k_100.toFixed(1),
    d.energia.toFixed(2), d.prot.toFixed(2), d.grasa.toFixed(2), d.ags.toFixed(2), d.agmi.toFixed(2),
    d.agpi.toFixed(2), d.col.toFixed(2), d.hc.toFixed(2), d.fibra.toFixed(2), d.vit_c.toFixed(2),
    d.vit_b6.toFixed(2), d.vit_e.toFixed(2), d.fe.toFixed(2), d.na.toFixed(2), d.ca.toFixed(2),
    d.vit_d.toFixed(2), d.k.toFixed(2), ""
  ];
}

function formatearFilaTotales(label, totales, porcentaje) {
  return [
    label, "", "", "",
    "", "", "", "", "", "",
    "", "", "", "", "", "",
    "", "", "", "", "",
    totales.energia.toFixed(2),
    totales.prot.toFixed(2),
    totales.grasa.toFixed(2),
    totales.ags.toFixed(2),
    totales.agmi.toFixed(2),
    totales.agpi.toFixed(2),
    totales.col.toFixed(2),
    totales.hc.toFixed(2),
    totales.fibra.toFixed(2),
    totales.vit_c.toFixed(2),
    totales.vit_b6.toFixed(2),
    totales.vit_e.toFixed(2),
    totales.fe.toFixed(2),
    totales.na.toFixed(2),
    totales.ca.toFixed(2),
    totales.vit_d.toFixed(2),
    totales.k.toFixed(2),
    porcentaje
  ];
}
