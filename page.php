<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="main-content">

    <div class="container">

        <div class="content">
            <div class="formatted-text">

                <?php while (have_posts()) : the_post(); ?>

                    <?php the_content() ?>

                <?php endwhile;
                wp_reset_postdata(); ?>

            </div>

            <?php
            if (get_field('mostrar_barra_lateral')) {
                get_sidebar();
            } ?>
        </div>

    </div>

</main>

<?php get_footer() ?>