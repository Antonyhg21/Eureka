<head>
    <link rel="stylesheet" href="../css/style-chek.css"> <!-- Incluir hoja de estilos adicional -->
</head>

<div class="container col-md-9">
    <div class="row justify-content-center"> <!-- Centrar el formulario en la página -->
        <div class="col-md-5 col-md-4">
            <div class="card card-form"> <!-- Estilo de tarjeta para el formulario -->
                <div class="card-header text-center">
                    <h4>Registro de tipo de elemento.</h4> <!-- Título del formulario -->
                </div>
                <div class="card-body">
                    <!-- Formulario para insertar un nuevo tipo de elemento -->
                    <form action="ins_tipo_elemento.php" method="post">
                        <!-- Campo de entrada para el nombre del tipo de elemento -->
                        <input type="text" class="form-control" name="nom_tipo" id="nom_tipo" placeholder="Nombre del tipo de elemento" required>
                        <div class="form-group text-center btn-container">
                            <!-- Botón para enviar el formulario -->
                            <button type="submit" class="btn btn-primary btn-block">Guardar registro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>