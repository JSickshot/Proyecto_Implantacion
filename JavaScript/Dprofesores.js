function obtenerDatos() {
    var registro = document.getElementById("registro").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                console.log("Respuesta JSON:", data);

                document.getElementById("gerencia").value = data.gerencia;
                document.getElementById("sucursal").value = data.sucursal;
                document.getElementById("region").value = data.region;
            } else {
                console.error("Error al obtener los datos");
            }
        }
    };

    xhr.open("POST", "datos.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("registro=" + encodeURIComponent(registro));
}