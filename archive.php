<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<div class="blog__wrapper">

    <div class="container">

        <main class="articles">
            <div class="articles__loop">

                <?php while (have_posts()) : the_post() ?>
                    <article class="article">
                        <div class="article__wrapper  formatted-text">
                            <h3 class="article__title">
                                <a href="<?= get_the_permalink() ?>" class="h2">
                                    <?= get_the_title() ?>
                                </a>
                            </h3>
                            <p class="article__date"><?= get_the_date('j M, Y') ?></p>
                            <p class="article__excerpt"><?= get_the_excerpt() ?></p>
                        </div>
                    </article>
                <?php endwhile ?>

                <div class="post-pagination">
                    <?php
                    get_previous_posts_link();
                    the_posts_pagination();
                    get_next_posts_link();
                    ?>
                </div>


            </div>
        </main>

    </div>

</div>

<?php get_footer() ?>