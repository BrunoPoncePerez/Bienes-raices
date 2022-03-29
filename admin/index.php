<?php

/* PASOS IMPORTANTES PARA CONSULTAR LA BASE DE DATOS  */
//(1)importar la conexion

/* recordemos que index se encuentra dentro de propiedades
por ese motivo solo queremos salirnos una vez: ../includes... */
require '../includes/config/database.php';

$db = conectarDB(); //acá ya tenemos la instancia  a la conxion de la BD

//(2)escribir el query

$query = "SELECT * FROM propiedades";

//(3)consultar la base de datos

$resultadoConsulta = mysqli_query($db, $query);

//muestra un mensaje condicional
$resultado = $_GET['resultado'] ?? null;

//incluye un template
require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">

    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
      
        <?php elseif (intval($resultado) === 2) : ?>
            <p class="alerta exito">Anuncio Actualizado correctamente</p>
    <?php endif; ?>


    <a href="admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- (4) mostrar los resultados -->
            <!-- cada registro requiere un tr por ende lo creamos -->
            <?php while ($propiedad = mysqli_fetch_array($resultadoConsulta)) : ?>
                <tr>
                    <td> <?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                    <td>S/<?php echo $propiedad['precio']; ?></td>
                    <td>
                        <a href="#" class="boton-rojo-block">Eliminar</a>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id'];?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</main>

<?php

// (5) CERRAR LA CONEXION

mysqli_close(($db));

incluirTemplate('footer');
?>