if (document.addEventListener)
	window.addEventListener("load", inicio)
else if (document.attachEvent)
	window.attachEvent("onload", inicio);

function inicio() {
    const clienteBoxes = document.querySelectorAll('.box-cliente');
    const calendarArticle = document.getElementById('calendar');

    clienteBoxes.forEach(box => {
        box.addEventListener('click', function () {
            calendarArticle.style.display = 'block';
        });
    });
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        editable: true, 
        eventDrop: function(info) {
            // Esta función se ejecuta cuando se mueve un evento
            alert('Evento movido a: ' + info.event.start.toISOString());

            // Aquí puedes hacer una petición AJAX para guardar el nuevo día en tu base de datos
        },
        events: '../assets/js/json/myfeed.php',
        customButtons: {
          annadirReceta: {
            text: 'Receta',
            click: function() {
              alert('¡Haz clic en el botón personalizado!');
            }
          }
        },
    
        headerToolbar: {
          left: 'prev,next today annadirReceta', // Botones de navegación
          center: 'title',  // Título
          right: 'dayGridMonth,timeGridWeek,timeGridDay' // Vista del calendario (mensual, semanal, diario)
        }
    });

    calendar.render();
};