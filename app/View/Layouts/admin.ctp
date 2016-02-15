<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>昵图网下载</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php echo $this->Html->css('admin/bootstrap'); ?>
    <?php echo $this->Html->css('admin/bootstrap-responsive'); ?>
    <?php echo $this->Html->css('admin/theme'); ?>
    <?php echo $this->Html->css('admin/font-awesome'); ?>
    <?php echo $this->Html->script('admin/jquery-1.8.1.min'); ?>
    <?php echo $this->Html->script('dialog',array('id'=>'dialog_js')); ?>
    
    <style type="text/css">
    #line-chart {
    height:300px;
    width:800px;
    margin: 0px auto;
    margin-top: 1em;
    }
    .brand { font-family: georgia, serif; }
    .brand .first {
    color: #ccc;
    font-style: italic;
    }
    .brand .second {
    color: #fff;
    font-weight: bold;
    }
    </style>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]> <body class="ie ie7"> <![endif]-->
<!--[if IE 8 ]> <body class="ie ie8"> <![endif]-->
<!--[if IE 9 ]> <body class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<body>
    <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <ul class="nav pull-right">
                    
                    <li id="fat-menu" class="dropdown">
                        <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user"></i> <?php echo $user['name']; ?>
                        <i class="icon-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="/index.php/">用户首页</a></li>
                            <li><a tabindex="-1" href="/index.php/admin/Users/password">修改密码</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="/index.php/Users/logout">退出</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="/index.php/admin/Users/inde"><span class="first">Your</span> <span class="second">昵图网下载管理面板</span></a>
                <div class="learfix"></div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span3">
                <div class="sidebar-nav">
                    <div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu"><i class="icon-dashboard"></i>会员管理<span class="label label-info">2</span></div>
                    <ul id="dashboard-menu" class="nav nav-list collapse in">
                        <li><a href="/index.php/admin/Users/index">用户管理</a></li>
                        <li ><a href="/index.php/admin/Users/add">添加用户</a></li>
                    </ul>
                    <div class="nav-header" data-toggle="collapse" data-target="#settings-menu"><i class="icon-exclamation-sign"></i>基本设置<span class="label label-info">2</span></div>
                    <ul id="settings-menu" class="nav nav-list collapse in">
                        <li ><a href="/index.php/admin/Vips/index">昵图VIP账号</a></li>
                        <li ><a href="/index.php/admin/Vips/add">添加账号</a></li>
                    </ul>
                    <div class="nav-header" data-toggle="collapse" data-target="#settings-menu"><i class="icon-exclamation-sign"></i>下载日志<span class="label label-info">1</span></div>
                    <ul id="settings-menu" class="nav nav-list collapse in">
                        <li ><a href="/index.php/admin/Users/logs">下载记录</a></li>
                    </ul>
                </div>
            </div>
            <div class="span9">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
        <footer>
            <hr>
            <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
            <p>&copy; 2013 <a href="/index.php/">昵图网下载</a></p>
        </footer>
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <?php echo $this->Html->script('libs/bootstrap.min'); ?>
    <script type="text/javascript">
        // <a href="javascript:void(0);" ectype="dialog" dialog_id="my_address_edit" dialog_title="编辑地址" dialog_width="700" uri="index.php?app=my_address&act=edit&addr_id=2" class="edit1 float_none">编辑</a>
        function ajax_form( id, title, url, width ) {
            if ( !width ) {
                width = 400;
            }
            var d = DialogManager.create( id );
            d.setTitle( title );
            d.setContents( "ajax", url );
            d.setWidth( width );
            d.show( "center" );
            return d;
        }
        var take_ajax_form  = function () {
            var id = $(this).attr('dialog_id');
            var title = $(this).attr('dialog_title') ? $(this).attr('dialog_title') : '';
            var url = $(this).attr('uri');
            var width = $(this).attr('dialog_width');
            ajax_form(id, title, url, width);
            return false;
        }
        $(function() {
            $('*[ectype="dialog"]').click(function() {
                take_ajax_form.call(this);
            });
        })
    </script>
    </body>
</html>