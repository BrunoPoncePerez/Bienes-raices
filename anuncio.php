<?php

require 'includes/funciones.php';
incluirTemplate('header');
?>


    <main class="contenedor seccion contenido-centrado">
    
        <h1>Casa en venta frente al bosque</h1>
        <picture>
    
            <source srcset="build/img/destacada.webp" alt="image/webp">
            <source srcset="build/img/destacada.jpg" alt="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imagen de la propiedad">
        
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">s/500 000</p>
            
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="ico iconoOpcion" loading="lazy" src="/build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="ico iconoOpcion" loading="lazy" src="/build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="ico iconoOpcion" loading="lazy" src="/build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p>4</p>
                </li>
            </ul>

            <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                Repudiandae porro at natus placeat debitis facilis similique optio sapiente nulla }
                atque, ea earum aliquam harum praesentium magnam nemo. Voluptas, mollitia possimus. 
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima libero,
                 explicabo rerum laborum voluptatibus laudantium labore consequatur eius perspiciatis, 
                 odit nisi modi voluptatem repellat? Doloribus excepturi illo maiores fugit at.

                 Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam dolore sapiente, 
                 fuga voluptates et consequatur corporis at ex voluptatibus qui sunt ipsa amet. 
                 Harum tempora obcaecati ipsum cum a voluptatem?
                 Est voluptatibus ea dolorum debitis, 
                 libero autem eos magni ut repudiandae eius consectetur quaerat perferendis 
                 voluptates dolore obcaecati fugit? Debitis repudiandae repellat molestias vitae
                 cupiditate ducimus consectetur et earum laudantium!
            </p>

        </div>
    
    </main>
    
    <?php

incluirTemplate('footer');
?>