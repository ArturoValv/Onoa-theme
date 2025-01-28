<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="main-content">

    <div class="container">

        <div class="content">

            <article class="formatted-text">

                <?php
                while (have_posts()) : the_post();
                ?>

                    <?php the_content() ?>

                <?php
                endwhile;

                if (get_field("mostrar_galeria_despues_del_contenido") && have_rows('galeria_de_proyecto')) :
                ?>
                    <div class="gallery-slider swiper">
                        <div class="swiper-navigation">
                            <div class="swiper-button-prev arrow"></div>
                            <div class="swiper-button-next arrow"></div>
                        </div>
                        <div class="photos swiper-wrapper">
                            <?php while (have_rows('galeria_de_proyecto')): the_row(); ?>


                                <div class="swiper-slide photo">
                                    <img src="<?= get_sub_field('foto')['url'] ?>" alt="<?= get_sub_field('foto')['alt'] ?>">
                                </div>

                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php
                endif;
                wp_reset_postdata();
                ?>

            </article>

            <?php
            if (get_field('mostrar_barra_lateral')) {
                get_sidebar();
            } ?>

        </div>

    </div>

</main>

<?php get_footer() ?>