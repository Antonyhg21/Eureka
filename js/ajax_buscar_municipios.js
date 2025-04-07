        // Agregar un evento de cambio al select de departamentos
        document.getElementById('id_depto').addEventListener('change', function() {
            var departamentoSeleccionado = this.value;
        
            // Llamar a una función AJAX para obtener las ciudades correspondientes al departamento seleccionado
            // y actualizar dinámicamente el select de ciudades
            try {
                // Llamar a la función para actualizar los municipios
                actualizarMunic(departamentoSeleccionado);
            }
            catch (error) {
                console.error('Error al actualizar los municipios:', error);
            }
        });

        async function actualizarMunic(departamentoId) {
            // Realizar una solicitud AJAX para obtener las ciudades del departamento seleccionado
            // y actualizar el contenido del select de ciudades
            // Puedes usar bibliotecas como jQuery o Fetch API para realizar la solicitud AJAX

            // Ejemplo con Fetch API:
            const request=await fetch('carg_munic.php?depto_id=' + departamentoId);
            const data=await request.json();
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
        }