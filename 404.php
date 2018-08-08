<?php
/**
 * The template for displaying 404 page.
 */

get_header(); ?>
<div class="container-fluid no-padding">
	<div class="content row no-gutters">
		<main class="main col-sm-12 col-xs-12 " role="main">
			
			<?php
			echo aw2_library::module_run(['service'=>'core'],'404-layout');
	
			?>
			
		</main><!-- /.main -->
	</div><!-- /.content -->
</div>

<?php get_footer(); ?>