<aside class="sidebar">

    <?php
    if (have_rows("menus")):
        while (have_rows("menus")): the_row();
    ?>

            <div class="sidebar-menu widget">
                <?php if (get_sub_field('titulo')): ?>
                    <p class="widget__title h5"><?= get_sub_field('titulo') ?></p>
                <?php endif ?>
                <?php the_sub_field('menu') ?>
            </div>

    <?php
        endwhile;
    endif;
    ?>

    <?php
    $sidebox = get_field('caja_de_contenido');
    if ($sidebox['titulo']) {
    ?>
        <div class="widget sidebox">

            <img src="<?= $sidebox['imagen_de_fondo']['url'] ?>" alt="<?= $sidebox['imagen_de_fondo']['alt'] ?>" class="bg-img">

            <div class="sidebox__inner">
                <p class="widget__title h5"><?= $sidebox['titulo'] ?></p>

                <?= $sidebox['contenido'] ?>

                <?php
                $i = 1;
                foreach ($sidebox['botones'] as $boton):
                    $btn_stl = $i % 2 == 0 ? "secondary" : "primary";
                ?>

                    <a href="<?= $boton['boton']['url'] ?>" class="btn txt-center <?= $btn_stl ?>"><?= $boton['boton']['title'] ?></a>

                <?php
                    $i++;
                endforeach;
                ?>
            </div>

        </div>

    <?php } ?>

    <?php dynamic_sidebar("default_sidebar") ?>

</aside>