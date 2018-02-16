<?php 
	/**
	* Plugin Name: Custom Post Type Divi Module Extension
	* Plugin URI: 
	* Description: A plugin for extending Divi Builder's custom modules that enable the user to post a custom post type using the Blog Module template
	* Author: John Limuel Zoleta
	* Version: 1.0
	* Author URI: mailto:jlrzoleta@gmail.com
	*/
	
	/**
	* Exit if accessed directly
	*/
	if( ! defined('ABSPATH') ){
		exit;
	}
	$root_dir = plugin_dir_path(__FILE__);
	$plugin_dir = plugin_dir_path(__DIR__);
	$divi_modules_dir = $plugin_dir . "includes/builder/main-modules.php";


function gc_dbcm_init(){
    global $pagenow;
    
    $is_admin = is_admin();
    $action_hook = $is_admin ? 'wp_loaded' : 'wp';
    $required_admin_pages = array( 'edit.php', 'post.php', 'post-new.php', 'admin.php', 'customize.php', 'edit-tags.php', 'admin-ajax.php', 'export.php' ); // list of admin pages where we need to load builder files
    $specific_filter_pages = array( 'edit.php', 'admin.php', 'edit-tags.php' );
    $is_edit_library_page = 'edit.php' === $pagenow && isset( $_GET['post_type'] ) && 'et_pb_layout' === $_GET['post_type'];
    $is_role_editor_page = 'admin.php' === $pagenow && isset( $_GET['page'] ) && 'et_divi_role_editor' === $_GET['page'];
    $is_import_page = 'admin.php' === $pagenow && isset( $_GET['import'] ) && 'wordpress' === $_GET['import']; 
    $is_edit_layout_category_page = 'edit-tags.php' === $pagenow && isset( $_GET['taxonomy'] ) && 'layout_category' === $_GET['taxonomy'];
    if ( ! $is_admin || ( $is_admin && in_array( $pagenow, $required_admin_pages ) && ( ! in_array( $pagenow, $specific_filter_pages ) || $is_edit_library_page || $is_role_editor_page || $is_edit_layout_category_page || $is_import_page ) ) ) {
        add_action($action_hook, 'gc_dbcm_init_modules', 9789);
    }
}
add_action('init', 'gc_dbcm_init');

function gc_dbcm_init_modules(){
    if(class_exists("ET_Builder_Module")){
       include("jlrz-divi-custom-post-types.php");
    }
}
