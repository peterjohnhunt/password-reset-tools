<?php

namespace PRT\Includes\Fields;

class PRT_Textarea extends PRT_Field {

    public function __construct($label, $parent, $group, $settings=array()){
        $settings['type'] = 'textarea';

        parent::__construct($label, $parent, $group, $settings);
    }
}
