<?php

namespace PRT\Includes\Fields;

class PRT_Field {

    protected $settings;

    public function __construct( $label, $parent, $group, $settings ) {

        $defaults = array(
            'label'       => $label,
            'name'        => sanitize_title($label),
            'group'       => $group,
            'parent'      => $parent,
            'description' => '',
            'conditional' => '',
        );

        $this->settings  = wp_parse_args($settings, $defaults);

        $attributes = array(
            'label_for' => $this->settings['name']
        );

        if ($this->settings['conditional']) {
            $attributes['class'] = "conditional {$this->settings['conditional']}";
        }

        add_settings_field(
			$this->settings['name'],
			$this->settings['label'],
			array( $this, 'render' ),
			"{$this->settings['parent']}-fields",
			"{$this->settings['parent']}-section",
            $attributes
		);
    }

    public function render() {
        $template = plugin_dir_path( dirname( dirname( __FILE__ ) ) ) . 'partials/admin/fields/' . $this->settings['type'] . '.php';
        if ( file_exists( $template ) ) {
            ob_start();
            require $template;
            echo ob_get_clean();
        }
    }

    public function get_name(){
        return $this->settings['name'];
    }

    public function get_group(){
        return $this->settings['group'];
    }

    public function get_description(){
        return $this->settings['description'];
    }

    public function get_conditional(){
        return $this->settings['conditional'];
    }

    public function get_value() {
        $value   = '';
        $options = get_option($this->settings['group']);

        if ($options && isset($options[$this->settings['name']])) {
            $value = $options[$this->settings['name']];
        } else {
            $value = isset($this->settings['default']) ? $this->settings['default'] : '';
        }

        return $value;
    }
}