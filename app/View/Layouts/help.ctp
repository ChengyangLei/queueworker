<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base target=_self>
        <?php echo $this->Html->charset(); ?>
        <title>
        帮助系统
        </title>
        <?php echo $this->Html->css('bootstrap.min'); ?>
    </head>
    <style type="text/css">
        body table{font-size:12px;}
        #content{min-height:500px;}
        .tip{font-size:12px;color:#666;}
        .red{color:#a00;}
        .sub{font-size:14px;}
        img{max-width:100%;}
    </style>
    <body>
        <div class="container">
            <div id="content">
                <?php echo $this->fetch('content'); ?>
            </div>
            <hr>
            <div class="footer">
                <p>©shelp Company 2013</p>
            </div>
        </div>
    </body>
</html>