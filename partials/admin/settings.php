<form id="<?php echo $this->slug; ?>" action='options.php' method='post'>
	<?php
		settings_errors( "{$this->slug}-fields" );
		do_settings_sections( "{$this->slug}-fields" );
		settings_fields( "{$this->slug}-fields" );
		submit_button('Save');
	?>
</form>