<?php
/*
Plugin Name: New User Dashboard Widget
Plugin URI: http://swadeshswain.com/
Description: Add a dashboard widget to Display Recent Registerd user
Version: 2.0
Author: swadeshswain
Author URI: http://odrasoft.com/
License: GPLv2 or later
*/
add_action('wp_dashboard_setup', 'od_dashboard_widgets');
function od_dashboard_widgets() {
global $wp_meta_boxes;
wp_add_dashboard_widget('od_user_widget', 'New User', 'od_dashboard_user');
}
function od_dashboard_user() {
global $wpdb;
$usernames = $wpdb->get_results("SELECT * FROM $wpdb->users ORDER BY ID DESC LIMIT 6");
?>
<table style="width: 100%">
<th><b>Registerd Date</b></th>
<th><b>User Name</b></th>
<th><b>User Email</b></th>
<th><b>User Role</b></th>
<?php 
foreach ($usernames as $username) {
$userid = $username->ID ;
?>
<tr>
<td align="center">
<?php  $reg_date =  $username->user_registered ;  echo date('M jS Y , h:i:s', strtotime($reg_date));?>
</td>
<td align="center">
<a href="<?php echo get_edit_user_link($userid); ?>"><?php echo $username->user_nicename ; ?></a>
</td>
<td align="center">
<a href="<?php echo get_edit_user_link($userid); ?>"><?php echo $username->user_email ; ?></a>
</td>
<td align="center">
<?php $user_info = get_userdata($userid);  echo  implode(', ', $user_info->roles)?>
</td>
</tr>
<?php }
?>
</table>
<?php 
}?>