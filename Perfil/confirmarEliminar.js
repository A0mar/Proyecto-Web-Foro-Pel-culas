//Creamos una función para la confirmación de borrado 

function confirmarEliminar() {
    var respuesta = confirm("Confirmación: ¿Estás seguro de querer eliminar tu cuenta? Esta acción no se puede deshacer");
    if (respuesta == true) {
        return true;
    } else {
        return false;
    }
}