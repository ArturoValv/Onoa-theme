<?php

/*Setup Theme */
if (!function_exists('onoa_theme_setup')) {

	function onoa_theme_setup()
	{
		//SEO Titles
		add_theme_support('title-tag');

		//Enable featured images
		add_theme_support('post-thumbnails', array('post', 'page'), 11);

		//Add custom sized images
		add_image_size('square', 350, 350, true);
		add_image_size('portrait', 350, 724, true);
		add_image_size('boxes', 400, 375, true);
		add_image_size('blog', 966, 644, true);
		add_image_size('cover', 1400, 600, true);

		//Soporte a Tipografias
		add_theme_support('appearance-tools');

		//Soporte a Tamaños de Fuente
		add_theme_support('editor-font-sizes', array(
			array(
				'name' => esc_attr__(
					'Small',
					'onoa_theme'
				),
				'size' => 12,
				'slug' => 'small'
			),
			array(
				'name' => esc_attr__(
					'Regular',
					'onoa_theme'
				),
				'size' => 16,
				'slug' => 'regular'
			),
			array(
				'name' => esc_attr__(
					'Medium',
					'onoa_theme'
				),
				'size' => 18,
				'slug' => 'medium'
			),
			array(
				'name' => esc_attr__(
					'Large',
					'onoa_theme'
				),
				'size' => 22,
				'slug' => 'large'
			),
			array(
				'name' => esc_attr__(
					'Extra Large',
					'onoa_theme'
				),
				'size' => 28,
				'slug' => 'xl'
			),
			array(
				'name' => esc_attr__(
					'Huge',
					'onoa_theme'
				),
				'size' => 32,
				'slug' => 'xl'
			)
		));


		// Soporte a Colores
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __(
						'Primary Color',
						'onoa_theme'
					),
					'slug'  => 'primary-color',
					'color' => get_theme_mod('primary_color', ''),
				),
				array(
					'name'  => __(
						'Scondary Color',
						'onoa_theme'
					),
					'slug'  => 'secondary-color',
					'color' => get_theme_mod('secondary_color', ''),
				),
				array(
					'name'  => __(
						'Tertiary Color',
						'onoa_theme'
					),
					'slug'  => 'tertiary-color',
					'color' => get_theme_mod('tertiary_color', ''),
				),
				array(
					'name'  => __(
						'Light Grey Color',
						'onoa_theme'
					),
					'slug'  => 'tertiary-color',
					'color' => get_theme_mod('light_grey', ''),
				),
				array(
					'name'  => __(
						'Text Color',
						'onoa_theme '
					),
					'slug'  => 'text-color',
					'color' => get_theme_mod('text_color', ''),
				),
			)
		);

		register_nav_menus(
			array(
				'main_menu' => esc_html__('Main menu', 'onoa_theme'),
				'first_footer_menu' => esc_html__('Footer menu 1', 'onoa_theme'),
				'second_footer_menu' => esc_html__('Footer menu 2', 'onoa_theme'),
			)
		);
	}
}

add_action('after_setup_theme', 'onoa_theme_setup');

/**
 * Enqueue scripts and styles.
 *
 *
 * @return void
 */
