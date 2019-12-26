<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container-fluid no-padding">
	<div class="content row no-gutters">
		<div class="main col-sm-12 col-xs-12" >
			<?php
			$post_type = get_query_var('post_type');

			$app=&aw2_library::get_array_ref('app');
			aw2_library::set('current_post',$post);

			$layout ='single-content-layout';
			$collection='';
			
			while ( have_posts() ) : the_post();
			
				if(!aw2_library::get_post_from_slug('single-content-layout',$app['collection']['config']['post_type'],$module_post)){
					$awesome_core=&aw2_library::get_array_ref('awesome_core');
					
					
					if(isset($awesome_core[$post_type.'-single-content-layout'])){
						$layout = $awesome_core[$post_type.'-single-content-layout']['code'];
							unset($awesome_core[$post_type.'single-content-layout']); // now we don't need this data
						
					} else if(isset($awesome_core['single-content-layout'])){
						$layout = $awesome_core['single-content-layout']['code'];
						
					}
				}
				else
					$layout = $module_post->post_content;
				
				unset($awesome_core['single-content-layout']); // now we don't need this data
				
				if(!empty($layout))		
					echo aw2_library::parse_shortcode($layout);
				else
					echo '<em>single-content-layout</em> is missing.';
				
			endwhile; // end of the loop. ?>
		</div><!-- /.main -->
	</div><!-- /.content -->
</div>
<?php get_footer(); 
