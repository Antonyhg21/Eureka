        // Agregar un evento de cambio al select de municipios
        document.getElementById('id_munic').addEventListener('change', function() {
            var municipioSeleccionado = this.value;
        
            // Llamar a una función AJAX para obtener los sitios correspondientes al municipio seleccionado
            // y actualizar dinámicamente el select de sitios
            actualizarSitio(municipioSeleccionado);
        });

        function actualizarSitio(municipioId) {
            // Realizar una solicitud AJAX para obtener los sitios del municipio seleccionado       
            // y actualizar el contenido del select de sitios
            // Puedes usar bibliotecas como jQuery o Fetch API para realizar la solicitud AJAX

            // Ejemplo con Fetch API:
            fetch('carg_sitios.php?munic_id=' + municipioId)
                .then(response => response.json())
                .then(data => {
                    // Limpiar y actualizar el select de los sitios
                    var selectSitios = document.getElementById('id_sitio');
                    selectSitios.innerHTML = ''; // Limpiar el contenido actual del select

                    // Agregar las nuevas opciones al select de sitios
                    data.forEach(sitio => {
                        var option = document.createElement('option');
                        option.value = sitio.id_sitio;
                        option.textContent = sitio.nom_sitio;
                        selectSitios.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al obtener los sitios:', error));
        }