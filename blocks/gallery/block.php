<?php
if (get_field('mostrar_bloque')):
    foreach (get_fields() as $key => $value) $$key = $value;

    if ($columnas > 6) $columnas = 6;
    if ($columnas < 3) $columnas = 3;
?>

    <section class="block block-gallery <?= $extraer_bloque_del_contenido ? 'extract-block' : '' ?>" style="--columns: <?= $columnas ?>; --gallery-size: <?= count($galeria) ?>;">

        <div class="gallery">
            <?php
            $i = 0;
            foreach ($galeria as $pic) :
            ?>

                <div class="pic" style="--pic-index: <?= $i ?>">

                    <a href="<?= $pic['enlace'] ?>" class="link">

                        <img src="<?= $pic['imagen']['url'] ?>" alt="<?= $pic['imagen']['alt'] ?>">

                        <p class="title"><?= $pic['titulo'] ?></p>

                    </a>

                </div>

            <?php
                $i++;
            endforeach
            ?>
        </div>

    </section>

<?php
endif;
?>