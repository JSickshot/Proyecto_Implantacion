// Base de datos simulada para Profesores
let profesoresData = [
    {
        ID: 1,
        nombre: "Juan",
        apellidoPaterno: "Gómez",
        apellidoMaterno: "Ramírez",
        genero: "Masculino",
        fechaNacimiento: "1980-05-15",
        ciudad: "Ciudad de México",
        alcaldia: "Coyoacán",
        colonia: "Del Valle",
        calle: "Calle Uno",
        numeroExt: "123",
        numeroInt: "2",
        codigoPostal: "04500",
        email: "juan@gmail.com",
        telefono: "5558765432",
        estado: "Activo"
    },
    {
        ID: 2,
        nombre: "María",
        apellidoPaterno: "López",
        apellidoMaterno: "García",
        genero: "Femenino",
        fechaNacimiento: "1975-11-22",
        ciudad: "Guadalajara",
        alcaldia: "Zapopan",
        colonia: "Lomas",
        calle: "Calle Dos",
        numeroExt: "456",
        numeroInt: "",
        codigoPostal: "45010",
        email: "maria@hotmail.com",
        telefono: "3339876543",
        estado: "Activo"
    },
    // Agrega más datos de ejemplo aquí...
];

function mostrarProfesores() {
    let table = document.getElementById("profesoresTable");
    table.innerHTML = `
      <tr>
        <th>ID Profesor</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Género</th>
        <th>Fecha de nacimiento</th>
        <th>Ciudad</th>
        <th>Alcaldía</th>
        <th>Colonia</th>
        <th>Calle</th>
        <th>Número Ext</th>
        <th>Número Int</th>
        <th>Código Postal</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    `;
    profesoresData.forEach((profesor) => {
        let row = table.insertRow();
        row.innerHTML = `
            <td>${profesor.ID}</td>
            <td>${profesor.nombre}</td>
            <td>${profesor.apellidoPaterno}</td>
            <td>${profesor.apellidoMaterno}</td>
            <td>${profesor.genero}</td>
            <td>${profesor.fechaNacimiento}</td>
            <td>${profesor.ciudad}</td>
            <td>${profesor.alcaldia}</td>
            <td>${profesor.colonia}</td>
            <td>${profesor.calle}</td>
            <td>${profesor.numeroExt}</td>
            <td>${profesor.numeroInt}</td>
            <td>${profesor.codigoPostal}</td>
            <td>${profesor.email}</td>
            <td>${profesor.telefono}</td>
            <td>${profesor.estado}</td>
            <td>
                <button onclick="mostrarFormularioModificar(${profesor.ID})">Modificar</button>
                <button onclick="borrarProfesor(${profesor.ID})">Borrar</button>
            </td>
        `;
    });
}

function agregarProfesor() {
    let nombre = document.getElementById("nombre").value;
    let apellidoPaterno = document.getElementById("apellidoPaterno").value;
    let apellidoMaterno = document.getElementById("apellidoMaterno").value;
    let genero = document.getElementById("genero").value;
    let fechaNacimiento = document.getElementById("fechaNacimiento").value;
    let ciudad = document.getElementById("ciudad").value;
    let alcaldia = document.getElementById("alcaldia").value;
    let colonia = document.getElementById("colonia").value;
    let calle = document.getElementById("calle").value;
    let numeroExt = document.getElementById("numeroExt").value;
    let numeroInt = document.getElementById("numeroInt").value;
    let codigoPostal = document.getElementById("codigoPostal").value;
    let email = document.getElementById("email").value;
    let telefono = document.getElementById("telefono").value;
    let estado = document.getElementById("estado").value;

    let newProfesor = {
        ID: profesoresData.length + 1,
        nombre: nombre,
        apellidoPaterno: apellidoPaterno,
        apellidoMaterno: apellidoMaterno,
        genero: genero,
        fechaNacimiento: fechaNacimiento,
        ciudad: ciudad,
        alcaldia: alcaldia,
        colonia: colonia,
        calle: calle,
        numeroExt: numeroExt,
        numeroInt: numeroInt,
        codigoPostal: codigoPostal,
        email: email,
        telefono: telefono,
        estado: estado
    };
    profesoresData.push(newProfesor);
    cerrarAgregarFormulario();
    mostrarProfesores();
}

function mostrarFormularioAgregar() {
    document.getElementById("agregarPopup").style.display = "block";
}

function cerrarAgregarFormulario() {
    document.getElementById("agregarPopup").style.display = "none";
}

function mostrarFormularioModificar(profesorID) {
    let profesor = profesoresData.find((p) => p.ID === profesorID);
    if (profesor) {
        document.getElementById("modificarPopup").style.display = "block";
        document.getElementById("profesorIDModificar").value = profesor.ID;
        document.getElementById("nombreModificar").value = profesor.nombre;
        document.getElementById("apellidoPaternoModificar").value = profesor.apellidoPaterno;
        document.getElementById("apellidoMaternoModificar").value = profesor.apellidoMaterno;
        document.getElementById("generoModificar").value = profesor.genero;
        document.getElementById("fechaNacimientoModificar").value = profesor.fechaNacimiento;
        document.getElementById("ciudadModificar").value = profesor.ciudad;
        document.getElementById("alcaldiaModificar").value = profesor.alcaldia;
        document.getElementById("coloniaModificar").value = profesor.colonia;
        document.getElementById("calleModificar").value = profesor.calle;
        document.getElementById("numeroExtModificar").value = profesor.numeroExt;
        document.getElementById("numeroIntModificar").value = profesor.numeroInt;
        document.getElementById("codigoPostalModificar").value = profesor.codigoPostal;
        document.getElementById("emailModificar").value = profesor.email;
        document.getElementById("telefonoModificar").value = profesor.telefono;
        document.getElementById("estadoModificar").value = profesor.estado;

        document.getElementById("guardarProfesorModificar").onclick = function () {
            profesor.nombre = document.getElementById("nombreModificar").value;
            profesor.apellidoPaterno = document.getElementById("apellidoPaternoModificar").value;
            profesor.apellidoMaterno = document.getElementById("apellidoMaternoModificar").value;
            profesor.genero = document.getElementById("generoModificar").value;
            profesor.fechaNacimiento = document.getElementById("fechaNacimientoModificar").value;
            profesor.ciudad = document.getElementById("ciudadModificar").value;
            profesor.alcaldia = document.getElementById("alcaldiaModificar").value;
            profesor.colonia = document.getElementById("coloniaModificar").value;
            profesor.calle = document.getElementById("calleModificar").value;
            profesor.numeroExt = document.getElementById("numeroExtModificar").value;
            profesor.numeroInt = document.getElementById("numeroIntModificar").value;
            profesor.codigoPostal = document.getElementById("codigoPostalModificar").value;
            profesor.email = document.getElementById("emailModificar").value;
            profesor.telefono = document.getElementById("telefonoModificar").value;
            profesor.estado = document.getElementById("estadoModificar").value;
            cerrarModificarFormulario();
            mostrarProfesores();
        };
    }
}

function cerrarModificarFormulario() {
    document.getElementById("modificarPopup").style.display = "none";
}

function borrarProfesor(profesorID) {
    profesoresData = profesoresData.filter((p) => p.ID !== profesorID);
    mostrarProfesores();
}

mostrarProfesores();
