<?php
/**
 * @filename ServiceWeixinController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:53:11 */
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
        <th>微信名称</th>
        <th>微信号</th>
        <th>粉丝数</th>
        <th>单图文</th>
        <th>多图文</th>
        <th>认证</th>
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