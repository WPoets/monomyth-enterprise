<?php


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
}
wp_footer(); 
if (current_user_can('develop_for_awesomeui')) {
	echo '<!-- ' . get_num_queries() . ' queries in ' . timer_stop(0,3) . ' seconds -->';
}
?>
</body>
</html>