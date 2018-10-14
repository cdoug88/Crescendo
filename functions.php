<?php
//test



add_action('admin_init', 'nwcm_admin_init');

function nwcm_admin_init()
{   
	      if (!current_user_can('editor')) {
          return;
      }
    // Remove unnecessary menus 
    $menus_to_stay = array(
        // Client manager
        'index.php',

        // Dashboard
        'edit.php',

        // Users
        'upload.php',
		'edit.php?post_type=page',
		'nav-menus.php',
		'admin.php?page=logout'
    );      
    foreach ($GLOBALS['menu'] as $key => $value) {          
        if (!in_array($value[2], $menus_to_stay)) remove_menu_page($value[2]);
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
    add_menu_page('', 'Logout', 'manage_options', 'logout', '__return_false', 'dashicons-external', 999); 
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



// example custom dashboard widget
function custom_dashboard_widget() {
	echo "<p>With Crecendo, you can expect a cleaner, easier, and more enjoyable user experience. Inspired by your comments and feedback, we are always working on taking Crecendo to the next level of usability. We do everything we can to periodically add new features and tools to give you more control over your website while maintaining the simplicity you have come to know and love. <br><br>Feel free to reach out to us at anytime for technical support. Check back here for information on the latest updates and releases.</p>
	<ul>
	<li><a href='#'>test</a></li>
	</ul>";
}
function add_custom_dashboard_widget() {
	wp_add_dashboard_widget('custom_dashboard_widget', 'Website Support', 'custom_dashboard_widget');
}
add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');




// get current login user's role and then remove menu items from admin
function remove_menus(){

$roles = wp_get_current_user()->roles;
 
// test role
if( !in_array('editor',$roles)){
return;
}
 
//remove menu from site backend.
	
remove_menu_page( 'edit-comments.php' ); //Comments
remove_menu_page( 'edit.php' ); //Comments
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

add_action('admin_menu', 'logout_menu_item');
	      if (!current_user_can('editor')) {
          return;

function logout_menu_item() {
    add_menu_page('', 'Logout', 'manage_options', 'logout', '__return_false', 'dashicons-external', 999); 
}
		            }
