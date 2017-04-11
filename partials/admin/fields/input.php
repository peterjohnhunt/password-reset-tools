<input type="text" id="<?php echo $this->get_name(); ?>" class="regular-text" name="<?php echo "{$this->get_group()}[{$this->get_name()}]"; ?>" value="<?php echo $this->get_value(); ?>">
<?php if ( $description = $this->get_description() ): ?>
    <p class="description"><?php echo $description; ?></p>
<?php endif; ?>