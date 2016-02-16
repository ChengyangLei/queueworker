<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">任务管理</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                任务列表
            </div>
            <div class="panel-body">
				<table class="table">
					<tr>
                        <th>ID</th>
                        <th>标题</th>
                        <th>描述</th>
                        <th>创建时间</th>
                        <th>状态</th>
                        <th>项目</th>
                        <th>进度</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>操作</th>
					</tr>
					<?php foreach ($tasks as $task): ?>
						<tr>
							<td><?php echo h($task['Task']['id']); ?>&nbsp;</td>
							<td><?php echo h($task['Task']['title']); ?>&nbsp;</td>
							<td><?php echo h($task['Task']['desc']); ?>&nbsp;</td>
							<td><?php echo h(date("Y-m-d H:i:s",$task['Task']['created'])); ?>&nbsp;</td>
							<td><?php echo h($status_arr[$task['Task']['status']]); ?>&nbsp;</td>
							<td><?php echo h($task['Task']['project_id']); ?>&nbsp;</td>
							<td><?php echo h($task['Task']['rate']); ?>&nbsp;</td>
                            <td><?php echo h(date("Y-m-d H:i:s",$task['Task']['start_time'])); ?>&nbsp;</td>
                            <td><?php echo h(date("Y-m-d H:i:s",$task['Task']['end_time'])); ?>&nbsp;</td>
							<td class="actions">
                                <?php if ($task['Task']['status'] == 0): ?>
                                    <?php echo $this->Html->link(__('开始'), array('action' => 'start', $task['Task']['id'])); ?>
                                    <?php elseif($task['Task']['status'] == 1): ?>
                                    <?php echo $this->Html->link(__('暂停'), array('action' => 'end', $task['Task']['id'])); ?>
                                <?php endif ?>
								<?php echo $this->Html->link(__('查看'), array('action' => 'view', $task['Task']['id'])); ?>
								<?php echo $this->Html->link(__('编辑'), array('action' => 'edit', $task['Task']['id'])); ?>
								<?php echo $this->Form->postLink(__('取消'), array('action' => 'delete', $task['Task']['id']), array(), __('是否要取消本次任务?', $task['Task']['id'])); ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
                <?php echo $this->element('pages3'); ?>
            </div>
        </div> 
    </div>
</div>