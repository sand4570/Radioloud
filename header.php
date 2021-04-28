<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 *
 * @package HelloElementor
 */

// Som også udskrevet ovenfor, sørger vores header.php for at hente headeren'en fra vores parent theme. Den finder en header.php i mappen template-parts, som er udgangspunktet for vores header. Vi har på vores site stylet både header og footer i WP backend, og der er derfor ikke tilføjet kode hertil.

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php $viewport_content = apply_filters( 'hello_elementor_viewport_content', 'width=device-width, initial-scale=1' ); ?>
    <meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php
hello_elementor_body_open(); ?>

    <?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
	get_template_part( 'template-parts/header' );
}
