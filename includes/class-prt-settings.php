<?php

namespace PRT\Includes;
	  use PRT\Includes\Fields;

class PRT_Settings {

	protected $label;

	protected $slug;

	protected $group;

	protected $fields;

	public function __construct( $label ) {
		$this->label   = $label;

		$this->slug    = sanitize_title($label);

		$this->group   = str_replace('-', '_', $this->slug);

		$this->fields  = array();
	}

	public function register_page() {
		add_options_page(
			$this->label,
			$this->label,
			'manage_options',
			$this->slug,
			array($this, 'render_page')
		);
	}

	public function render_page() {
		$template = plugin_dir_path( dirname( __FILE__ ) ) . 'partials/admin/settings.php';
        if ( file_exists( $template ) ) {
            ob_start();
            require $template;
            echo ob_get_clean();
        }
	}

	public function register_settings() {
		register_setting( "{$this->slug}-fields", $this->group, array($this, 'save_empty_fields') );

		add_settings_section(
			"{$this->slug}-section",
			$this->label,
			false,
			"{$this->slug}-fields"
		);
	}

	public function get_fields(){
		return $this->fields;
	}

	public function get_field($name){
		return isset($this->fields[$name]) ? $this->fields[$name] : '';
	}

	public function save_empty_fields($option) {
		if ( !$option ) {
			$option = array();
		}

		foreach ($this->fields as $field) {
			$name = $field->get_name();
			if ( !isset($option[$name]) ) {
				$option[$name] = '';
			}
		}

		return $option;
	}

	public function add_field($field) {
		$id = $field->get_name();
		$this->fields[$id] = $field;
	}

	public function add_input($label, $settings=array()) {
		$this->add_field(new Fields\PRT_Input($label, $this->slug, $this->group, $settings));
	}

	public function add_checkbox($label, $settings=array()) {
		$this->add_field(new Fields\PRT_Checkbox($label, $this->slug, $this->group, $settings));
	}

	public function add_textarea($label, $settings=array()) {
		$this->add_field(new Fields\PRT_Textarea($label, $this->slug, $this->group, $settings));
	}
}