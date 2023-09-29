let materiasData = [
  { ID: 1, NOMBRE: "Materia 1", CUATRIMESTRE: 1, ESTADO: "Activa" },
  { ID: 2, NOMBRE: "Materia 2", CUATRIMESTRE: 2, ESTADO: "Inactiva" },
];

let carrerasData = [
  { ID: 1, NOMBRE: "CARRERA 1", CUATRIMESTRE: 1, ESTADO: "Activa" },
  { ID: 2, NOMBRE: "CARRERA 2", CUATRIMESTRE: 2, ESTADO: "Inactiva" },
];

let salonesData = [
  { ID: 1, TIPO: "Aula", DISPONIBILIDAD: "Disponible", CAPACIDAD: 30, DESCRIPCION: "Salón para clases teóricas." },
  { ID: 2, TIPO: "Laboratorio", DISPONIBILIDAD: "Ocupado", CAPACIDAD: 20, DESCRIPCION: "Salón equipado para prácticas de laboratorio." },
];

function mostrarMaterias() {
  let table = document.getElementById("materiasTable");
  table.innerHTML = `
      <tr>
          <th>ID</th>
          <th>NOMBRE</th>
          <th>CUATRIMESTRE</th>
          <th>ESTADO</th>
          <th>Acciones</th>
      </tr>
  `;
  materiasData.forEach((materia) => {
      let row = table.insertRow();
      row.innerHTML = `
          <td>${materia.ID}</td>
          <td>${materia.NOMBRE}</td>
          <td>${materia.CUATRIMESTRE}</td>
          <td>${materia.ESTADO}</td>
          <td>
              <button onclick="mostrarFormularioModificar(${materia.ID}, 'materia')">Modificar</button>
              <button onclick="borrarElemento(${materia.ID}, 'materia')">Borrar</button>
          </td>
      `;
  });
}

function agregarElemento(tipo) {
  if (tipo === 'materia') {
      let nombre = document.getElementById("materiaNombre").value;
      let cuatrimestre = parseInt(document.getElementById("materiaCuatrimestre").value);
      let estado = document.getElementById("materiaEstado").value;

      let newElemento = {
          ID: materiasData.length + 1, // Simulamos el ID autoincremental
          NOMBRE: nombre,
          CUATRIMESTRE: cuatrimestre,
          ESTADO: estado,
      };
      materiasData.push(newElemento);
  } else if (tipo === 'carrera') {
      let nombre = document.getElementById("carreraNombre").value;
      let cuatrimestre = parseInt(document.getElementById("carreraCuatrimestre").value);
      let estado = document.getElementById("carreraEstado").value;

      let newElemento = {
          ID: carrerasData.length + 1, // Simulamos el ID autoincremental
          NOMBRE: nombre,
          CUATRIMESTRE: cuatrimestre,
          ESTADO: estado,
      };
      carrerasData.push(newElemento);
  } else if (tipo === 'salon') {
      let tipo = document.getElementById("salonTipo").value;
      let disponibilidad = document.getElementById("salonDisponibilidad").value;
      let capacidad = parseInt(document.getElementById("salonCapacidad").value);
      let descripcion = document.getElementById("salonDescripcion").value;

      let newElemento = {
          ID: salonesData.length + 1, // Simulamos el ID autoincremental
          TIPO: tipo,
          DISPONIBILIDAD: disponibilidad,
          CAPACIDAD: capacidad,
          DESCRIPCION: descripcion,
      };
      salonesData.push(newElemento);
  }

  cerrarFormularioAgregar(tipo);
  mostrarElementos(tipo);
}

function mostrarFormularioAgregar(tipo) {
  document.getElementById(`agregarPopupForm-${tipo}`).style.display = "block";
}

function cerrarFormularioAgregar(tipo) {
  document.getElementById(`agregarPopupForm-${tipo}`).style.display = "none";
}

