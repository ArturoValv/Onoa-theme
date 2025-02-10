<?php
if (get_field('mostrar_bloque')):
    foreach (get_fields() as $key => $value) $$key = $value;
?>

    <section class="block block-centered-content <?= $extraer_bloque_del_contenido ? 'extract-block' : '' ?> ">

        <div class="block__inner">

            <div class="content">

                <<?= $etiqueta_del_titulo ?> class="block-title txt-center"><?= $titulo ?></<?= $etiqueta_del_titulo ?>>

                <nav class="block-menu">

                    <ul>

                        <?php foreach ($menu_del_bloque as $item): $link = $item['enlace'] ?>

                            <li class="item"><a href="<?= $link['url'] ?>" class="txt-center"><?= $link['title'] ?></a></li>

                        <?php endforeach ?>

                    </ul>

                </nav>

                <div class="txt-center formatted-text">
                    <?= $contenido ?>
                </div>

            </div>


        </div>

    </section>

<?php
endif;
?>