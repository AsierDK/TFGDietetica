document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        events: '../assets/js/json/myfeed.php',
        customButtons: {
          myCustomButton: {
            text: 'custom!',
            click: function() {
              alert('¡Haz clic en el botón personalizado!');
            }
          }
        },
    
        headerToolbar: {
          left: 'prev,next today myCustomButton', // Botones de navegación
          center: 'title',  // Título
          right: 'dayGridMonth,timeGridWeek,timeGridDay' // Vista del calendario (mensual, semanal, diario)
        }
    });

    calendar.render();
});