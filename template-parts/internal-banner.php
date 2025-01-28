<?php
$post;
$id = $post->id;
$terms = get_the_terms(get_the_ID(), 'categoria-proyectos');
?>
<section class="internal-banner">
    <div class="container">
        <div class="internal-banner__inner">

            <?php if (is_page() || is_single()): ?>
                <h1 class="page-title"><?= get_the_title($id) ?></h1>
            <?php elseif (is_post_type_archive()): ?>
                <h1 class="page-title"><?= post_type_archive_title('', false) ?></h1>
            <?php elseif (is_tax()): ?>
                <h1 class="page-title"><?= single_term_title('', false) ?></h1>
            <?php endif ?>

            <?php if (!empty($terms) && $terms && is_singular("proyectos")): ?>

                <ul class="project-cats">

                    <?php foreach ($terms as $term) : ?>

                        <li class="cat"><a href="<?= get_term_link($term->term_id) ?>"><?= $term->name ?></a></li>

                    <?php endforeach; ?>

                </ul>

            <?php endif; ?>
        </div>
    </div>
</section>