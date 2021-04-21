<?php 

/**
*The template for displaying front page
*/

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
