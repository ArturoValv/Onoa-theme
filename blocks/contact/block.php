<?php
if (get_field('mostrar_bloque')):
    foreach (get_fields() as $key => $value) $$key = $value;
?>

    <section class="block block-contact">

        <div class="block__inner">

            <div class="cols">

                <div class="col">

                    <<?= $etiqueta_del_titulo ?> class="block-title"><?= $titulo ?></<?= $etiqueta_del_titulo ?>>

                </div>

                <div class="col">

                    <div class="form">
                        <?= do_shortcode(get_field('shortcode_de_formulario')) ?>
                    </div>

                </div>

            </div>

        </div>

    </section>

<?php
endif;
?>