<style type="text/css">
    label{display:inline;}
</style>
<div class="block span12">
    <div class="block-heading" data-toggle="collapse" data-target="#tablewidget">下载记录</div>
    <div class="block-body collapse in">
        <p></p>
        <fieldset>
            <?php echo $this->Form->create('Log',array('type'=>'get','class'=>'search-form')) ?>
            <?php echo $this->Form->input('start_time',array('div'=>false,'label'=>'开始:','class'=>'datetimepicker')); ?>
            <?php echo $this->Form->input('end_time',array('div'=>false,'label'=>'结束:','class'=>'datetimepicker')); ?>
            <?php echo $this->Form->input('url',array('div'=>false,'label'=>'地址:')); ?>
            <?php echo $this->Form->end('搜索',array('div'=>false)) ?>
        </fieldset>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>用户</th>
                <th>地址</th>
                <th>时间</th>
            </tr>
            <?php foreach ($data as $key => $one): ?>
                <?php extract($one['Log']); ?>
                    <tr onclick="locate('<?php echo $id; ?>')" <?php echo strtotime($expired)<time()?'style="background:#fe6;"':''; ?> >
                        <td><?php echo $id; ?></td>
                        <td><?php echo $one['User']['email']; ?></td>
                        <td><?php echo $url; ?></td>
                        <td><?php echo date("Y-m-d",$created); ?></td>
                    </tr>
            <?php endforeach ?>
        </table>
        <?php echo $this->element('pages'); ?>
    </div>
</div>
<?php 
    echo $this->Html->script('jquery-ui-1.9.2.custom.min');
    echo $this->Html->script('jquery.ui.datepicker-zh');
    echo $this->Html->script('jquery-ui-timepicker-addon');
    echo $this->Html->css('jquery-ui');
 ?>
<script type="text/javascript">
    $('.datetimepicker').datetimepicker({
        timeFormat: "HH:mm:ss",
        dateFormat: "yy-mm-dd"
    });
    $(".table tr").hover(function(){
        $(this).addClass('active');
    },function(){
        $(this).removeClass('active');
    });
</script>