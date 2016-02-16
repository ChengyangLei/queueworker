<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">添加任务</h1>
		<?php 
			$this->BForm->formatInput = '<div class="form-group"><label class="col-sm-2 control-label">%s</label><div class="col-sm-10">%s</div></div>';
		?>
        <?php echo $this->BForm->create('Task',array('class'=>'form-horizontal')); ?>
        <?php echo $this->BForm->input('title',array('label'=>'标题:','type'=>'text','style'=>'width:400px;')); ?>
        <?php echo $this->BForm->input('desc',array('label'=>'描述:','type'=>'textarea','style'=>'width:400px;')); ?>
        <?php echo $this->BForm->submit('下一步'); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>