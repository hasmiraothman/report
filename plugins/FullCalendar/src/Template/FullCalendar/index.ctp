<?php
/*
 * Template/FullCalendar/index.ctp
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */
?>


<!-- div class="users form large-9 medium-8 columns content">
    <fieldset>
        

        <?php
            echo $this->Form->create(null, ['valueSources' => 'query']);
	    	// You'll need to populate $authors in the template from your controller
	    	echo $this->Form->control('user_id');
	    	// Match the search param in your table configuration
	    	echo $this->Form->control('q');
	    	echo $this->Form->button('Filter', ['type' => 'submit']);
	    	// in your form
			if (!empty($_isSearch)) {
			    echo $this->Html->link('Reset', ['action' => 'index']);
			}
        ?>
    </fieldset>
  
</div> -->


<div class="Calendar index">
	<div id="calendar"></div>
</div>
<div class="actions">
	<ul class="no-bullet">
		
	    <li><?= $this->Html->link(__('Add a Task', true), ['controller' => 'events', 'action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('Manage Tasks', true), ['controller' => 'events']) ?></li>
		<li><?= $this->Html->link(__('Manage Tasks Types', true), ['controller' => 'event_types']) ?></li>	
				
	</ul>
</div>

<?= $this->Html->css('/full_calendar/css/fullcalendar.min', ['plugin' => true]); ?>
<?= $this->Html->css('/full_calendar/css/jquery.qtip.min', ['plugin' => true]); ?>
<?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js') ?>
<?= $this->Html->script('/full_calendar/js/lib/moment.min.js', ['plugin' => true]); ?>
<?= $this->Html->script('/full_calendar/js/fullcalendar.js', ['plugin' => true]); ?>
<?= $this->Html->script('/full_calendar/js/jquery.qtip.min.js', ['plugin' => true]); ?>
<?= $this->Html->script('/full_calendar/js/ready.js', ['plugin' => true]); ?>