<div class="tasks view">
<h2><?php echo __('Task'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($task['Task']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($task['User']['name'], array('controller' => 'users', 'action' => 'view', $task['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($task['Task']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc'); ?></dt>
		<dd>
			<?php echo h($task['Task']['desc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($task['Task']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($task['Task']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($task['Task']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project Id'); ?></dt>
		<dd>
			<?php echo h($task['Task']['project_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($task['Task']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($task['Task']['start_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Time'); ?></dt>
		<dd>
			<?php echo h($task['Task']['end_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Task'), array('action' => 'edit', $task['Task']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Task'), array('action' => 'delete', $task['Task']['id']), array(), __('Are you sure you want to delete # %s?', $task['Task']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Task Items'), array('controller' => 'task_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task Item'), array('controller' => 'task_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Task Resultes'), array('controller' => 'task_resultes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task Resulte'), array('controller' => 'task_resultes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Task Items'); ?></h3>
	<?php if (!empty($task['TaskItem'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Task Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Start Time'); ?></th>
		<th><?php echo __('End Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($task['TaskItem'] as $taskItem): ?>
		<tr>
			<td><?php echo $taskItem['id']; ?></td>
			<td><?php echo $taskItem['task_id']; ?></td>
			<td><?php echo $taskItem['status']; ?></td>
			<td><?php echo $taskItem['start_time']; ?></td>
			<td><?php echo $taskItem['end_time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'task_items', 'action' => 'view', $taskItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'task_items', 'action' => 'edit', $taskItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'task_items', 'action' => 'delete', $taskItem['id']), array(), __('Are you sure you want to delete # %s?', $taskItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Task Item'), array('controller' => 'task_items', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Task Resultes'); ?></h3>
	<?php if (!empty($task['TaskResulte'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Task Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Data'); ?></th>
		<th><?php echo __('Data Src'); ?></th>
		<th><?php echo __('Data Url'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($task['TaskResulte'] as $taskResulte): ?>
		<tr>
			<td><?php echo $taskResulte['id']; ?></td>
			<td><?php echo $taskResulte['task_id']; ?></td>
			<td><?php echo $taskResulte['type']; ?></td>
			<td><?php echo $taskResulte['data']; ?></td>
			<td><?php echo $taskResulte['data_src']; ?></td>
			<td><?php echo $taskResulte['data_url']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'task_resultes', 'action' => 'view', $taskResulte['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'task_resultes', 'action' => 'edit', $taskResulte['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'task_resultes', 'action' => 'delete', $taskResulte['id']), array(), __('Are you sure you want to delete # %s?', $taskResulte['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Task Resulte'), array('controller' => 'task_resultes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
