<div class="row-fluid">
    <div class="span12">
        <fieldset>
            <span>下载记录</span>
            <div class="clearfix"></div>
            <?php echo $this->Form->create('Log',array('type'=>'get','class'=>'search-form')) ?>
            <?php echo $this->Form->input('start_time',array('label'=>'开始:','class'=>'datetimepicker')); ?>
            <?php echo $this->Form->input('end_time',array('div'=>false,'label'=>'结束:','class'=>'datetimepicker')); ?>
            <?php echo $this->Form->input('url',array('div'=>false,'label'=>'地址:')); ?>
            <?php echo $this->Form->end('搜索') ?>
        </fieldset>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <table class="table">
            <tr>
                <th>ID</th>
                <th>地址</th>
                <th>时间</th>
            </tr>
            <?php foreach ($data as $key => $one): ?>
                <?php extract($one['Log']); ?>
                    <tr onclick="locate('<?php echo $id; ?>')" <?php echo strtotime($expired)<time()?'style="background:#fe6;"':''; ?> >
                        <td><?php echo $id; ?></td>
                        <td><?php echo $url; ?></td>
                        <td><?php echo date("Y-m-d",$created); ?></td>
                    </tr>
            <?php endforeach ?>
        </table>
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
<?php echo $this->element('pages3'); ?>