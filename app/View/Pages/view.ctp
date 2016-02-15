<div class="page" style="text-align:center;">
    <h4><?php echo $data['News']['title']; ?></h4>
    <p>创建时间:<?php echo date('Y-m-d H:i:s',$data['News']['created']); ?>    关键词:<?php echo $data['News']['keywords']; ?></p>
    <hr>
    <div class="content text-left">
        <?php echo $data['News']['content']; ?>
    </div>
</div>