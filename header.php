<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <?php wp_head(); ?>
</head>

<body id="top" <?php body_class(); ?>>
    <?php
    wp_body_open();

    switch (get_field("estilo_de_encabezado", "options")) {

        case 'static':
            $header_style = "static";
            break;

        case 'sticky':
            $header_style = "sticky";
            break;

        default:
            $header_style = "static";
            break;
    }

    ?>

    <header class="site-header <?= $header_style ?>">

        <a href="/" id="logo">

            <?php
            $logo = get_field('logotipo',  'options');
            $imago = get_field('imagotipo',  'options');
            if ($logo || $imago):
            ?>
                <img src="<?= $logo['url'] ?>" alt="<?= $logo['alt'] ?>" class="logo">
                <img src="<?= $imago['url'] ?>" alt="<?= $imago['alt'] ?>" class="imago">
            <?php endif ?>

        </a>

        <div class="site-header__container">

            <div id="main-nav-section">

                <?php
                $args = array(
                    'theme_location' => 'main_menu',
                    'container' => 'nav',
                    'container_class' => 'main-menu',
                );
                wp_nav_menu($args);
                ?>

            </div>


        </div>

        <div id="menu-mobile">
            <hr>
            <hr>
            <hr>
        </div>

    </header>

    <!-- TLM End -->

    <?php if (is_page_template("page-templates/template-homepage.php")): ?>

        <?php get_template_part("template-parts/cover") ?>

    <?php elseif (get_field('mostrar_portada')): ?>

        <?php get_template_part("template-parts/internal", "banner") ?>

    <?php else: ?>

    <?php endif ?>