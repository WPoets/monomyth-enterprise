<?php
/**
   Template Name: Default Template For Content
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container-fluid no-padding">
<div class="content row no-gutters">
	<main class="main  col-lg-12 col-md-12 col-sm-12 col-xs-12" role="main">
		<?php
		

		$awesome_core=&aw2_library::get_array_ref('awesome_core');
		
		if(isset($awesome_core['default-page-layout'])){
			$layout = $awesome_core['default-page-layout']['code'];
			unset($awesome_core['default-page-layout']); // now we don't need this data
		}

		if(!empty($layout))		
			echo aw2_library::parse_shortcode($layout);
		else
			echo '<em>default-page-layout</em> is missing.';
		
		?>
	</main><!-- /.main -->
</div><!-- /.content -->
</div><!--#container -->
<?php get_footer(); 