<?php
/**
 * Dashboard Administration Screen
 *
 * @internal This file should be parseable by PHP4.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** Load WordPress Bootstrap */
require_once('./admin.php');

/** Load WordPress dashboard API */
require_once(ABSPATH . 'wp-admin/includes/dashboard.php');

wp_dashboard_setup();

wp_enqueue_script( 'dashboard' );
if ( current_user_can( 'edit_theme_options' ) )
	wp_enqueue_script( 'customize-loader' );
if ( current_user_can( 'install_plugins' ) )
	wp_enqueue_script( 'plugin-install' );
if ( current_user_can( 'upload_files' ) )
	wp_enqueue_script( 'media-upload' );
add_thickbox();

if ( wp_is_mobile() )
	wp_enqueue_script( 'jquery-touch-punch' );

$title = __('Dashboard');
$parent_file = 'index.php';

/*
if ( is_user_admin() )
	add_screen_option('layout_columns', array('max' => 4, 'default' => 1) );
else
	add_screen_option('layout_columns', array('max' => 4, 'default' => 2) );
*/

$help = '<p>' . __( 'Slamat datang di Dashboard! Ini adalah halaman yang akan Anda lihat setelah melakukan log in, dan menyediakan akses ke fitur manajemen situs. Menu bantuan dapat Anda akses dengan mengklik tab "Bantuan" di pojok kanan atas ' ) . '</p>';

// Not using chaining here, so as to be parseable by PHP4.
$screen = get_current_screen();

$screen->add_help_tab( array(
	'id'      => 'overview',
	'title'   => __( 'Ikhtisar' ),
	'content' => $help,
) );

// Help tabs

$help  = '<p>' . __('The left-hand navigation menu provides links to all of the administration screens, with submenu items displayed on hover. You can minimize this menu to a narrow icon strip by clicking on the Collapse Menu arrow at the bottom.') . '</p>';
$help .= '<p>' . __('Links in the Toolbar at the top of the screen connect your dashboard and the front end of your site, and provide access to your profile and helpful information.') . '</p>';

$screen->add_help_tab( array(
	'id'      => 'help-navigation',
	'title'   => __('Navigation'),
	'content' => $help,
) );

unset( $help );


include (ABSPATH . 'wp-admin/admin-header.php');

$today = current_time('mysql', 1);
?>

<div class="wrap">
<?php screen_icon(); ?>
<h2><?php echo esc_html( $title ); ?></h2>

<?php
//    if ( has_action( 'welcome_panel' ) && current_user_can( 'edit_theme_options' ) ) :
//	$classes = 'welcome-panel';
//
//	$option = get_user_meta( get_current_user_id(), 'show_welcome_panel', true );
//	// 0 = hide, 1 = toggled to show or single site creator, 2 = multisite site owner
//
//	$hide = 0 == $option || ( 2 == $option && wp_get_current_user()->user_email != get_option( 'admin_email' ) );
//
//	if ( $hide )
//		$classes .= ' hidden'; ?>

 	<!--<div id="welcome-panel" class="<?php // echo esc_attr( $classes ); ?>">
 		<?php // wp_nonce_field( 'welcome-panel-nonce', 'welcomepanelnonce', false ); ?>
		<a class="welcome-panel-close" href="<?php // echo esc_url( admin_url( '?welcome=0' ) ); ?>"><?php // _e( 'Dismiss' ); ?></a>
		<?php // do_action( 'welcome_panel' ); ?>
	</div> -->
<?php // endif; ?>

<div id="dashboard-widgets-wrap">

<?php wp_dashboard(); ?>

<div class="clear"></div>
</div><!-- dashboard-widgets-wrap -->

</div><!-- wrap -->

<?php require(ABSPATH . 'wp-admin/admin-footer.php'); ?>
