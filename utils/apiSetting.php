<?php

/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class HypersignPluginAPISetting
{
	private $hypersign_api_setting_options;

	public function __construct()
	{
		add_action('admin_menu', array($this, 'hypersign_api_setting_add_plugin_page'));
		add_action('admin_init', array($this, 'hypersign_api_setting_page_init'));
	}

	public function hypersign_api_setting_add_plugin_page()
	{
		add_options_page(
			'Hypersign API Setting', // page_title
			'Hypersign API', // menu_title
			'manage_options', // capability
			'hypersign-api-setting', // menu_slug
			array($this, 'hypersign_api_setting_create_admin_page') // function
		);
	}

	public function hypersign_api_setting_create_admin_page()
	{
		$this->hypersign_api_setting_options = get_option('hypersign_api_setting_option_name'); ?>

		<div class="wrap">
			<img src="https://thumb.tildacdn.com/tild3065-3765-4865-b331-393637653931/-/resize/150x/-/format/webp/hypersign_Yellow.png" />
			<!-- <h2>Hypersign API Setting</h2> -->
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
				settings_fields('hypersign_api_setting_option_group');
				do_settings_sections('hypersign-api-setting-admin');
				submit_button();
				?>
			</form>
		</div>
	<?php }

	public function hypersign_api_setting_page_init()
	{
		register_setting(
			'hypersign_api_setting_option_group', // option_group
			'hypersign_api_setting_option_name', // option_name
			array($this, 'hypersign_api_setting_sanitize') // sanitize_callback
		);

		add_settings_section(
			'hypersign_api_setting_setting_section', // id
			'Settings', // title
			array($this, 'hypersign_api_setting_section_info'), // callback
			'hypersign-api-setting-admin' // page
		);

		add_settings_field(
			'app_id_0', // id
			'App Id', // title
			array($this, 'app_id_0_callback'), // callback
			'hypersign-api-setting-admin', // page
			'hypersign_api_setting_setting_section' // section
		);

		add_settings_field(
			'app_secret_1', // id
			'App Secret', // title
			array($this, 'app_secret_1_callback'), // callback
			'hypersign-api-setting-admin', // page
			'hypersign_api_setting_setting_section' // section
		);

		add_settings_field(
			'login_page_2', // id
			'Login Page', // title
			array($this, 'login_page_2_callback'), // callback
			'hypersign-api-setting-admin', // page
			'hypersign_api_setting_setting_section' // section
		);

		add_settings_field(
			'after_login_3', // id
			'After Login', // title
			array($this, 'after_login_3_callback'), // callback
			'hypersign-api-setting-admin', // page
			'hypersign_api_setting_setting_section' // section
		);

		add_settings_field(
			'lock_access_to_wp_login_php_4', // id
			'Lock Access to wp-login.php', // title
			array($this, 'lock_access_to_wp_login_php_4_callback'), // callback
			'hypersign-api-setting-admin', // page
			'hypersign_api_setting_setting_section' // section
		);

		
		
	}

	public function hypersign_api_setting_sanitize($input)
	{
		$sanitary_values = array();
		if (isset($input['app_id_0'])) {
			$sanitary_values['app_id_0'] = sanitize_text_field($input['app_id_0']);
		}

		if (isset($input['app_secret_1'])) {
			$sanitary_values['app_secret_1'] = sanitize_text_field($input['app_secret_1']);
		}
		if (isset($input['login_page_2'])) {
			$sanitary_values['login_page_2'] = $input['login_page_2'];
		}

		if (isset($input['after_login_3'])) {
			$sanitary_values['after_login_3'] = $input['after_login_3'];
		}

		if (isset($input['lock_access_to_wp_login_php_4'])) {
			$sanitary_values['lock_access_to_wp_login_php_4'] = $input['lock_access_to_wp_login_php_4'];
		}


		

		return $sanitary_values;
	}

	public function hypersign_api_setting_section_info()
	{
	}

	public function app_id_0_callback()
	{
		printf(
			'<input class="regular-text" type="text" name="hypersign_api_setting_option_name[app_id_0]" id="app_id_0" value="%s">',
			isset($this->hypersign_api_setting_options['app_id_0']) ? esc_attr($this->hypersign_api_setting_options['app_id_0']) : ''
		);
	}

	public function app_secret_1_callback()
	{
		printf(
			'<input class="regular-text" type="password" name="hypersign_api_setting_option_name[app_secret_1]" id="app_secret_1" value="%s">',
			isset($this->hypersign_api_setting_options['app_secret_1']) ? esc_attr($this->hypersign_api_setting_options['app_secret_1']) : ''
		);
	}
	

	public function login_page_2_callback() {
		?> <select class="regular-text" name="hypersign_api_setting_option_name[login_page_2]" id="login_page_2">
			<?php $pages = get_pages(); ?>
			<?php foreach ($pages as $page) { ?>

			<?php $selected = (isset( $this->hypersign_api_setting_options['login_page_2'] ) && $this->hypersign_api_setting_options['login_page_2'] === get_page_link($page->ID)) ? 'selected' : '' ; ?>
			<option value="<?php echo get_page_link($page->ID) ?>" <?php echo $selected; ?>> <?php echo $page->post_title ?></option>

			<?php } ?>
		</select> <?php
	}

	public function after_login_3_callback() {
		?> <select class="regular-text" name="hypersign_api_setting_option_name[after_login_3]" id="after_login_3">
			<?php $pages = get_pages(); ?>
			<?php foreach ($pages as $page) { ?>

			<?php $selected = (isset( $this->hypersign_api_setting_options['after_login_3'] ) && $this->hypersign_api_setting_options['after_login_3'] === get_page_link($page->ID)) ? 'selected' : '' ; ?>
			<option value="<?php echo get_page_link($page->ID) ?>" <?php echo $selected; ?>> <?php echo $page->post_title ?></option>

			<?php } ?>
		</select> <?php
	}

	
	public function lock_access_to_wp_login_php_4_callback()
	{
		printf(
			'<input type="checkbox" name="hypersign_api_setting_option_name[lock_access_to_wp_login_php_4]" id="lock_access_to_wp_login_php_4" value="lock_access_to_wp_login_php_4" %s> <label for="lock_access_to_wp_login_php_4">Enable to lock access to wp-login.php. Users will be redirected to the Hypersign login page.</label>',
			(isset($this->hypersign_api_setting_options['lock_access_to_wp_login_php_4']) && $this->hypersign_api_setting_options['lock_access_to_wp_login_php_4'] === 'lock_access_to_wp_login_php_4') ? 'checked' : ''
		);
	}
}
if (is_admin())
	$hypersign_api_setting = new HypersignPluginAPISetting();

/* 
 * Retrieve this value with:
 * $hypersign_api_setting_options = get_option( 'hypersign_api_setting_option_name' ); // Array of All Options
 * $app_id_0 = $hypersign_api_setting_options['app_id_0']; // App Id
 * $app_secret_1 = $hypersign_api_setting_options['app_secret_1']; // App Secret
 * $after_login_2 = $hypersign_api_setting_options['after_login_2']; // After Login
 * $lock_access_to_wp_login_php_4 = $hypersign_api_setting_options['lock_access_to_wp_login_php_3']; // Lock Access to wp-login.php
 */



?>