function onoa_theme_scripts()
{
	// Load jQuery on the footer to eliminate render-blocking resources.
	wp_scripts()->add_data('jquery', 'group', 1);
	wp_scripts()->add_data('jquery-core', 'group', 1);
	wp_scripts()->add_data('jquery-migrate', 'group', 1);

	// Global stylesheet.
	wp_enqueue_style('onoa-theme-fonts', get_template_directory_uri() . "/assets/fonts/fonts.css", array(), '1.0');
	wp_enqueue_style('onoa-theme-main-stylesheet', get_template_directory_uri() . "/build/css/main-style.css", array('onoa-theme-fonts'), '1.0', 'all');

	// Main JS scripts.
	wp_enqueue_script('onoa-theme-main-scripts', get_template_directory_uri() . '/build/js/scripts.js', array(), '1.0', true);

	// Load specific template stylesheet
	if (is_page()) {
		if (!is_front_page() || !is_page_template("page-templates/template-homepage.php")) {
			wp_enqueue_style('onoa-theme-template-default', get_template_directory_uri() . '/build/css/templates/template-default.css', array(), '1.0');
		}

		switch (get_page_template_slug()) {
			case "page-templates/template-homepage.php":
				wp_enqueue_script('onoa-theme-template-home-js', get_template_directory_uri() . '/build/js/home-scripts.js', array(), '1.0', true);
				break;
			case "page-templates/template-portfolio.php":
				wp_enqueue_style('onoa-theme-template-portfolio-css', get_template_directory_uri() . '/build/css/templates/template-portfolio.css', array(), '1.0', 'all');
				wp_enqueue_script('onoa-theme-template-portfolio-js', get_template_directory_uri() . '/build/js/portfolio-scripts.js', array('onoa-theme-main-scripts'), '1.0', true);
				break;
		}
	}

	if (is_home() || is_archive() || is_single()) {
		wp_enqueue_style('onoa-theme-home', get_template_directory_uri() . "/build/css/templates/home.css", array(), '1.0');
		wp_enqueue_style('onoa-theme-template-default', get_template_directory_uri() . '/build/css/templates/template-default.css', array(), '1.0');
	}
}
add_action('wp_enqueue_scripts', 'onoa_theme_scripts');

/*Tamaño de excerpt modificado*/
function onoa_theme_custom_excerpt_length($length)
{
	return 25;
}
add_filter('excerpt_length', 'onoa_theme_custom_excerpt_length', 999);

// Custom Block Categories
function onoa_blocks_category($categories, $post)
{
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'onoa-blocks',
				'title' => __('Onoa Blocks', 'onoa-blocks'),
			)
		)
	);
}
add_filter('block_categories', 'onoa_blocks_category', 10, 2);

// Register Block Types
function onoa_theme_register_acf_block_types()
{
	acf_register_block_type(array(
		'name'              => 'Bloque – Tres Columnas',
		'title'             => __('Bloque – Tres Columnas'),
		'render_template'   => '/blocks/three-cols/block.php',
		'category'          => 'onoa-blocks',
		'icon'              => 'welcome-write-blog',
		'mode'				=> 'edit',
		'enqueue_assets' => function () {
			wp_enqueue_style('block-three-cols-css', get_template_directory_uri() . '/blocks/three-cols/block.css', array(), '1.0');
			//wp_enqueue_script('block-three-cols-js', get_template_directory_uri() . '/blocks/three-cols/block.js', array(), '1.0', true);
		},
	));
	acf_register_block_type(array(
		'name'              => 'Bloque – Equipo',
		'title'             => __('Bloque – Equipo'),
		'render_template'   => '/blocks/team/block.php',
		'category'          => 'onoa-blocks',
		'icon'              => 'welcome-write-blog',
		'mode'				=> 'edit',
		'enqueue_assets' => function () {
			wp_enqueue_style('block-team-css', get_template_directory_uri() . '/blocks/team/block.css', array(), '1.0');
		},
	));
	acf_register_block_type(array(
		'name'              => 'Bloque – Contacto',
		'title'             => __('Bloque – Contacto'),
		'render_template'   => '/blocks/contact/block.php',
		'category'          => 'onoa-blocks',
		'icon'              => 'welcome-write-blog',
		'mode'				=> 'edit',
		'enqueue_assets' => function () {
			wp_enqueue_style('block-contact-css', get_template_directory_uri() . '/blocks/contact/block.css', array(), '1.0');
			//wp_enqueue_script('block-contact-js', get_template_directory_uri() . '/blocks/contact/block.js', array(), '1.0', true);
		},
	));
}

if (function_exists('acf_register_block_type')) {
	add_action('acf/init', 'onoa_theme_register_acf_block_types');
}

/* Add ACF Options Page
-------------------------------------------------------------- */
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Template Options',
		'menu_title' => 'Template Options',
		'menu_slug'  => 'template_options',
		'capability' => 'edit_posts',
		'redirect' => false
	));
}

//Color Scheme
require_once get_template_directory() . '/theme-functions/color-scheme.php';

//SVG Functions
require_once get_template_directory() . '/theme-functions/svg-functions.php';

//ACF JSON
function acf_theme_files($path)
{
	return get_stylesheet_directory() . '/acf-json-files';
}
add_filter('acf/settings/save_json', 'acf_theme_files');
