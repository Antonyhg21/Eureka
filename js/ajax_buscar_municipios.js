        // Agregar un evento de cambio al select de departamentos
        document.getElementById('id_depto').addEventListener('change', function() {
            var departamentoSeleccionado = this.value;
        
            // Llamar a una función AJAX para obtener las ciudades correspondientes al departamento seleccionado
            // y actualizar dinámicamente el select de ciudades
            actualizarMunic(departamentoSeleccionado);
        });

        function actualizarMunic(departamentoId) {
            // Realizar una solicitud AJAX para obtener las ciudades del departamento seleccionado
            // y actualizar el contenido del select de ciudades
            // Puedes usar bibliotecas como jQuery o Fetch API para realizar la solicitud AJAX

            // Ejemplo con Fetch API:
            fetch('carg_munic.php?depto_id=' + departamentoId)
                .then(response => response.json())
                .then(data => {
                    // Limpiar y actualizar el select de ciudades
                    var selectMunicipios = document.getElementById('id_munic');
                    selectMunicipios.innerHTML = ''; // Limpiar el contenido actual del select

                    // Agregar las nuevas opciones al select de ciudades
                    data.forEach(munic => {
                        var option = document.createElement('option');
                        option.value = munic.id_munic;
                        option.textContent = munic.nom_munic;
                        selectMunicipios.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al obtener ciudades:', error));
        }