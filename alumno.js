// Base de datos simulada para Alumnos
let alumnosData = [
  {
      ID: 1,
      nombre: "Carlos",
      apellidoPaterno: "Gómez",
      apellidoMaterno: "Ramírez",
      genero: "Masculino",
      fechaNacimiento: "1995-10-25",
      ciudad: "Ciudad de México",
      alcaldia: "Coyoacán",
      colonia: "Del Valle",
      calle: "Calle Uno",
      numeroExt: "123",
      numeroInt: "2",
      codigoPostal: "04500",
      email: "carlos@gmail.com",
      telefono: "5551234567",
      estado: "Activo"
  },
  {
      ID: 2,
      nombre: "María",
      apellidoPaterno: "López",
      apellidoMaterno: "García",
      genero: "Femenino",
      fechaNacimiento: "1998-03-15",
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

function mostrarAlumnos() {
  let table = document.getElementById("alumnosTable");
  table.innerHTML = `
    <tr>
      <th>ID Alumno</th>
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
  alumnosData.forEach((alumno) => {
      let row = table.insertRow();
      row.innerHTML = `
          <td>${alumno.ID}</td>
          <td>${alumno.nombre}</td>
          <td>${alumno.apellidoPaterno}</td>
          <td>${alumno.apellidoMaterno}</td>
          <td>${alumno.genero}</td>
          <td>${alumno.fechaNacimiento}</td>
          <td>${alumno.ciudad}</td>
          <td>${alumno.alcaldia}</td>
          <td>${alumno.colonia}</td>
          <td>${alumno.calle}</td>
          <td>${alumno.numeroExt}</td>
          <td>${alumno.numeroInt}</td>
          <td>${alumno.codigoPostal}</td>
          <td>${alumno.email}</td>
          <td>${alumno.telefono}</td>
          <td>${alumno.estado}</td>
          <td>
              <button onclick="mostrarFormularioModificar(${alumno.ID})">Modificar</button>
              <button onclick="borrarAlumno(${alumno.ID})">Borrar</button>
          </td>
      `;
  });
}

function agregarAlumno() {
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

  let newAlumno = {
      ID: alumnosData.length + 1,
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
  alumnosData.push(newAlumno);
  cerrarAgregarFormulario();
  mostrarAlumnos();
}

function mostrarFormularioAgregar() {
  document.getElementById("agregarPopup").style.display = "block";
}

function cerrarAgregarFormulario() {
  document.getElementById("agregarPopup").style.display = "none";
}

function mostrarFormularioModificar(alumnoID) {
  let alumno = alumnosData.find((a) => a.ID === alumnoID);
  if (alumno) {
      document.getElementById("modificarPopup").style.display = "block";
      document.getElementById("alumnoIDModificar").value = alumno.ID;
      document.getElementById("nombreModificar").value = alumno.nombre;
      document.getElementById("apellidoPaternoModificar").value = alumno.apellidoPaterno;
      document.getElementById("apellidoMaternoModificar").value = alumno.apellidoMaterno;
      // Asigna los valores de los demás campos del formulario de modificar aquí
      document.getElementById("generoModificar").value = alumno.genero;
      document.getElementById("fechaNacimientoModificar").value = alumno.fechaNacimiento;
      document.getElementById("ciudadModificar").value = alumno.ciudad;
      document.getElementById("alcaldiaModificar").value = alumno.alcaldia;
      document.getElementById("coloniaModificar").value = alumno.colonia;
      document.getElementById("calleModificar").value = alumno.calle;
      document.getElementById("numeroExtModificar").value = alumno.numeroExt;
      document.getElementById("numeroIntModificar").value = alumno.numeroInt;
      document.getElementById("codigoPostalModificar").value = alumno.codigoPostal;
      document.getElementById("emailModificar").value = alumno.email;
      document.getElementById("telefonoModificar").value = alumno.telefono;
      document.getElementById("estadoModificar").value = alumno.estado;

      document.getElementById("guardarAlumnoModificar").onclick = function () {
          alumno.nombre = document.getElementById("nombreModificar").value;
          alumno.apellidoPaterno = document.getElementById("apellidoPaternoModificar").value;
          alumno.apellidoMaterno = document.getElementById("apellidoMaternoModificar").value;
          // Asigna los nuevos valores de los demás campos del formulario de modificar aquí
          alumno.genero = document.getElementById("generoModificar").value;
          alumno.fechaNacimiento = document.getElementById("fechaNacimientoModificar").value;
          alumno.ciudad = document.getElementById("ciudadModificar").value;
          alumno.alcaldia = document.getElementById("alcaldiaModificar").value;
          alumno.colonia = document.getElementById("coloniaModificar").value;
          alumno.calle = document.getElementById("calleModificar").value;
          alumno.numeroExt = document.getElementById("numeroExtModificar").value;
          alumno.numeroInt = document.getElementById("numeroIntModificar").value;
          alumno.codigoPostal = document.getElementById("codigoPostalModificar").value;
          alumno.email = document.getElementById("emailModificar").value;
          alumno.telefono = document.getElementById("telefonoModificar").value;
          alumno.estado = document.getElementById("estadoModificar").value;
          cerrarModificarFormulario();
          mostrarAlumnos();
      };
  }
}

function cerrarModificarFormulario() {
  document.getElementById("modificarPopup").style.display = "none";
}

function borrarAlumno(alumnoID) {
  alumnosData = alumnosData.filter((a) => a.ID !== alumnoID);
  mostrarAlumnos();
}

mostrarAlumnos();
