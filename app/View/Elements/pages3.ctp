<style type="text/css">
    /*fix 分页样式*/
    .pagination .active {
      float: left;
      padding: 6px 12px;
      line-height: 20px;
      text-decoration: none;
      background-color: #ffffff;
      border: 1px solid #dddddd;
      border-left-width: 0;
      background-color: #f5f5f5;
    }
</style>
<?php if (isset($this->Paginator)): ?>
<ul class="pagination">
    <!--<span class="total"><?php /*echo $this->Paginator->counter(array('separator'=>'/'));*/ ?></span>-->
    <?php
        echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentClass'=>'active'));
    ?>
</ul>
<?php endif; ?>