<div class="tasks form">
<?php echo $this->Form->create('Task'); ?>
	<fieldset>
		<legend><?php echo __('Edit Task'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('title');
		echo $this->Form->input('desc');
		echo $this->Form->input('status');
		echo $this->Form->input('project_id');
		echo $this->Form->input('rate');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Task.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Task.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Task Items'), array('controller' => 'task_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task Item'), array('controller' => 'task_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Task Resultes'), array('controller' => 'task_resultes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task Resulte'), array('controller' => 'task_resultes', 'action' => 'add')); ?> </li>
	</ul>
</div>
