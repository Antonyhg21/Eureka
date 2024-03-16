function validarFormulario() {
    var idUsuario = document.getElementById("id_usuario").value;
    var nomUsuario = document.getElementById("nom_usuario").value;
    var apeUsuario = document.getElementById("ape_usuario").value;
    // Agrega más variables para los otros campos

    if (idUsuario === "" || nomUsuario === "" || apeUsuario === "") {
        alert("Por favor, completa todos los campos obligatorios.");
        return false;
    }

    // Agrega más validaciones aquí si es necesario

    return true;
}