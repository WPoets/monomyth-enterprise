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
			
			$content_layout ='archive-content-layout';
			$collection='';
			
			if(aw2_library::get_module(['service'=>'core'],$content_layout,true)){
				$collection=['service'=>'core'];
			}
			
			if(aw2_library::get_module($app['collection']['config'],$content_layout,true)){

				$collection=$app['collection']['config'];
			}
			
			if(is_post_type_archive( ))
			{
				$post_type = get_query_var('post_type');
				aw2_library::set('current_archive_name',$post_type);

				if(aw2_library::get_module(['service'=>'core'],$post_type . '-archive-content-layout',true)){
					$content_layout = $post_type . '-archive-content-layout';
					$collection=['service'=>'core'];
				}
			}
			else if(is_tax())
			{
				$tax = $wp_query->get_queried_object();
				aw2_library::set('default_taxonomy',$tax->taxonomy);
				aw2_library::set('default_term_slug',$tax->slug);
				aw2_library::set('current_archive_name',$tax->name);
				aw2_library::set('default_term_id',$tax->term_id);

								
				if(aw2_library::get_module(['service'=>'core'],$tax->taxonomy . '-archive-content-layout',true)){
					$content_layout = $tax->taxonomy . '-archive-content-layout';
					$collection=['service'=>'core'];
				}
			}
			else if(is_category()){
				$cat = get_category( get_query_var( 'cat' ) );
				aw2_library::set('default_taxonomy','category');
				aw2_library::set('default_term_slug',$cat->slug);
				aw2_library::set('current_archive_name',$cat->name);
				aw2_library::set('default_term_id',$cat->term_id);
								
				if(aw2_library::get_module(['service'=>'core'],$cat->slug  . '-archive-content-layout',true)){
					$content_layout = $cat->slug  . '-archive-content-layout';
					$collection=['service'=>'core'];
				}
			}
			else if( is_tag()){
				
				$tax = $wp_query->get_queried_object();
				aw2_library::set('default_taxonomy',$tax->taxonomy);
				aw2_library::set('default_term_slug',$tax->slug);
				aw2_library::set('current_archive_name',$tax->name);
				aw2_library::set('default_term_id',$tax->term_id);
				
												
				if(aw2_library::get_module(['service'=>'core'],$tax->taxonomy . '-archive-content-layout',true)){
					$content_layout = $tax->taxonomy . '-archive-content-layout';
					$collection=['service'=>'core'];
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
				
	
				if(isset($awesome_core['author-archive-content-layout'])){
					$content_layout = $awesome_core['author-archive-content-layout']['code'];
					unset($awesome_core['author-archive-content-layout']); // now we don't need this data
				}
				
				if(aw2_library::get_module(['service'=>'core'],'author-archive-content-layout',true)){
					$content_layout = 'author-archive-content-layout';
					$collection=['service'=>'core'];
				}
				
			}
			
			if(!empty($collection))		
				echo aw2_library::module_run($collection,$content_layout);
			else
				echo '<em>'.$content_layout.'</em> is missing.';
				
				
			?>
		</main><!-- /.main -->
	</div><!-- /.content -->
</div>
<?php get_footer(); 


