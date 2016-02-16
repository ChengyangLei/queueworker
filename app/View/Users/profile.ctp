<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">个人资料</h1>
        <?php 
            $this->BForm->formatInput = '<div class="form-group"><label class="col-sm-2 control-label">%s</label><div class="col-sm-10">%s</div></div>';
        ?>
        <?php echo $this->BForm->create('User',array('class'=>'form-horizontal')); ?>
        <?php echo $this->BForm->input('email',array('label'=>'邮箱:','type'=>'text','disabled'=>"disabled",'style'=>'width:400px;')); ?>
        <?php echo $this->BForm->input('name',array('label'=>'用户名:','type'=>'text','style'=>'width:400px;')); ?>
        <?php echo $this->BForm->input('qq',array('label'=>'QQ:','type'=>'text','style'=>'width:400px;')); ?>
        <?php echo $this->BForm->input('tel',array('label'=>'电话:','type'=>'text','style'=>'width:400px;')); ?>
        <?php echo $this->BForm->submit('提交'); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>