<textarea id="<?php echo $this->get_name(); ?>" rows="10" cols="50" class="regular-text" name="<?php echo "{$this->get_group()}[{$this->get_name()}]"; ?>" ><?php echo $this->get_value(); ?></textarea>
<?php if ( $description = $this->get_description() ): ?>
    <p class="description"><?php echo $description; ?></p>
<?php endif; ?>