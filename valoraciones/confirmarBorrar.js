//Creamos una función para la confirmación de borrado 

function confirmarBorrar() {
    var respuesta = confirm("Confirmación: ¿Quires eliminar la entrada?");
    if (respuesta == true) {
        return true;
    } else {
        return false;
    }
}