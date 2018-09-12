<?php
/*
 * Template/EventTypes/add.ctp
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
?>

<div class="actions small-12 medium-4 large-3 columns">
	<h4>Actions</h4>
	<ul class="no-bullet">
		<li><?= $this->Html->link(__('Manage Task Types', true), ['action' => 'index']);?></li>
		<li><?= $this->Html->link(__('Manage Tasks', true), ['controller' => 'events', 'action' => 'index']); ?></li>
		<li><?= $this->Html->link(__('View Calendar', true), ['controller' => 'full_calendar']); ?></li>
	</ul>
</div>
<div class="float-none form small-12 medium-8 large-9 columns">
	<?= $this->Form->create($eventType);?>
		<fieldset>
	 		<legend><?= __('Add Company'); ?></legend>
		<?php
			echo $this->Form->input('name');
			echo $this->Form->input('color', 
						['options' => [
							'MCS' => 'MCS',
							'MET' => 'MET',
							'METSB' => 'METSB',
							'INI' => 'INI',
							'UCC' => 'UCC',
							'M-LAB' => 'M-LAB',
							'MDT' => 'MDT',
							'FAILURE' => 'FAILURE',
							'MAINTENANCE' => 'MAINTENANCE',
							'HOUSEKEEPING' => 'HOUSEKEEPING'

						]]);
	
		?>
		</fieldset>
	<?= $this->Form->button(__('Submit', true));?>
	<?= $this->Form->end(); ?>
</div>