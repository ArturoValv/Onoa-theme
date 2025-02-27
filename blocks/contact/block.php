<?php
if (get_field('mostrar_bloque')):
    foreach (get_fields() as $key => $value) $$key = $value;
?>

    <section class="block block-contact <?= $extraer_bloque_del_contenido ? 'extract-block' : '' ?> ">

        <div class="block__inner">

            <div class="cols">

                <div class="col">

                    <<?= $etiqueta_del_titulo ?> class="block-title"><?= $titulo ?></<?= $etiqueta_del_titulo ?>>

                    <?php if (isset($correo_electronico) && $correo_electronico !== null): ?>
                        <a href="mailto:<?= $correo_electronico ?>" class="contact"><?= $correo_electronico ?></a>
                    <?php endif ?>

                    <?php if (isset($telefono) && $telefono !== null): ?>
                        <a href="tel:+52<?= preg_replace('/^0|[^a-zA-Z0-9+]+/', '', $telefono) ?>" class="contact"><?= $telefono ?></a>
                    <?php endif ?>

                </div>

                <div class="col">

                    <div class="form">
                        <?= do_shortcode($shortcode_de_formulario) ?>
                    </div>

                </div>

            </div>

        </div>

    </section>

<?php
endif;
?>