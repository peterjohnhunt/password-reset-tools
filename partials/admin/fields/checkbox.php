<input type="checkbox" id="<?php echo $this->get_name(); ?>" name="<?php echo "{$this->get_group()}[{$this->get_name()}]"; ?>"<?php $this->checked(); ?>>
<?php if ( $description = $this->get_description() ): ?>
    <p class="description"><?php echo $description; ?></p>
<?php endif; ?>