function mostrarFormularioModificar(elementoID, tipo) {
  let elemento;
  if (tipo === 'materia') {
      elemento = materiasData.find((m) => m.ID === elementoID);
  } else if (tipo === 'carrera') {
      elemento = carrerasData.find((c) => c.ID === elementoID);
  } else if (tipo === 'salon') {
      elemento = salonesData.find((s) => s.ID === elementoID);
  }

  if (elemento) {
      document.getElementById("modificarPopupForm").style.display = "block";
      document.getElementById("nombreModificar").value = elemento.NOMBRE;
      document.getElementById("cuatrimestreModificar").value = elemento.CUATRIMESTRE;
      document.getElementById("estadoModificar").value = elemento.ESTADO;
      // Agregar el código para mostrar los campos específicos de los salones (tipo, disponibilidad, capacidad, descripción) en el formulario de modificar.
      if (tipo === 'salon') {
          document.getElementById("tipoModificar").value = elemento.TIPO;
          document.getElementById("disponibilidadModificar").value = elemento.DISPONIBILIDAD;
          document.getElementById("capacidadModificar").value = elemento.CAPACIDAD;
          document.getElementById("descripcionModificar").value = elemento.DESCRIPCION;
      }

      document.getElementById("guardarElementoModificar").onclick = function () {
          elemento.NOMBRE = document.getElementById("nombreModificar").value;
          elemento.CUATRIMESTRE = parseInt(document.getElementById("cuatrimestreModificar").value);
          elemento.ESTADO = document.getElementById("estadoModificar").value;
          // Agregar el código para guardar los campos específicos de los salones (tipo, disponibilidad, capacidad, descripción) en el objeto 'elemento'.
          if (tipo === 'salon') {
              elemento.TIPO = document.getElementById("tipoModificar").value;
              elemento.DISPONIBILIDAD = document.getElementById("disponibilidadModificar").value;
              elemento.CAPACIDAD = parseInt(document.getElementById("capacidadModificar").value);
              elemento.DESCRIPCION = document.getElementById("descripcionModificar").value;
          }
          cerrarModificarFormulario();
          mostrarElementos(tipo);
      };
  }
}

function cerrarModificarFormulario() {
  document.getElementById("modificarPopupForm").style.display = "none";
}

function borrarElemento(elementoID, tipo) {
  if (tipo === 'materia') {
      materiasData = materiasData.filter((m) => m.ID !== elementoID);
  } else if (tipo === 'carrera') {
      carrerasData = carrerasData.filter((c) => c.ID !== elementoID);
  } else if (tipo === 'salon') {
      salonesData = salonesData.filter((s) => s.ID !== elementoID);
  }

  mostrarElementos(tipo);
}

function mostrarElementos(tipo) {
  let table;
  let data;

  if (tipo === 'materia') {
      table = document.getElementById("materiasTable");
      data = materiasData;
  } else if (tipo === 'carrera') {
      table = document.getElementById("carrerasTable");
      data = carrerasData;
  } else if (tipo === 'salon') {
      table = document.getElementById("salonesTable");
      data = salonesData;
  }

  table.innerHTML = `
      <tr>
          <th>ID</th>
          <th>NOMBRE</th>
          <th>CUATRIMESTRE</th>
          <th>ESTADO</th>
          ${tipo === 'salon' ? '<th>TIPO</th><th>DISPONIBILIDAD</th><th>CAPACIDAD</th><th>DESCRIPCION</th>' : ''}
          <th>Acciones</th>
      </tr>
  `;

  data.forEach((elemento) => {
      let row = table.insertRow();
      row.innerHTML = `
          <td>${elemento.ID}</td>
          <td>${elemento.NOMBRE}</td>
          <td>${elemento.CUATRIMESTRE}</td>
          <td>${elemento.ESTADO}</td>
          ${tipo === 'salon' ? `<td>${elemento.TIPO}</td><td>${elemento.DISPONIBILIDAD}</td><td>${elemento.CAPACIDAD}</td><td>${elemento.DESCRIPCION}</td>` : ''}
          <td>
              <button onclick="mostrarFormularioModificar(${elemento.ID}, '${tipo}')">Modificar</button>
              <button onclick="borrarElemento(${elemento.ID}, '${tipo}')">Borrar</button>
          </td>
      `;
  });
}

// Mostrar las materias al cargar la página
mostrarElementos('materia');
mostrarElementos('carrera');
mostrarElementos('salon');
