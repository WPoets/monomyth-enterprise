<?php
/* 

$app=&aw2_library::get_array_ref('app');

if(isset($app['collection']['config']) && aw2_library::get_module($app['collection']['config'],'footer',true)){
	echo aw2_library::module_run($app['collection']['config'],'footer');
}	
else if(aw2_library::get_module(['service'=>'core'],'footer',true)){
	echo aw2_library::module_run(['service'=>'core'],'footer');
}

wp_footer(); 
if (current_user_can('develop_for_awesomeui')) {
	echo '<!-- ' . get_num_queries() . ' queries in ' . timer_stop(0,3) . ' seconds -->';
} */



$awesome_core=&aw2_library::get_array_ref('awesome_core');

$app=&aw2_library::get_array_ref('app');
if(isset($app['app_configs']['footer'])){
	$header = $app['app_configs']['footer'];
	echo aw2_library::parse_shortcode($header['code']);
}
else if(isset($awesome_core['footer'])){
	echo aw2_library::parse_shortcode($awesome_core['footer']['code']);
	if(isset($slug)){
		unset($awesome_core[$slug]); // now we don't need this data
	}
}


wp_footer(); 
if (current_user_can('develop_for_awesomeui')) {
	echo '<!-- ' . get_num_queries() . ' queries in ' . timer_stop(0,3) . ' seconds -->';
}
?>
</body>
</html>