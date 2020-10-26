<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container-fluid no-padding">
	<div class="content row no-gutters">
		<main class="main col-md-12 col-xs-12" role="main">
			<?php 
				
			$app=&aw2_library::get_array_ref('app');
			$awesome_core=&aw2_library::get_array_ref('awesome_core');
			
			$content_layout ='';
						
			if(isset($awesome_core['archive-content-layout'])){
				$content_layout = $awesome_core['archive-content-layout']['code'];
				unset($awesome_core['archive-content-layout']); // now we don't need this data
			}
			
			if(aw2_library::get_post_from_slug('archive-content-layout',$app['collection']['config']['post_type'],$module_post)){

				$content_layout =$module_post->post_content;
			}
			else if(is_post_type_archive( ))
			{
				$post_type = get_query_var('post_type');
				aw2_library::set('current_archive_name',$post_type);

				if(isset($awesome_core[$post_type . '-archive-content-layout'])){
					$content_layout = $awesome_core[$post_type . '-archive-content-layout']['code'];
					unset($awesome_core[$post_type . '-archive-content-layout']); // now we don't need this data
				}
			}
			else if(is_tax())
			{
				$tax = $wp_query->get_queried_object();
				aw2_library::set('default_taxonomy',$tax->taxonomy);
				aw2_library::set('default_term_slug',$tax->slug);
				aw2_library::set('current_archive_name',$tax->name);
				aw2_library::set('default_term_id',$tax->term_id);

				if(isset($awesome_core[$tax->taxonomy  . '-archive-content-layout'])){
					$content_layout = $awesome_core[$tax->taxonomy  . '-archive-content-layout']['code'];
					unset($awesome_core[$tax->taxonomy  . '-archive-content-layout']); // now we don't need this data
				}
			}
			else if(is_category()){
				$cat = get_category( get_query_var( 'cat' ) );
				aw2_library::set('default_taxonomy','category');
				aw2_library::set('default_term_slug',$cat->slug);
				aw2_library::set('current_archive_name',$cat->name);
				aw2_library::set('default_term_id',$cat->term_id);
		
				if(isset($awesome_core[$cat->slug  . '-archive-content-layout'])){
					$content_layout = $awesome_core[$cat->slug  . '-archive-content-layout']['code'];
					unset($awesome_core[$cat->slug  . '-archive-content-layout']); // now we don't need this data
				}
			}
			else if( is_tag()){
				
				$tax = $wp_query->get_queried_object();
				aw2_library::set('default_taxonomy',$tax->taxonomy);
				aw2_library::set('default_term_slug',$tax->slug);
				aw2_library::set('current_archive_name',$tax->name);
				aw2_library::set('default_term_id',$tax->term_id);
				
				if(isset($awesome_core[$tax->taxonomy  . '-archive-content-layout'])){
					$content_layout = $awesome_core[$tax->taxonomy  . '-archive-content-layout']['code'];
					unset($awesome_core[$tax->taxonomy  . '-archive-content-layout']); // now we don't need this data
				}
			}
			else if( is_author()){
			
				if(get_query_var('author_name')) :
					$curauth = get_user_by('slug', get_query_var('author_name'));
				else :
					$curauth = get_userdata(get_query_var('author'));
				endif;

				aw2_library::set('current_author_id',$curauth->ID);
				aw2_library::set('current_author_slug',$curauth->user_login);
				aw2_library::set('current_author_name',$curauth->display_name);
				aw2_library::set('current_author',$curauth);

				//removed the support for aw2_page				
				if(isset($awesome_core['author-archive-content-layout'])){
					$content_layout = $awesome_core['author-archive-content-layout']['code'];
					unset($awesome_core['author-archive-content-layout']); // now we don't need this data
				}
			}

			if(!empty($content_layout)){
				echo aw2_library::parse_shortcode($content_layout);
			}
			else
				echo '<em> archive-content-layout </em> is missing.';
				
				
			?>
		</main><!-- /.main -->
	</div><!-- /.content -->
</div>
<?php get_footer(); 


