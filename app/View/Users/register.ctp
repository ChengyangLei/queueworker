<style type="text/css">
.form-signin {
max-width: 300px;
padding: 19px 29px 29px;
margin: 40px auto 20px;
background-color: #fff;
border: 1px solid #e5e5e5;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
}
.form-signin .form-signin-heading,.form-signin .checkbox {
margin-bottom: 10px;
}
.form-signin input[type="text"],.form-signin input[type="password"] {
font-size: 16px;
height: auto;
margin-bottom: 15px;
padding: 7px 9px;
}
</style>
<div class="container">
    <div class="row-fluid">
        <div class="col-md-6">
            <?php echo $this->BForm->create('User', array('class'=>'form-signin'));?>
            <?php echo $this->BForm->input('email', array('label'=>"邮箱", 'class'=>'input-block-level', 'placeholder'=>'注册邮箱'));?>
            <?php echo $this->BForm->input('password', array('label'=>"密码", 'type'=>'password', 'class'=>'input-block-level', 'placeholder'=>'密码'));?>
            <?php echo $this->BForm->input('cpassword', array('label'=>"重复密码", 'type'=>'password', 'class'=>'input-block-level', 'placeholder'=>'密码'));?>
            <?php echo $this->BForm->submit('注册', array('class'=>'btn btn-large btn-primary', 'type'=>'submit'));?>
            <hr>    
            <?php echo $this->Form->end();?>
        </div>
        <div class="col-md-6 pull-right">
            <p>还没有账户?</p>
            <p><a class="btn btn-default" href="/users/login" role="button">登录</a></p>
        </div>
    </div>
</div>