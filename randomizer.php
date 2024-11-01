<?php
/*
Plugin Name: Randomizer
Plugin URI: http://trialsoftwarez.com/randomizer-wordpress-plugin/
Description: A plugin to automatically pull in 10 random post links from database and display in footer. 
Version: 1.0
Author: T-roy
Author URI: http://trialsoftwarez.com
*/
?>
<?php

add_action('wp_footer', 'randomizer');
add_action('wp_footer', 'randomizerCssPath');

function randomizer(){

global $wpdb;

 echo '<div class="randomizer" >';

 $post_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts;");

 $show_this_many = 15;

  for($i=0;$i<$show_this_many;$i++){

    $search = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE `post_status` = 'publish' AND `ID` = '".mt_rand(101,$post_count)."'", ARRAY_A);

    foreach($search as $id => $results){

     echo "<a href='http://trialsoftwarez.com/".$results['post_name']."/'>".$results['post_title']."</a>"."&nbsp;&nbsp;|&nbsp;&nbsp;";

     //echo '<div=randomp p><a href="'.$results['guid'].'" ><img src="'.$results['icon'].'" width="50" height="50" alt="'.$results['post_title'].'"</a>'.'&nbsp;&nbsp;</div>';

    }

  }

 echo '</div>';

}
//////////////////////////////////////////////////////////////
function randomizerCssPath(){

    $randomCssPath_path =  get_settings('siteurl')."/wp-content/plugins/randomizer/";
	$randomCssPath = "<link rel=\"stylesheet\" href=\"".$randomCssPath_path."randomizer.css\" type=\"text/css\" media=\"screen\" />\n"; 

	echo($randomCssPath);
}
/////////////////////////////////////////////////////////////
?>