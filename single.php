<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="main-content">

    <div class="container">

        <div class="content">

            <?php
            while (have_posts()) : the_post();
            ?>
                <?php if (!get_field('mostrar_portada')): ?>
                    <h1> <?= get_the_title() ?> </h1>
                <?php endif ?>
                <article class="formatted-text">


                    <?php the_content() ?>


                </article>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>

            <?php
            if (get_field('mostrar_barra_lateral')) {
                get_sidebar();
            } ?>

        </div>

    </div>

</main>

<?php get_footer() ?>