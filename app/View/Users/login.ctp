<style type="text/css">
#UserLoginForm {
max-width: 400px;
padding: 19px 29px 29px;
margin: 40px auto 20px;
background-color: #fff;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
margin:0 auto;
position:relative;
top:183px;
left: -200px;
}
#UserLoginForm input[type="text"],#UserLoginForm input[type="password"] {
font-size: 16px;
height: auto;
margin-bottom: 15px;
padding: 7px 9px;
}
.masthead{display:none;}
body{background:url(/app/webroot/img/bg.jpg) center top repeat-x;}
#flashMessage{
position: relative;
top: 167px;
width: 560px;
margin-left: 94px;
}
</style>
<div class="container">
    <?php echo $this->BForm->create('User');?>
    <?php echo $this->BForm->input('email', array('label'=>"邮箱", 'class'=>'input-block-level', 'placeholder'=>'注册邮箱'));?>
    <?php echo $this->BForm->input('password', array('label'=>"密码", 'type'=>'password', 'class'=>'input-block-level', 'placeholder'=>'密码'));?>
    <?php echo $this->BForm->input('captcha', array('label'=>"验证码", 'type'=>'text', 'class'=>'input-block-level', 'after'=>"<img id='captcha' src='/index.php/users/captcha'>"));?>
    <?php echo $this->BForm->submit('登录', array('class'=>'btn btn-large btn-primary', 'type'=>'submit'));?>
    <hr>    
    <?php echo $this->Form->end();?>
</div>
<script type="text/javascript">
    $("#captcha").click(function(){
        $(this)[0].src = $(this)[0].src+"?r="+Math.random();
    });
</script>