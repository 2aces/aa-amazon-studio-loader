<?php
/**
 * Plugin Name: Amazon's Publisher Studio Loader by 2Aces
 * Plugin URI: http://www.2aces.com.br/wordpress-plugins/aa-amazon-studio-loader/
 * Version: 0.1
 * Author: 2Aces Conte&uacute;do
 * Author URI: http://www.2aces.com.br
 * Description: A simple plugin to load Amazon Publisher Studio on your Wordpress blog
 * License: GPL2
 */

// BEGIN Plugin

// Plugin prefixes

$aa_prefix = 'aa_apsl_';
$aa_plugin_name = 'Amazon\'s Publisher Studio Loader by 2Aces';

// Plugin textdomain

function aa_apsl_action_init(){
// Localization
    load_plugin_textdomain( 'aa-amazon-studio-loader', false, plugin_dir_path( __FILE__ ) . '/languages/' );
	register_setting( 'aa_apsl_options', 'aa_apsl_publisher_id', 'sanitize_text_field' ); 
	register_setting( 'aa_apsl_options', 'aa_apsl_publisher_filename', 'sanitize_text_field' ); 
}

// Add actions
add_action('admin_init', 'aa_apsl_action_init');

// In not admin, inserts the script

if( !is_admin() ) {
	function aa_apsl_insert_script () {
		$aa_apsl_publisher_id = get_option('aa_apsl_publisher_id');
		$aa_apsl_publisher_filename = get_option('aa_apsl_publisher_filename');
		echo '<!--celsobessa--><!-- Start of Amazon Publisher Studio Loader -->    <script>var nome = "celso"; window.amznpubstudioTag = "' . $aa_apsl_publisher_id . '";  </script>    <!-- Do not modify the following code ! -->  <script async="true" type="text/javascript" src="http://ps-us.amazon-adsystem.com/domains/' . $aa_apsl_publisher_filename . '.js" charset="UTF-8"></script>    <!-- End of Amazon Publisher Studio Loader -->  ';
	}
	add_action( 'wp_footer', 'aa_apsl_insert_script'); 
};
/** Step 2 (from text above). */
add_action( 'admin_menu', 'aa_apsl_menu' );

/** Step 1. */
function aa_apsl_menu() {
	add_options_page( 'Amazon\'s Publisher Studio Options', 'Amazon\'s Publisher Studio', 'manage_options', 'aa-apsl.php', 'aa_apsl_options' );
}

