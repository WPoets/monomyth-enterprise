<?php
/**
 Template Name: Page for Custom HTML
 * The template for full HTML.
 */
while ( have_posts() ) : the_post(); awesome2_library::setparam('default_item',$post);
the_content();
endwhile;
