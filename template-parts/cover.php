<?php
foreach (get_fields() as $key => $value) $$key = $value;
$bg = $cover_video ? $video_de_fondo : $imagen_de_fondo;
$overlay = 'rgba(' . $color_de_la_mascara_del_hero['red'] . ',' . $color_de_la_mascara_del_hero['green'] . ',' . $color_de_la_mascara_del_hero['blue'] . ',' . $color_de_la_mascara_del_hero['alpha'] . ')';
$cover_style = 'data-style="' . $overlay . '"';
?>

<section class="cover <?= get_field('activar_reproduccion_automatica_de_encabezados') ? 'autoplay' : '' ?>">
    <div class="cover__wrapper">

        <div class="cover__bg <?= $overlay !== '' && $overlay ? ' overlay-applied' : '' ?>" <?= $cover_style ?>>
            <?php if ($cover_video): ?>
                <video width="100%" height="100%" autoplay loop preload muted>
                    <source src="<?= $bg['url'] ?>" type="video/mp4">
                </video>
            <?php else : ?>
                <img src="<?= $bg['url'] ?>" alt="<?= $bg['alt'] ?>">
            <?php endif ?>
        </div>

        <div class="cover__inner">

            <?php
            $words = [];
            foreach ($encabezados_intercambiables as $i) {
                array_push($words, "'" . $i['encabezado'] . "'");
            }
            ?>

            <script>
                const wordsCover = [<?= implode(',', $words) ?>];
            </script>

            <<?= $etiqueta_del_encabezado ?> class="title"><?= $encabezados_intercambiables[0]['encabezado'] ?></<?= $etiqueta_del_encabezado ?>>

        </div>
    </div>
</section>