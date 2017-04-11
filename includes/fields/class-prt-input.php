<?php

namespace PRT\Includes\Fields;

class PRT_Input extends PRT_Field {

    public function __construct($label, $parent, $group, $settings=array()){
        $settings['type'] = 'input';

        parent::__construct($label, $parent, $group, $settings);
    }
}
