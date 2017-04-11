jQuery(document).ready(function($){
    var $form         = $('#password-reset-tools'),
        $checkbox     = $form.find('input[type="checkbox"]'),
        $conditionals = $form.find('.conditional');

    $checkbox.on('conditional', function(){
        var checked = $(this).is(':checked'),
            name    = $(this).attr('id');
            $fields = $conditionals.filter('.'+name);

        if( $fields[0] ){
            if( checked ){
                $fields.show();
            } else {
                $fields.hide();
            }
        }
    });

    $checkbox.click(function(){
        $(this).trigger('conditional');
    });

    $(window).load(function(){
        $checkbox.trigger('conditional');
    });

});