<?php
/**
 * @filename ServiceWeiboController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:53:02 */
$this->renderPartial('/content/_nav');
?>
<div class="text-right">
    <?php echo CHtml::link('<i class="fa fa-plus"></i> 新增',array('create'),array('class'=>'btn btn-primary'));?>
</div>
<?php if(!empty($posts)){?>
<table class="table table-hover table-bordered table-striped">
    <thead>
    <tr>
        <th>序号</th>
        <th>类别</th>
        <th>微博号</th>
        <th>链接</th>
        <th>粉丝</th>
        <th>身份</th>
        <th>普通转发</th>
        <th>普通直发</th>
        <th>硬广转发</th>
        <th>硬广直发</th>
        <th style="width: 110px;">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $row): ?> 
        <?php $this->renderPartial('_view', array('data' => $row)); ?>
    <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderPartial('/common/pager',array('pages'=>$pages));?>
<?php }else{?>
<p class="help-block">暂无内容</p>
<?php } ?>