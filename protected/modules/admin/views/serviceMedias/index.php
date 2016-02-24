<?php $this->renderPartial('/content/_nav');?>
<div class="text-right">
    <?php echo CHtml::link('<i class="fa fa-plus"></i> 新增',array('create'),array('class'=>'btn btn-primary'));?>
</div>
<?php if(!empty($posts)){?>
<table class="table table-hover table-bordered table-striped">
    <thead>
    <tr>
        <th>序号</th>
        <th>类型</th>
        <th>媒体名称</th>
        <th>案例</th>
        <th>新闻源</th>
        <th>链接情况</th>
        <th>价格</th>
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