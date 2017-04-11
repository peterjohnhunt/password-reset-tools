<?php

namespace PRT\Includes\Fields;

class PRT_Checkbox extends PRT_Field {

    public function __construct($label, $parent, $group, $settings=array()){
        $settings['type'] = 'checkbox';

        parent::__construct($label, $parent, $group, $settings);
    }

    public function checked(){
        if ( $this->get_value() ) {
            echo ' checked="checked"';
        }
    }
}
