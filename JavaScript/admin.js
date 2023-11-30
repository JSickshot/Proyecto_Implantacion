function eliminarUsuario(id) {
    fetch('eliminar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + id,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data.message); 
            } else {
                console.error(data.message);
                alert('Hubo un error al eliminar el usuario. Por favor, inténtelo de nuevo.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al eliminar el usuario. Por favor, inténtelo de nuevo.');
        });
}

function mostrarFormularioUsuario(idUsuario) {
    var nombre = document.getElementById('nombre_' + idUsuario).innerText;
    var apellidoP = document.getElementById('apellidoP_' + idUsuario).innerText;

    document.getElementById('id_usuario_modificar').value = idUsuario;
    document.getElementById('nombre_modificar').value = nombre;
    document.getElementById('apellidoP_modificar').value = apellidoP;

    document.getElementById('formulario-modificacion-usuario').style.display = 'block';
}

