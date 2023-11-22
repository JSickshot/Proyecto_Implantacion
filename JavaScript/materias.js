
document.addEventListener('DOMContentLoaded', function () {
    cargarMaterias();
});

function cargarMaterias() {
    var materiasSelect = document.getElementById("materia");
    materiasSelect.innerHTML = '<option value="" disabled selected>Seleccione una materia</option>';

    var opcionesMaterias = [
        "Matematicas discretas",
        "Programacion Orientada a Objetos",
        "Implantación y mantenimiento",
        "Redes Local",
        "Protocolos de redes",
        "Sistemas Operativos",
    ];

    for (var i = 0; i < opcionesMaterias.length; i++) {
        var option = document.createElement("option");
        option.value = opcionesMaterias[i];
        option.text = opcionesMaterias[i];
        materiasSelect.add(option);
    }
}

function cargarHorarios() {
    var materiaSeleccionada = document.getElementById("materia").value;
    var horariosSelect = document.getElementById("horario");
    horariosSelect.innerHTML = '<option value="" disabled selected>Seleccione un horario</option>';

    var opcionesHorarios = [
        "Lunes 8:00 AM - 10:00 AM",
        "Martes 2:00 PM - 4:00 PM",
        "Miércoles 1:00 PM - 3:00 PM",
        "Jueves 7:00 AM - 9:00 AM",
        "Viernes 9:00 AM - 12:00 PM",
        "Sábado 8:00 AM - 10:00 AM",
    ];

    for (var i = 0; i < opcionesHorarios.length; i++) {
        var option = document.createElement("option");
        option.value = opcionesHorarios[i];
        option.text = opcionesHorarios[i];
        horariosSelect.add(option);
    }
}
