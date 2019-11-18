<?php
/**
 * The template for displaying 404 page.
 */

get_header(); ?>
<div class="container-fluid no-padding">
	<div class="content row no-gutters">
		<main class="main col-sm-12 col-xs-12 " role="main">
			
			<?php
			aw2_library::d();
			//echo aw2_library::module_run(['service'=>'core'],'404-layout');
			$app=&aw2_library::get_array_ref('app');
			$awesome_core=&aw2_library::get_array_ref('awesome_core');
			if(isset($awesome_core['404-layout'])){
				$layout = $awesome_core['404-layout']['code'];
				unset($awesome_core['404-layout']); // now we don't need this data
			} 
			if(!empty($layout))		
				echo aw2_library::parse_shortcode($layout);
			else
				echo '<em>404-layout</em> is missing.';
	
			?>
			
		</main><!-- /.main -->
	</div><!-- /.content -->
</div>

<?php get_footer(); ?>