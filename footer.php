<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */


// Som også udskrevet ovenfor, sørger vores footer.php for at hente footer'en fra vores parent theme. Den finder en footer.php i mappen template-parts, som er udgangspunktet for vores footer. Vi har på vores site stylet både header og footer i WP backend, og der er derfor ikke tilføjet kode hertil.

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	get_template_part( 'template-parts/footer' );
}
?>

<?php wp_footer(); ?>


</body>

</html>
