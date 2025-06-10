function inicioEditar() {
    const tipo = window.tipo;
    const editButton = document.querySelector('.edit.btn');
    const id = editButton.dataset.id;
    const dialog = document.getElementById('editDialog');
    const closeBtn = document.getElementById('closeDialogBtn');
    closeBtn.addEventListener('click', () => {
        dialog.close();
    });

    editButton.addEventListener('click', () => {
        dialog.showModal();
        fetch(`../controllers/Editar.php?tipo=${tipo}&id=${id}`)
            .then(correcto)
            .catch(errores);
    });
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
    const form = document.forms['dialog'];
    a = JSON.parse(datos);
    if (tipo === 'alimentos') {
        form.nombreAlimento.value = a.nombreAlimento;
        form.pc.value = a.PC;
        form.e_100.value = a.e_100;
        form.prot_100.value = a.prot_100;
        form.grasa_100.value = a.grasa_100;
        form.ags_100.value = a.ags_100;
        form.agmi_100.value = a.agmi_100;
        form.agpi_100.value = a.agpi_100;
        form.col_100.value = a.col_100;
        form.hc_100.value = a.hc_100;
        form.fibra_100.value = a.fibra_100;
        form.vit_c_100.value = a.vit_c_100;
        form.vit_b6_100.value = a.vit_b6_100;
        form.vit_e_100.value = a.vit_e_100;
        form.fe_100.value = a.fe_100;
        form.na_100.value = a.na_100;
        form.ca_100.value = a.ca_100;
        form.k_100.value = a.k_100;
        form.vit_d_100.value = a.vit_d_100;
        form.id_alimento.value = a.id_alimentos;
    } else {
        form.nombreReceta.value = a.nombre_receta;
        form.desc.value = a.desc_receta;
        form.id_receta.value = a.id_receta;
    }
}