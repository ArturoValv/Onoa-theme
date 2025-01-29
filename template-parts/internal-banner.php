<?php
global $post;
foreach (get_fields($post->id) as $key => $value) $$key = $value;
if (!empty($color_de_la_mascara_del_hero)) $overlay = 'rgba(' . $color_de_la_mascara_del_hero['red'] . ',' . $color_de_la_mascara_del_hero['green'] . ',' . $color_de_la_mascara_del_hero['blue'] . ',' . $color_de_la_mascara_del_hero['alpha'] . ')';
$cover_style = !empty($overlay) ? 'data-style="' . $overlay . '"' : '';
$bg = $imagen_de_portada;
?>

<section class="cover-inner <?= get_field('activar_reproduccion_automatica_de_encabezados') ? 'autoplay' : '' ?>">

    <div class="cover-inner__bg <?= $overlay !== '' && $overlay ? ' overlay-applied' : '' ?>" <?= $cover_style ?>>
        <img src="<?= $bg['url'] ?>" alt="<?= $bg['alt'] ?>">
    </div>


    <div class="cover-inner__content">

        <?php if ($mostrar_titulo): ?>
            <h1 class="title"><?= get_the_title() ?></h1>
        <?php endif ?>

    </div>

</section>