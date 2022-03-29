/*==========REGISTRAMOS UN LISTENER============*/
document.addEventListener('DOMContentLoaded', function(){
/* escuchamos por DOMContentLoaded,es decir, que el documento este cargado, y haya cargado tanto el
el HTML, CSS y el JS... Seguido ejecutamos una funcion (a esto se le llama colback), 
que se registrará como... */
eventListeners();
darkMode(); /* creamos la funcion de darkmode para que ni bien cargue el navegador la funcion
se ejecute */
});

function darkMode() {

    /* ===PREFERENCIA DE USUARIO SI USA DARKMODE EN EL SISTEMA OPERATIVO=== */
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode')
    } else{
        document.body.classList.remove('dark-mode')
    }
    
    /* ===SE EJECUTARA ESTA FUNCION AUTOMATICAMENTE SI EL USUARIO CAMBIA EL TEMA DEL SISTEMA=== */
    prefiereDarkMode.addEventListener('change', function(){
        if(prefiereDarkMode.matches){
            document.body.classList.add('dark-mode')
        } else{
            document.body.classList.remove('dark-mode')
        } 
    })
    /* =============== */

    /* ===FIN DE DARKMODE=== */

    const darkModeBoton = document.querySelector('.dark-mode');
    darkModeBoton.addEventListener('click', botonDark )
}

function botonDark(){
document.body.classList.toggle('dark-mode') 
/* Al darle click agrega el darkmode al body */
}

function eventListeners(){
    /* seleccionamos mobile-menu que es el menu de hamburguesa y creamos un selector */
    const mobileMenu = document.querySelector('.mobile-menu'); /* para seleccionar una clase usamos (.) */

    mobileMenu.addEventListener('click', navegacionResponsive) 
    /* le asignamos un eventlistener para que cuando demos click se ejecute cierto codigo de JS...
    al dar click en mobile-menu, se ejecuta y manda a llamar la funcion navegacionResponsive*/
}

function navegacionResponsive(){
/* queremos que se muestre nuestra navegacion, que de momento tiene un display none y que al darle click
cambia a display block... MANIPULAMOS EL CSS CON JS */
const navegacion = document.querySelector('.navegacion');

 navegacion.classList.toggle('mostrar') /*===ESTO ES LO MISMO QUE EL IF ELSE=== */

/* if(navegacion.classList.contains('mostrar')){
    navegacion.classList.remove('mostrar');
}else{
    navegacion.classList.add('mostrar');
} */
}