<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">用户管理</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                用户列表
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>EMAIL</th>
                        <th>用户名</th>
                        <th>过期时间</th>
                        <th>剩余次数</th>
                        <th>创建时间</th>
                        <th>qq</th>
                        <th>电话</th>
                        <th>操作</th>
                    </tr>
                    <?php foreach ($data as $key => $one): ?>
                        <tr>
                            <td><?php echo $one['User']['id']; ?></td>
                            <td><?php echo $one['User']['email']; ?></td>
                            <td><?php echo $one['User']['name']; ?></td>
                            <td><?php echo $one['User']['expired']; ?></td>
                            <td><?php echo $one['User']['number']; ?></td>
                            <td><?php echo date('Y-m-d H:i:s',$one['User']['created']); ?></td>
                            <td><?php echo $one['User']['qq']; ?></td>
                            <td><?php echo $one['User']['tel']; ?></td>
                            <td>
                                <?php echo $this->Html->link('编辑',array('action'=>'edit','admin'=>true,$one['User']['id'])); ?>
                                <?php echo $this->Form->postLink('删除',array('action'=>'delete','admin'=>true,$one['User']['id']),array(),'删除后无法恢复,确定要删除?'); ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
                <?php echo $this->element('pages3'); ?>
            </div>
        </div> 
    </div>
</div>