<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container-fluid no-padding">
	<div class="content row no-gutters">
		<div class="main col-sm-12 col-xs-12" >
			<?php
			
			$app=&aw2_library::get_array_ref('app');
			aw2_library::set('current_post',$post);

			$layout ='single-content-layout';
			$collection='';
			
			while ( have_posts() ) : the_post();
				if(aw2_library::get_module($app['collection']['config'],$layout,true)){
					$collection=$app['collection']['config'];
				}
				else if(aw2_library::get_module(['service'=>'core'],$layout,true)){

					$collection=['service'=>'core'];
				}
				
				if(!empty($collection))		
					echo aw2_library::module_run($collection,$layout);
				else
					echo '<em>'.$layout.'</em> is missing.';
				
			endwhile; // end of the loop. ?>
		</div><!-- /.main -->
	</div><!-- /.content -->
</div>
<?php get_footer(); 
