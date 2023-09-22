function verDetalles(materia, grupo, salon) {
  const detallesDiv = document.getElementById('detalles');
  detallesDiv.innerHTML = `<h2>Detalles de ${materia}</h2>
                           <p><b>Grupo:</b> ${grupo}</p>
                           <p><b>Salón:</b> ${salon}</p>`;
}
