<?php
if (get_field('mostrar_bloque')):
    foreach (get_fields() as $key => $value) $$key = $value;
?>

    <section class="block block-three-cols <?= $extraer_bloque_del_contenido ? 'extract-block' : '' ?> ">

        <div class="block__inner">

            <div class="cols <?= $orden_de_columnas ?>">

                <div class="col">

                    <<?= $etiqueta_del_titulo ?> class="block-title"><?= $titulo ?></<?= $etiqueta_del_titulo ?>>

                </div>
                <div class="col">

                    <picture class="image">

                        <img src="<?= $imagen['url'] ?>" alt="<?= $imagen['alt'] ?>">

                    </picture>

                </div>
                <div class="col">

                    <div class="content">
                        <p class="heading"><?= $encabezado_contenido ?></p>
                        <?= $contenido ?>
                    </div>

                </div>

                <div class="col">
                    <p class="heading"><?= $encabezado_de_lista ?></p>
                    <ul class="list">
                        <?php foreach ($lista as $item): ?>

                            <li class="item">
                                <?= $item['elemento'] ?>
                            </li>

                        <?php endforeach ?>
                    </ul>
                </div>

            </div>

        </div>

    </section>

<?php
endif;
?>