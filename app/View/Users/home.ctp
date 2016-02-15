<div class="container">
    <div class="row">
        <h3 class="bg-info">账户信息(<?php echo $user['email']; ?>)</h3>
        <div class="col-md-12">
            <p>剩余次数: <span class="label label-info"><?php echo $user['number']; ?></span>     </p>
            <p>
                <span >注册时间: <span class="label label-info"><?php echo date("Y-m-d",$user['created']); ?></span></span>
                <span >过期时间: <span class="label label-warning"><?php echo $user['expired']; ?></span></span>
            </p>
        </div>
        <hr>
    </div>
    <div class="row">
        <h3>下载</h3>
        <p class="bg-info">复制素材下载地址，:如 http://down.nipic.com/download?id=9161809#showMore 粘贴到下面的框下载即可!</p>
        <div class="col-md-12">
            <?php echo $this->Form->create("",array('class'=>'form-inline','role'=>'form','url'=>'/Users/down','target'=>'_blank')) ?>
              <div class="form-group">
                <label class="sr-only" for="exampleInputEmail2">文件初始地址:</label>
                <input style="width:300px;" type="text" class="form-control" name="url" placeholder="http://down.nipic.com/download?id=9161809#showMore">
              </div>
              <button type="submit" class="btn btn-primary">下载</button>
              <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>