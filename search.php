<?php
/**
 * The template for displaying search results page.
 */

get_header(); ?>
<div class="container-fluid no-padding">
	<div class="content row no-gutters">
		<main class="main col-sm-12 col-xs-12 " role="main">
		<?php
			aw2_library::set('search_term',get_search_query());
			$module_post=null;
			if(!aw2_library::get_post_from_slug( 'search','aw2_page',$module_post)){
				aw2_library::get_post_from_slug( 'search','aw2_core',$module_post);
			}
			
			echo aw2_library::parse_shortcode($module_post->post_content);
	
		?>
			
		</main><!-- /.main -->
	</div><!-- /.content -->
</div>

<?php get_footer(); ?>