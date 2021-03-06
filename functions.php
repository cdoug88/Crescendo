<?php

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
       global $post;
	return ' <a class="moretag" href="'. get_permalink($post->ID) . '">Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


//include plugins to install	
	
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {
	$plugins = array(
// This is an example of how to include a plugin from a GitHub repository in your theme.
		// This presumes that the plugin code is based in the root of the GitHub repository
		// and not in a subdirectory ('/src') of the repository.
		array(
			'name'               => 'ACF Pro', // The plugin name.
			'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/inc/advanced-custom-fields-pro.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'ACF Theme Code', // The plugin name.
			'slug'               => 'acf-theme-code', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/inc/acf-theme-code.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Grid Builder', // The plugin name.
			'slug'               => 'bs3-grid-builder1', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/inc/bs3-grid-builder1.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Classic Editor', // The plugin name.
			'slug'               => 'classic-editor', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/inc/classic-editor.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		)
);
	tgmpa( $plugins, $config );
}


//send emails from cityline instead of wordpress email

	add_filter('wp_mail_from', 'itsg_mail_from_address');
function itsg_mail_from_address($email){
return 'support@citylinecreative.com';
 }
add_filter('wp_mail_from_name', 'itsg_mail_from_name');
function itsg_mail_from_name($from_name){
return "CityLine Creative";
 }
	

//hide admin bar for editors

add_action('set_current_user', 'cc_hide_admin_bar');
function cc_hide_admin_bar() {
  if (current_user_can('edit_posts')) {
    show_admin_bar(false);
  }
}


//remove wordpress update reminder notifications
function remove_core_updates(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');


//add additional stylesheet to the home page
function front_page_style_sheet() {
if (is_front_page() ) {
wp_enqueue_style( 'front-page-styling', get_stylesheet_directory_uri() . '/home.css' );
}}
add_action('wp_enqueue_scripts', 'front_page_style_sheet');



add_action('admin_menu', 'nwcm_admin_init');
function nwcm_admin_init()
{
    if (!current_user_can('editor'))
        return;

    $menus_to_stay = array(
        'index.php',
        'edit.php',
        'upload.php',
        'edit.php?post_type=page',
        'nav-menus.php',
        'post-new.php',
	'crec-logo',
        'logout'
    );
    foreach ($GLOBALS['menu'] as $key => $value) {
        if (!in_array($value[2], $menus_to_stay))
            remove_menu_page($value[2]);
    }
} 
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
 
function my_login_logo_url_title() {
    return 'Crescendo CMS';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );



function custom_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/crec.svg);
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'custom_login_logo' );

function custom_admin_logo() { ?>
    <style type="text/css">
       li#toplevel_page_crec-logo {
            background-image: url('https://citylinecreative.com/wp-content/themes/Crescendo/images/crec.svg');
        }
    </style>
<?php }
add_action( 'admin_enqueue_scripts', 'custom_login_logo' );

function remove_widgets_submenu() {
      global $submenu;
 
      if (!current_user_can('editor')) {
          return;
      }
      // remove "Widgets" submenu
      foreach($submenu['themes.php'] as $key=>$item) {
          if ($item[2]=='widgets.php') {
                unset($submenu['themes.php'][$key]);
                break;
          }
      }
    }
    add_action('admin_head', 'remove_widgets_submenu');  
 
    function widgets_redirect() {
      $result = stripos($_SERVER['REQUEST_URI'], 'widgets.php');
      if ($result!==false) {
        wp_redirect(get_option('siteurl') . '/wp-admin/index.php');
      }
    }
 
    add_action('admin_menu', 'widgets_redirect');

add_action('check_admin_referer', 'logout_without_confirm', 10, 2);
function logout_without_confirm($action, $result)
{
    /**
     * Allow logout without confirmation
     */
    if ($action == "log-out" && !isset($_GET['_wpnonce'])) {
        $redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : '/';
        $location = str_replace('&amp;', '&', wp_logout_url($redirect_to));
        header("Location: $location");
        die;
    }
}
// Do this only once. Can go anywhere inside your functions.php file
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );

add_action('admin_menu', 'logout_menu_item');
function logout_menu_item() {
    add_menu_page('', 'Logout', 'editor', 'logout', '__return_false', 'dashicons-external', 999); 
}

add_action('after_setup_theme', 'redirect_loggingout');
    function redirect_loggingout() {
    if ( isset($_GET['page']) && $_GET['page'] == 'logout' ) {
      wp_redirect( wp_logout_url() );
      exit();
    }
}


