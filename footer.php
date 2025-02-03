<?php if (get_field('mostrar_pie_de_pagina')): ?>
    <footer id="<?= get_field("ancla_del_footer", "options") ? get_field("ancla_del_footer", "options") : 'site-footer' ?>" class="site-footer">


        <div class="site-footer__inner">

            <div class="cols">

                <div class="col">

                    <div class="inner">

                        <<?= get_field('etiqueta_del_titulo', 'options') ?> class="title"> <?= get_field('titulo_del_footer', 'options') ?> </<?= get_field('etiqueta_del_titulo', 'options') ?>>

                    </div>

                </div>

                <div class="col">

                    <div class="locations">
                        <?php foreach (get_field('oficinas', 'options') as $location):  ?>

                            <div class="location">
                                <p class="name"><?= $location['oficina'] ?></p>
                                <p class="info"><?= $location['direccion'] ?></p>
                                <a href="tel:+52<?= preg_replace('/^0|[^a-zA-Z0-9+]+/', '', $location['telefono']) ?>" class="info">
                                    <?= $location['telefono'] ?>
                                </a>
                                <a href="mailto:<?= $location['correo_electronico'] ?>" class="info">
                                    <?= $location['correo_electronico'] ?>
                                </a>
                            </div>

                        <?php endforeach ?>
                    </div>

                    <div class="menus">

                        <?php
                        $theme_locations = array_key_exists('footer_menu', get_nav_menu_locations()) ? get_nav_menu_locations()['footer_menu'] : '';
                        $menu_obj = get_term($theme_locations, 'nav_menu');
                        if ($theme_locations !== '') :
                        ?>
                            <div class="menu-container">
                                <p class="name"><?= $menu_obj->name ?></p>
                                <?php
                                $args = array(
                                    'theme_location' => 'footer_menu',
                                    'container' => 'nav',
                                    'container_class' => 'footer_menu',
                                );
                                wp_nav_menu($args);
                                ?>
                            </div>
                        <?php endif ?>

                    </div>

                    <?= get_template_part("template-parts/social", "networks") ?>
                </div>

            </div>

        </div>


        <div class="site-footer__copy">
            <p>&copy; <?= date("Y") ?>. Todos los Derechos Reservados por <?= bloginfo("name") ?></p>
        </div>

    </footer>
<?php endif ?>

<?php wp_footer(); ?>
</body>

</html>