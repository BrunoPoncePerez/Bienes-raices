<?php

require 'includes/funciones.php';
incluirTemplate('header');
?>
    
    <main class="contenedor seccion">
    
        <h1>Conoce sobre Nosotros</h1>
    
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>

                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                    Assumenda consectetur nemo similique sint repudiandae eius quo neque ducimus dignissimos. 
                    Incidunt facere nulla reprehenderit officia. Ipsum eaque temporibus excepturi
                     doloribus porro.

                     Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                     Dicta quia labore hic impedit provident! Nostrum, 
                     neque quo obcaecati eum ut quam dicta tempore laborum 
                     illo maiores unde aut officiis inventore.
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                     Laudantium qui id cupiditate, corrupti sed numquam, 
                     fugiat eum obcaecati aliquam aut officiis magni deserunt 
                     ratione omnis tempore earum optio nobis? Quibusdam.
                </p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
    
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="/build/img/icono1.svg" alt="icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Minima optio delectus numquam blanditiis eaque asperiores,
                    quos cumque veritatis architecto</p>
            </div>
    
            <div class="icono">
                <img src="/build/img/icono2.svg" alt="icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Minima optio delectus numquam blanditiis eaque asperiores,
                    quos cumque veritatis architecto</p>
            </div>
    
            <div class="icono">
                <img src="/build/img/icono3.svg" alt="icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Minima optio delectus numquam blanditiis eaque asperiores,
                    quos cumque veritatis architecto</p>
            </div>
        </div>
    
    </section>
    
    <?php

incluirTemplate('footer');
?>