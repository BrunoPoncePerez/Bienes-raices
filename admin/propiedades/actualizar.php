<?php

//Validar que sea un URL valido

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /admin');
}

/*====BASE DE DATOS====*/
require '../../includes/config/database.php';

$db = conectarDB();

//OBTENER LOS DATOS DE LA PROPIEDAD

$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$respuesta = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($respuesta);


//CONSULTAR VENDEDORES

$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

/*echo "<pre>";
var_dump($_SERVER['REQUEST_METHOD']); 
echo"</pre>";
 esta superglobal server contiene informacion
de todo el servidor. Es un arreglo al que podemos acceder como un arreglo 
normal*/

/* echo "<pre>";
var_dump($_POST); 
echo"</pre>"; */



/*===VALIDACION DEL FORMULARIO===*/
//ARREGLO CON MENSAJES DE ERRORES
//creamos un arreglo

$errores = [];

/* creamos las variables de forma global y al realizar 
rl request method se asignaran los valores que
tengan cada uno de los inputs*/

$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorid = $propiedad['vendedorid'];
/* El campo de imagenes por seguridad no se debe llenar, ya que expone
mucha informacion de la ruta del archivo, lo mas conveniente es colocarlo
dentro de la descripcion de la propiedad*/
$imagenPropiedad = $propiedad['imagen'];



