// Datos simulados
const datosSimulados = [
    { materia: "Matemáticas", grupo: "A", profesor: "Profesor 1", inasistencias: 2, calificacion: 8 },
    { materia: "Historia", grupo: "B", profesor: "Profesor 2", inasistencias: 4, calificacion: 7.5 }
];

// Función para agregar registros a la tabla
function agregarRegistros() {
    const tabla = document.getElementById("tablaMaterias");

    datosSimulados.forEach((registro) => {
        const fila = tabla.insertRow();
        fila.insertCell().textContent = registro.materia;
        fila.insertCell().textContent = registro.grupo;
        fila.insertCell().textContent = registro.profesor;
        fila.insertCell().textContent = registro.inasistencias;
        fila.insertCell().textContent = registro.calificacion;
    });
}

// Llamamos a la función para agregar los registros al cargar la página
window.onload = agregarRegistros;
