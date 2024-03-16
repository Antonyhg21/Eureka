        // Agregar un evento de cambio al select de tipo de elementos
        document.getElementById('id_tipo').addEventListener('change', function() {
            var tipo_elementoSeleccionado = this.value;
        
            // Llamar a una función AJAX para obtener los elementos correspondientes al tipo de elementos seleccionado
            // y actualizar dinámicamente el select de elementos
            actualizarElementos(tipo_elementoSeleccionado);
        });

        function actualizarElementos(tipo_elementoId) {
            // Realizar una solicitud AJAX para obtener los elementos del tipo de elementos seleccionado
            // y actualizar el contenido del select de elementos
            // Puedes usar bibliotecas como jQuery o Fetch API para realizar la solicitud AJAX

            // Ejemplo con Fetch API:
            fetch('carg_elementos.php?tipo_elemento_id=' + tipo_elementoId)
                .then(response => response.json())
                .then(data => {
                    // Limpiar y actualizar el select de los elementos
                    var selectElementos = document.getElementById('id_elemento');
                    selectElementos.innerHTML = ''; // Limpiar el contenido actual del select

                    // Agregar las nuevas opciones al select de elementos
                    data.forEach(elementos => {
                        var option = document.createElement('option');
                        option.value = elementos.id_elemento;
                        option.textContent = elementos.nom_elemento;
                        selectElementos.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al obtener los elementos:', error));
        }