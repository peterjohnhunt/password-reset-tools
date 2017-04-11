<?php

namespace PRT\Includes;

class Password_Reset_Tools {

	protected $loader;

	protected $slug;

	protected $version;

	protected $actions;

	protected $filters;

	public function __construct() {
		$this->slug = 'password-reset-tools';
		$this->version = '1.0.0';

		$this->actions = array();
		$this->filters = array();

		$this->define_admin_hooks();
	}

	private function define_admin_hooks() {
		$admin = new PRT_Admin( $this->get_version() );
		$this->add_action('admin_enqueue_scripts', $admin, 'enqueue_styles');
		$this->add_action('admin_enqueue_scripts', $admin, 'enqueue_scripts');
		$this->add_action('admin_menu', $admin, 'admin_menu');
		$this->add_action('admin_init', $admin, 'admin_init');
		$this->add_action('send_password_change_email', $admin, 'send_reset_email');
		$this->add_action('password_change_email', $admin, 'reset_email_text');
	}

	public function add_action( $hook, $component, $callback ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback );
	}

	public function add_filter( $hook, $component, $callback ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback );
	}

	private function add( $hooks, $hook, $component, $callback ) {
		$hooks[] = array(
			'hook'      => $hook,
			'component' => $component,
			'callback'  => $callback
		);
		return $hooks;
	}

	public function run() {
		 foreach ( $this->filters as $hook ) {
			 add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		 }
		 foreach ( $this->actions as $hook ) {
			 add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		 }
	}

	public function get_version() {
		return $this->version;
	}
}