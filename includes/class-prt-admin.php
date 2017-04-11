<?php

namespace PRT\Includes;

class PRT_Admin {

    protected $version;

    protected $settings;

    public function __construct( $version ) {
        $this->version = $version;

        $this->settings = new PRT_Settings('Password Reset Tools');
    }

    public function enqueue_styles($hook) {
        if($hook != 'settings_page_password-reset-tools') {
                return;
        }

		wp_enqueue_style(
			'password-reset-tools-admin',
			plugin_dir_url( dirname(__FILE__) ) . 'assets/css/prt-admin.min.css',
			array(),
			$this->version,
			FALSE
		);
	}

    public function enqueue_scripts($hook) {
        if($hook != 'settings_page_password-reset-tools') {
                return;
        }

        wp_enqueue_script(
            'password-reset-tools-admin',
            plugin_dir_url( dirname(__FILE__) ) . 'assets/js/prt-admin.min.js',
            array('jquery'),
            $this->version,
            TRUE
        );
	}

    public function admin_menu() {
        $this->settings->register_page();
    }

    public function admin_init() {
        $this->settings->register_settings();
        $this->settings->add_checkbox('Admin Send Email', array('default' => 'checked'));
        $this->settings->add_checkbox('Admin Customize Email');
        $this->settings->add_input('Admin Custom Subject', array('default' => 'Notice of Password Change', 'conditional' => 'admin-customize-email'));
        $this->settings->add_textarea('Admin Custom Message', array('default' => "Hi ###USERNAME###,\r\n\r\nThis notice confirms that your password was changed on ###SITENAME###.\r\n\r\nIf you did not change your password, please contact the Site Administrator at\r\n###ADMIN_EMAIL###\r\n\r\nThis email has been sent to ###EMAIL###\r\n\r\nRegards,\r\nAll at ###SITENAME###\r\n###SITEURL###", 'description' => "The following strings have a special meaning and will get replaced dynamically:<br>- ###USERNAME###    The current user's username.<br>- ###ADMIN_EMAIL### The admin email in case this was unexpected.<br>- ###EMAIL###       The old email.<br>- ###SITENAME###    The name of the site.<br>- ###SITEURL###     The URL to the site.", 'conditional' => 'admin-customize-email'));
    }

	public function send_reset_email($boolean){
        $send = $this->settings->get_field('admin-send-email');

        if ( $send ) {
            $boolean = $send->get_value();
        }

		return $boolean;
	}

    public function reset_email_text($email){
        $customize_field = $this->settings->get_field('admin-customize-email');

        if ( $customize_field->get_value() ) {
            $subject_field = $this->settings->get_field('admin-custom-subject');
            $email['subject'] = '[%s] '.$subject_field->get_value();

            $message_field = $this->settings->get_field('admin-custom-message');
            $email['message'] = $message_field->get_value();
        }

        return $email;
    }
}