<?php
/**
 * マニュアルのサブメニューを追加
 */

 function get_manual_url(){
    return 'https://dl.tcd-theme.com/tcd103/';
 }

function add_menu_submenu_page(){
    add_dashboard_page(__( 'TCD Manual', 'tcd-genesis' ) ,__( 'TCD Manual', 'tcd-genesis' ), 'edit_theme_options', 'theme_manual', 'menu_add_theme_manual');
}
 
function menu_add_theme_manual(){
	?>
	<div class="wrap">
		<h2><?php _e( 'TCD Manual', 'tcd-genesis' ); ?></h2>
		<p><a href="<?php echo get_manual_url(); ?>" class="button-primary" rel="noopener" target="_blank"><?php _e( 'Manual Site', 'tcd-genesis' ); ?></a></p>
		<p><?php printf( __( 'The password for viewing the manual is on <a href=%s rel="noopener" target="_blank">My Page</a>.', 'tcd-genesis' ),'"https://tcd.style/"'); ?></p>
		<h2><?php _e( 'Related Links', 'tcd-genesis' ); ?></h2>
		<ul>
			<li>・<a href="https://tcd-theme.com/introduction" rel="noopener" target="_blank"><?php _e( 'The complete collection of WordPress usage', 'tcd-genesis' ); ?></a></li>
			<li>・<a href="https://tcdmuseum.com/" rel="noopener" target="_blank"><?php _e( 'TCD MUSEUM', 'tcd-genesis' ); ?></a></li>
			<li>・<a href="https://tcd-manual.net/" rel="noopener" target="_blank"><?php _e( 'TCD LABO', 'tcd-genesis' ); ?></a></li>
		</ul>
	</div>
	<?php
}

add_action('admin_menu', 'add_menu_submenu_page');


/**
 * マニュアルのダッシュボード追加
 */

function theme_manual_dashboard_widgets(){
	wp_add_dashboard_widget('theme_manual_widget', __( 'TCD Manual', 'tcd-genesis' ), 'theme_manual_dashboard_manual');
}

function theme_manual_dashboard_manual(){
    // This tells the function to cache the remote call for 21600 seconds (6 hours)
	$xml = get_tcd_update_notifier_xml();

	// Get theme data from style.css (current version is what we want)
	$theme_data = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_theme_data( TEMPLATEPATH . '/style.css' );
    
	?>
	<div class="wrap">
		<p><a href="<?php echo get_manual_url(); ?>" class="button-primary" rel="noopener" target="_blank"><?php _e( 'Manual Site', 'tcd-genesis' ); ?></a></p>
		<p><?php printf( __( 'The password for viewing the manual is on <a href=%s rel="noopener" target="_blank">My Page</a>.', 'tcd-genesis' ),'"https://tcd.style/"'); ?></p>
        <strong><?php _e( 'Related Links', 'tcd-genesis' ); ?></strong>
        <ul>
            <li>・<a href="https://tcd-theme.com/introduction" rel="noopener" target="_blank"><?php _e( 'The complete collection of WordPress usage', 'tcd-genesis' ); ?></a></li>
            <li>・<a href="https://tcdmuseum.com/" rel="noopener" target="_blank"><?php _e( 'TCD MUSEUM', 'tcd-genesis' ); ?></a></li>
            <li>・<a href="https://tcd-manual.net/" rel="noopener" target="_blank"><?php _e( 'TCD LABO', 'tcd-genesis' ); ?></a></li>
        </ul>
        <hr>
        <p>
        <?php if ( version_compare( $theme_data['Version'], $xml->latest ) == -1 ) { ?>
            <strong><?php printf( __( 'The latest version of %s is released.', 'tcd-genesis' ), esc_html( $theme_data['Name'] ) ); ?></strong><br>
            <?php printf( __( 'Current version is %s. You can update to the latest version, %s.', 'tcd-genesis' ), esc_html( $theme_data['Version'] ), esc_html( $xml->latest ) ); ?><br>
            <a href="?page=design-plus-updates"><?php _e( 'Theme Update', 'tcd-genesis' ) ?></a>
        <?php }else{ ?>
            <?php printf( __( 'The current version of %s is %s. This is the latest version.', 'tcd-genesis' ), esc_html( $theme_data['Name'] ),esc_html( $theme_data['Version'] )); ?>
        <?php } ?>
        </p>
	</div>
	<?php
}

if( current_user_can( 'administrator' )){
  add_action('wp_dashboard_setup', 'theme_manual_dashboard_widgets');
}

?>