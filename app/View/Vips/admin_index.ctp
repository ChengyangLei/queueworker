<div class="block span12">
    <div class="block-heading" data-toggle="collapse" data-target="#tablewidget">VIP账号列表</div>
    <div class="block-body collapse in">
        <table class="table">
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>密码</th>
                <th>创建时间</th>
                <th>当日使用次数</th>
                <th>操作</th>
            </tr>
            <?php foreach ($data as $key => $one): ?>
                <tr>
                    <td><?php echo $one['Vip']['id']; ?></td>
                    <td><?php echo $one['Vip']['username']; ?></td>
                    <td><?php echo $one['Vip']['password']; ?></td>
                    <td><?php echo date("Y-m-d H:i:s",$one['Vip']['created']); ?></td>
                    <td><?php echo ($one['Vip']['today'] == date("Y-m-d"))?$one['Vip']['number']:0; ?></td>
                    <td>
                        <?php echo $this->Html->link('编辑',array('action'=>'edit','admin'=>true,$one['Vip']['id'])); ?>
                        <?php echo $this->Form->postLink('删除',array('action'=>'delete','admin'=>true,$one['Vip']['id']),array(),'删除后无法恢复,确定要删除?'); ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <?php echo $this->element('pages'); ?>
    </div>
</div>