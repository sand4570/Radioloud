<?php 

/**
*The template for displaying front page
*/

//Som også udskrevet ovenfor, sørger vores front-page.php for at hente filen med vores landing page / forside i mappen template-parts. Udover det, henter vores front-page.php også header og footer fra vores valgte parent theme.

get_header();
?>

<section id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php

		get_template_part( 'template-parts/front' );

        ?>


    </main>
</section>

<?php
get_footer();
