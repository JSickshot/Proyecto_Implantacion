src="https://code.jquery.com/jquery-3.6.4.min.js">

$(document).ready(function () {
    $('.eliminar').on('click', function () {
        var idUsuario = $(this).data('id');

        if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
            $.ajax({
                type: 'POST',
                url: 'eliminar.php', 
                data: { id: idUsuario },
                success: function (response) {
                    alert(response); 
                },
                error: function (error) {
                    console.error(error);
                    alert("Error al intentar eliminar el usuario.");
                }
            });
        }
    });
});