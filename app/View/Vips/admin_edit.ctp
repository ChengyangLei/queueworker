<div class="block span12">
    <div class="block-heading" data-toggle="collapse" data-target="#tablewidget">VIP账号编辑</div>
    <div class="block-body collapse in">
        <p>
            <div class="alert">编辑</div>
        </p>
        <?php 
            $this->BForm->formatInput = '<div class="control-group"><label class="control-label">%s</label><div class="controls">%s</div></div>';
         ?>
        <?php echo $this->BForm->create('Vip'); ?>
        <?php echo $this->BForm->input('username',array('label'=>'用户名:','type'=>'text','style'=>'width:200px;')); ?>
        <?php echo $this->BForm->input('password',array('label'=>'密码:','type'=>'password','style'=>'width:200px;')); ?>
        <?php echo $this->BForm->submit('提交'); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>