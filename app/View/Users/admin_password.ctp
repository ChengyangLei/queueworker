<div class="block span12">
    <div class="block-body collapse in">
        <p>
            <div class="alert">修改密码</div>
        </p>
        <?php 
            $this->BForm->formatInput = '<div class="control-group"><label class="control-label">%s</label><div class="controls">%s</div></div>';
         ?>
        <?php echo $this->BForm->create('User'); ?>
        <?php echo $this->BForm->input('opassword',array('label'=>'旧密码:','type'=>'password','style'=>'width:200px;')); ?>
        <?php echo $this->BForm->input('password',array('label'=>'新密码:','type'=>'password','style'=>'width:200px;')); ?>
        <?php echo $this->BForm->input('cpassword',array('label'=>'重复新密码:','type'=>'password','style'=>'width:200px;')); ?>
        <?php echo $this->BForm->submit('提交'); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>