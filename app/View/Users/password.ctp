<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">修改密码</h1>
        <?php echo $this->BForm->create('User'); ?>
        <?php echo $this->BForm->input('opassword',array('label'=>'旧密码:','type'=>'password','style'=>'width:400px;')); ?>
        <?php echo $this->BForm->input('password',array('label'=>'新密码:','type'=>'password','style'=>'width:400px;')); ?>
        <?php echo $this->BForm->input('cpassword',array('label'=>'重复新密码:','type'=>'password','style'=>'width:400px;')); ?>
        <?php echo $this->BForm->submit('提交'); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>