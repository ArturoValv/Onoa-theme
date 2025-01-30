<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="main-content">

    <div class="container">

        <?php while (have_posts()) : the_post(); ?>
            <div class="content">
                <?php if (!get_field('mostrar_portada')): ?>
                    <h1> <?= get_the_title() ?> </h1>
                <?php endif ?>
                <div class="formatted-text">
                    <?php the_content() ?>
                </div>

                <?php
                if (get_field('mostrar_barra_lateral')) {
                    get_sidebar();
                } ?>
            </div>
        <?php endwhile;
        wp_reset_postdata(); ?>

    </div>

</main>

<?php get_footer() ?>