/** Step 3. */
function aa_apsl_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	};
    /*if( isset($_POST[ $action ]) && $_POST[ $action ] == 'update' ) {
        // Read their posted value
        // Put an settings updated message on the screen
        echo '<div class="updated"><p><em>' . __('Settings Updated','aa-cdnc') . '</em></p></div>';
    }*/
    /*$aa_apsl_publisher_id = '';
    $aa_apsl_publisher_filename = '';
    $aa_apsl_publisher_id = get_option('aa_apsl_publisher_id');
    $aa_apsl_publisher_filename = get_option('aa_apsl_publisher_filename');*/
    ?>
	<div class="wrap">
		<h2><?php _e('Options for Amazon\'s Publisher Studio Loader by ', 'aa-amazon-studio-loader'); echo '2Aces'; ?></h2>
		<p><?php _e('Instructions:', 'aa-amazon-studio-loader');?></p>
		<ol>
			<li>
			<?php _e('Go to your Amazon Associates profile and select the Publisher Studio tab ( <a href="http://j.mp/2APublisherStudio" rel="nofollow">click here</a> )', 'aa-amazon-studio-loader'); ?>
			</li>
			<li>
			<?php _e('Create a new instance and click on "Get Code"', 'aa-amazon-studio-loader'); ?>
			
			</li>
			<li>
			<?php _e('Search the code and copy your Publisher tag.<br/>This is the alphanumeric code between the double quotes after the <code>codeamznpubstudioTag</code>.<br/>( i.e cybl0a-20 on <code>window.amznpubstudioTag = "cybl0a-20"</code>) and paste in the first field below', 'aa-amazon-studio-loader'); ?>
			
			</li>
			<li>
			<?php _e('Search the code and copy your custom script file name.<br/>This is the alphanumeric code between <code>http://ps-us.amazon-adsystem.com/domains/</code> and <code>.js</code>.<br/>( e.g.<code>cybl0a-20_a5e1c142-fc0b-4b4c-abf8-27814868e9b8</code> , on <code>http://ps-us.amazon-adsystem.com/domains/cybl0a-20_a5e1c142-fc0b-4b4c-abf8-27814868e9b8.js</code> ) and paste in the second field below', 'aa-amazon-studio-loader'); ?>
			
			</li>
		</ol>
		<form method="post" action="options.php">
			
			<?php settings_fields( 'aa_apsl_options' );
			$aa_apsl_publisher_id = get_option('aa_apsl_publisher_id');
			$aa_apsl_publisher_filename = get_option('aa_apsl_publisher_filename'); ?>
						
			<table width="100%" style="width:">
				<tr valign="top">
					<th scope="row" style="text-align:left;width:250px;">
						<label for="aa_apsl_publisher_id"><?php _e('Enter your Amazon Publisher tag', 'aa-amazon-studio-loader'); ?></label>
					</th>
					<td>
						<input name="aa_apsl_publisher_id" type="text" id="aa_apsl_publisher_id" value="<?php echo $aa_apsl_publisher_id; ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" style="text-align:left;width:250px;">
						<label  for="aa_apsl_publisher_filename"><?php _e('Enter your Amazon Publisher file name', 'aa-amazon-studio-loader'); ?></label>
					</th>
					<td style="text-align:left;width:350px;">
						<input name="aa_apsl_publisher_filename" type="text" id="aa_apsl_publisher_filename" value="<?php echo $aa_apsl_publisher_filename; ?>" />
					</td>
				</tr>
			</table>
			
			<p>
			<?php submit_button(); ?>
			</p>
		
		</form>
		<p><?php _e('If this plugin helped you, you may consider consider giving @2AcesConteudo a tweet, ranking it good on Wordpress Plugin Repository or linking us on your blog: <a href="http://www.2aces.com.br"?www.2aces.com.br</a>', 'aa-amazon-studio-loader');?></p>
		<p><?php _e('If we may give you a suggestion, you should try <a href="http://j.mp/GerencieWPFacil" rel="nofollow">ManageWP</a> to make your blog life easier.<br/>(full disclosure: if you sign up for a paid plan, we get a small commission.)', 'aa-amazon-studio-loader');?></p>
	</div>
<?php };

/* Runs on plugin deactivation*/
register_activation_hook( __FILE__, 'aa_apsl_activate' );
function aa_apsl_activate() {
	/* Deletes the database fields */
	if ( version_compare( get_bloginfo( 'version' ), '3.5', '<' ) ) {
	   {
	      wp_die("You must update WordPress to use this plugin!");
	   };
   };
   if ( get_option( 'aa_apsl_version' ) === false ){
	      add_option( 'aa_apsl_version', '0.1' );
	   }
   if ( get_option( 'aa_apsl_publisher_id' ) === false ){
      add_option( 'aa_apsl_publisher_id', 'InsertYourPublisherID' );
      add_option( 'aa_apsl_publisher_filename', 'InsertYourPublisherFilename' );
   };
   wp_redirect(admin_url('options-general.php?page=aa-apsl.php'));
};


/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'aa_apsl_deactivate' );
function aa_apsl_deactivate() {
	/* Deletes the database fields */
	unregister_setting( 'aa_apsl_options', 'aa_apsl_publisher_id', 'aa_apsl_publisher_id_validate' ); 
	unregister_setting( 'aa_apsl_options', 'aa_apsl_publisher_filename', 'aa_apsl_publisher_filename_validate' );
};

// Sanitize input.
function aa_apsl_publisher_id_validate() {
	$aa_apsl_publisher_id =  wp_filter_nohtml_kses($aa_apsl_publisher_id);
};
function aa_apsl_publisher_filename_validate() {
	$aa_apsl_publisher_filename =  wp_filter_nohtml_kses($aa_apsl_publisher_filename);
};

// Add settings link on plugin page
function aa_apsl_link($links) { 
  $settings_link = '<a href="options-general.php?page=aa-apsl.php">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'aa_apsl_link' );

?>
