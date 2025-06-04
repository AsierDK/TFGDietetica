if (document.addEventListener)
	window.addEventListener("load", inicio)
else if (document.attachEvent)
	window.attachEvent("onload", inicio);

function inicio() {
    const dialog = document.getElementById('cambiarPass');
    const id_alumno = document.getElementById('id_alumno');
    document.getElementById('cerrarDialog').addEventListener('click', () => {
        dialog.close();
    });

    document.querySelectorAll('.cambiar-pass').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            id_alumno.value = id;
            dialog.showModal();
        });
    });
}