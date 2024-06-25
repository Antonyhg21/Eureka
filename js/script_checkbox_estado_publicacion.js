    // js para el pop up de el checkbox

    let checkboxes = document.querySelectorAll('.flexSwitchCheckReverse');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function(e) {
            let id_seekfind = this.dataset.id;
            let estado_usuario = this.checked ? 1 : 0;

            if (!this.checked) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Ya has encontrado tu elemento?',
                    showDenyButton: true,
                    confirmButtonText: `Si, lo he encontrado`,
                    denyButtonText: `No, aun no`,
                    customClass: {
                        confirmButton: 'btn btn-primary m-2 p-3',
                        denyButton: 'btn btn-danger m-2 p-3'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.checked = false;
                        estado_usuario = 0;

                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "u_estado_publicacion.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.send("id_seekfind=" + id_seekfind + "&estado_usuario=" + estado_usuario);

                        xhr.onload = function() {
                            if (xhr.status == 200) {
                                console.log("Respuesta recibida: " + xhr.responseText);
                            } else {
                                console.log("Error con la solicitud: " + xhr.status);
                            }
                        }

                    } else if (result.isDenied) {
                        this.checked = true;
                        estado_usuario = 1;
                    }
                })
            }
        });
    });