add_action( 'admin_menu', 'my_navigation_menu' );
function my_navigation_menu() {
	add_menu_page( 'Main Navigation', 'Edit Navigation', 'edit_posts', '/nav-menus.php', '', 'dashicons-admin-links', 40  );
}


function custom_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/login.css' );
}
add_action( 'login_enqueue_scripts', 'custom_login_stylesheet' );



add_action( 'wp_dashboard_setup', 'pmg_rm_meta_boxes' );
function pmg_rm_meta_boxes()
{
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
	remove_meta_box( 'siteground_wizard_dashboard', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'welcome-panel', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
}



/*
// example custom dashboard widget
function custom_support_widget() {
	echo "<p>With Crecendo, you can expect a cleaner, easier, and more enjoyable user experience. We do everything we can to periodically add new features and tools to give you more control over your website while maintaining the simplicity you have come to know and love. <br><br>If you are have found a problem with your website, need help updating your website, or just have questions regarding your website, <strong>fill out the form below so someone from our team will get in touch with you ASAP.</strong></p>";
}
function add_custom_support_widget() {
	wp_add_dashboard_widget('custom_support_widget', 'Website Support', 'custom_support_widget');
}
add_action('wp_dashboard_setup', 'add_custom_support_widget');
*/






// example custom dashboard widget
function custom_homepage_widget() {
	echo "
	<div class='dash-btns'>
	<div class='btn-one'>
	<span class='dashicons dashicons-admin-home'></span>
	<h3>View Your Home Page</h3>
	<p>Click here to view your home page and see any changes that you have made.</p>
	<a href='/' class='button-primary'>View Now</a>
	</div>
	<div class='btn-two'>
	<span class='dashicons dashicons-admin-page'></span>
	<h3>Add/Edit Your Pages</h3>
	<p>Click here to go the the page editor where you can add, change, or remove pages.</p>
	<a href='/wp-admin/edit.php?post_type=page' class='button-primary'>View Now</a>
	</div>
	<div class='btn-three'>
	<span class='dashicons dashicons-welcome-write-blog'></span>
	<h3>Add/Edit News & Events</h3>
	<p>Click here to go to your post manager where you can add, change, or remove news posts.</p>
	<a href='/wp-admin/edit.php' class='button-primary'>View Now</a>
	</div>
	</div>
	";
}
function add_custom_homepage_widget() {
	wp_add_dashboard_widget('custom_homepage_widget', 'Dashboard Shortcuts', 'custom_homepage_widget');
}
add_action('wp_dashboard_setup', 'add_custom_homepage_widget');









// get current login user's role and then remove menu items from admin
function remove_menus(){

$roles = wp_get_current_user()->roles;
 
// test role
if( !in_array('editor',$roles)){
return;
}
 
//remove menu from site backend.
	
remove_menu_page( 'edit-comments.php' ); //Comments
remove_menu_page( 'widgets.php' ); //Widgets
remove_menu_page( 'themes.php' ); //Appearance
remove_menu_page( 'plugins.php' ); //Plugins
remove_menu_page( 'users.php' ); //Users
remove_menu_page( 'tools.php' ); //Tools
remove_menu_page( 'options-general.php' ); //Settings
remove_menu_page( 'profile.php' ); //Profile Page
remove_menu_page('edit.php?post_type=testimonial'); // Custom post type 1
remove_menu_page('edit.php?post_type=homeslider'); // Custom post type 2
remove_menu_page('admin.php?page=wppusher'); // WpPusher
}
add_action( 'admin_menu', 'remove_menus' , 100 );
remove_action('welcome_panel', 'wp_welcome_panel');

// Update CSS within in Admin
function admin_stylesheet()
{
    

        wp_register_style('admin_css', get_template_directory_uri() . '/admin.css', array(), '1.0', 'all');
        wp_enqueue_style('admin_css'); 

}

add_action('wp_enqueue_scripts', 'admin_stylesheet');

function admin_style() {
  wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');


add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
);
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function blankslate_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}




add_action( 'admin_menu', 'linked_url' );
    function linked_url() {
    add_menu_page( 'linked_url', '', 'read', 'crec-logo', '', '', 0 );
    }

    add_action( 'admin_menu' , 'linkedurl_function' );
    function linkedurl_function() {
    global $menu;
    $menu[0][2] = home_url();
    }


if ( current_user_can( 'editor' ) && is_admin() )
{
    function wpse271937_hide_adminbar()
    {
        ?>
        <style>
            #wpadminbar {
                display: none!important;
            }
            #wpwrap {
                top: -30px!important;/** change to own preference */
            } 
        </style>
        <?php
    }
    add_action('admin_head', 'wpse271937_hide_adminbar'); 
}
