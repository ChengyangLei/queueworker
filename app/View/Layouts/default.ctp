<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
		昵图网下载
		</title>
		<?php echo $this->Html->css('bootstrap.min'); ?>
		<?php echo $this->Html->css('main'); ?>
		<?php echo $this->Html->script('jquery'); ?>
		<?php echo $this->Html->script('bootstrap.min'); ?>
	</head>
	<style type="text/css">
		body table{font-size:12px;}
		#content{min-height:500px;}
		.tip{font-size:12px;color:#666;}
		.red{color:#a00;}
		.sub{font-size:14px;}
		img{max-width:100%;}
		.alert{color:#f60;background:#f1f1f1;border-radius:3px;}
	</style>
	<body>
		<div class="top">
		<div class="container" >
			<div class="log">
				<a href="/"><?php echo $this->Html->image("logo.png"); ?></a>
			</div>
		</div>
		</div>
		<div class="masthead">
			<div class="container">
			        <ul class="nav nav-pills pull-right">
			            <li><a href="/">开始</a></li>
			            <?php if ($user['email']): ?>
			            <li><a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'home')) ?>">个人中心</a></li>
			            <li><a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'logs')) ?>">下载记录</a></li>
			            <li><a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'password')) ?>">修改密码</a></li>
			            <li><a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'logout')) ?>">退出</a></a></li>
			        <?php else: ?>
			            <li><a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'login')) ?>">登陆/注册</a></a></li>
			            <?php endif ?>
			        </ul>
			</div>
		</div>
		<div class="container">
		    <hr>
			<div id="content">
		        <?php echo $this->Session->flash(); ?>
		        <?php echo $this->fetch('content'); ?>
			</div>
		    <hr>
		    <div class="footer">
		        <!-- <p>© Company 2013</p> -->
		    </div>
		</div>
		<?php echo $this->Html->script('shelp'); ?>
	</body>
</html>