//EJECUTAR EL CODIGO DESPUES DE QUE EL USUARIO ENVIA EL FORMULARIO



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

     echo "<pre>";
    var_dump($_POST); 
    echo"</pre>";  

    /**********SUBIR IMAGENES CON PHP************/

   /*  echo "<pre>";
    var_dump($_POST); 
    echo"</pre>";  */

    /* el metodo POST no describe o no da informacion dek archivo 
    que estamos subiendo, para ello utilizamos la superglobal de FILES */

  /*    echo "<pre>";
    var_dump($_FILES); 
    echo"</pre>"; */ 
    //exit;


    //######### SANITIZAR ENTRADA DE DATOS ##########

    /* "la funcion mysqli_real_escape_string" escapa datos maliciosos, 
    es decir que en caso de que alguien coloque un codigo de SQL
     lo desabilitará, lo guardará en la base de datos pero no lo ejecutará.
     Coomo es una funcion su primer parametro seria la base de datos
     y el segundo lo que vamos a validar. De esta forma nuestro codigo será
     más seguro y utiliza los filtros de validacion para validar que sean 
     numeros enteros o strings segun sean necesario
      */
     

    $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
    $precio = mysqli_real_escape_string( $db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string( $db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
    $vendedorid = mysqli_real_escape_string( $db, $_POST['vendedorid']);
    $creado = date('Y/m/d');
    //#########  FIN SANITIZAR ENTRADA DE DATOS ##########

    //asignar files a una variable
    
    $imagen = $_FILES['imagen'];
    
    /* var_dump($imagen['name']); */

     //exit;

    /* con el name estamos validando de que el usuario tenga que subir
    una imagen obligatoriamente, entoces al ver que existe un name, 
    veremos de que se subio correctamente dicha imagen, caso contrario 
    no aparecerá nada, ya que estara vacio y nos daremos cuenta de que 
    el usuario no ha subido una imagen. Entonces validaremos o le diremos 
    al usuario de que tiene que subir una imagen obligadamente */
   

    /* continuando con el validador de formularios */
    /* COLOCAMOS UN IF... */
    /* si titulo esta vacio se colocara automaticamente en nuestros
    arreglo de errores y ya no en la base de datos */

    if (!$titulo) {
        $errores[] = "*Debes añadir un titulo*";
    }
    if (!$precio) {
        $errores[] = "*El Precio es Obligatorio*";
    }

    /* entonces creamos una validacion para la imagen */
    /* if(!$imagen['name'] || $imagen['error']){
        $errores[] = "*La Imagen es Obligatoria*";
    } */

    //validar por tamaño de 100Kb
 
     $medida = 1000 * 1000;

    if($imagen['size']> $medida){
        $errores[] = '*La imagen es muy pesada*'; 
    } 

    if (strlen($descripcion) < 50) {
        $errores[] = "*Debes añadir una Descripcion de 50 caracteres como minimo*";
    }
    

    if (!$habitaciones) {
        $errores[] = "*Añade la cantidad de Habitaciones*";
    }
    if (!$wc) {
        $errores[] = "*Debes añadir el número de Baños*";
    }
    if (!$estacionamiento) {
        $errores[] = "*Añade la cantidad de Estacionamientos*";
    }
    if (!$vendedorid) {
        $errores[] = "*Elige un Vendedor*";
    }

    


    /* echo "<pre>";
    var_dump($errores); 
    echo"</pre>"; */

    /* exit; */


    /* para ejecutar el codigo de $query y los siguientes se deben
ejecutar de forma condicional y la condicion que tenemos que revisar es
que el arreglo de errores esté vacio, si hay al menos un error
insertado no se debe ejecutar en la base datos entonces... */

    //revisamos que el arreglo de errores esté vacio

    if (empty($errores)) {


        /**  SUBIDA DE ARCHIVOS **/

        // (1) crear carpeta
                      
        $carpetaImg = '../../imagenes/'/* nos salimos de admin, propiedades */;

        //  creamos un directorio con mkdir
        
        /* mkdir($carpetaImg); */

        /* el problema con esto es que nos creará carpeta
        tras carpeta, entonces tenemos que verificar que
        exista esta carpeta y si no, que la cree */

        /* is_dir, nos dira si una carpeta existe o no */

       if(!is_dir($carpetaImg)){ 
        /* si existe esta carpeta no hacemos nada y si no existe
        la creamos */
             mkdir($carpetaImg);  
        } 

        // (3) GENERAMOS UN NOMBRE UNICO PARA CADA IMAGEN


        //Define la extensión para el archivo
          if ($imagen['type'] === 'imagen/jpeg') {
	               $exten = '.jpg';
            }else{$exten = '.png';} 


        /* md5 = nos da  como un id unico, pero al recargar la pagina
        nos da siempre lo mismo.
        
        uniqid = podemos dejarlo con un string vacio
        
        rand() = nos genera numeros aleatorios
        */

        $nombreImagen = md5(uniqid(rand(), true)) . $exten;

        /*** (2) subir la imagen***/

        /* al momento de rellenar el formulario y elegir la imagen
        nos crea la carpeta en la raiz del proyecto

        el tmp_name es un nombre temporal de los archivos. Cuando subimos un 
        archivo esta imagen se guarda en algun lugar del servidor de forma temporal
        pero tenemos que usar una funcio de php para llevarla a su destino y una
        vez que se guarde almacenar la ruta
            
             array(1) {
              ["imagen"]=>
              array(6) {
              ["name"]=>
              string(12) "anuncio2.jpg"
              ["full_path"]=>
              string(12) "anuncio2.jpg"
              ["type"]=>
              string(10) "image/jpeg"
              ["tmp_name"]=>
              string(45) "C:\Users\Ponce\AppData\Local\Temp\php2574.tmp"
              ["error"]=>
              int(0)
              ["size"]=>
              int(98318)
                }
             } 
             
             entonces usamos la funcion de move_uploaded_file() que recive 
             dos parametros, uno es el nombre temporal de la imagen y el otro
             es la carpeta donde la guardaremos*/

             move_uploaded_file($imagen["tmp_name"], $carpetaImg . $nombreImagen);

             /* lo malo de esta funcion es que al subir otra imagen, la nueva reemplazará
             a la anterior ya que le concatenamos el mismo nombre, y en una carpeta
             no puede existir dos archivos con un mismo nombre */

        /* exit; */

        //INSERTAR EN LA BASE DE DATOS

        $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}',
        imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc},
        estacionamiento = ${estacionamiento}, vendedorid = ${vendedorid} WHERE id = ${id} ";

      /*   echo $query;

        exit; */



        /*===PASAR AUTOMATICAMENTE A LA BASE DE DATOS=== */

        /*para almacenar en la base de datos cramos una variable
       y le pasamos la coneccion a la base de datos "$db" y
       como segundo valor se le pasa el "$query" */

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //echo "Insertado correctamente";
            /*redireccionar al usuario, para evitar que se duplique
            la informacion en la base de datos*/

            header('Location: /admin?resultado=2');

            /* ¡¡¡este codigo se ejecutara o redireccionará al usuario,
            si antes no hay nada de codigo html previo!!! */
        }
        /*===PASAR AUTOMATICAMENTE A LA BASE DE DATOS=== */
    }
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">

    <h1>Actualizar Propiedad</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <!-- metodo: POST y GET
    el metodo GET agrega informacion a la url, pero es importante
    colocar un name en cada input, de preferencia con el mismo id. GET expone
    los datos en la URL.
    POST: los maneja internamente en el archivo, es una forma más
    segura, dependiendo los casos usaras una de ambas.

    en formularios podemos usar POST y en una tienda en linea podemos usar
    GET, ya que ahi viene informacion del producto que se va a mostrar .

         **atributo ACTION: que archivo o a donde se van a guardar todos
        los datos  -->

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>


    <form class="formulario" method="POST"  enctype="multipart/form-data">
                                                                             

        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad " value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="imagen/jpeg, imagen/png" name="imagen">

            <img src="/imagenes/<?php echo $imagenPropiedad ?>" class="img-small">


            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion">
                        <?php echo $descripcion; ?>
            </textarea>

        </fieldset>

        <fieldset>
            <legend>Informacion de la Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min=1 max=9 value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min=1 max=9 value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min=1 max=9 value="<?php echo $estacionamiento; ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedorid">
                <option value="">
                    <--Seleccione-->
                </option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php  echo $vendedorid === $vendedor['id'] ? 'selected' : '';?> value="<?php echo $vendedor['id']; ?>">
                        <?php echo $vendedor['nombre'] . "" . $vendedor['apellido']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <!-- NAME: es importante por que nos va a permitir leer
         todo lo que el usuario escriba -->

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

    </form>



</main>

 <?php

incluirTemplate('footer');
?>