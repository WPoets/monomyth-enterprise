<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container-fluid no-padding">
<div class="content row no-gutters">
	<main class="main  col-lg-12 col-md-12 col-sm-12 col-xs-12" role="main">
	<?php 	
		
		$awesome_core=&aw2_library::get_array_ref('awesome_core');
	
		$content_layout ='';
		
		if(isset($awesome_core['blog-content-layout'])){
			$content_layout = $awesome_core['blog-content-layout']['code'];
			unset($awesome_core['blog-content-layout']); // now we don't need this data
		}
		else if(isset($awesome_core['archive-content-layout'])){
			$content_layout = $awesome_core['archive-content-layout']['code'];
			unset($awesome_core['archive-content-layout']); // now we don't need this data
		}
		
		
		
		if(!empty($content_layout))		
			echo aw2_library::parse_shortcode($content_layout);
		else
			echo '<em>blog-content-layout/archive-content-layout</em> is missing in core.';
		
	?>
	</main><!-- /.main -->
</div><!-- /.content -->
</div><!--#container -->
<?php get_footer(); 