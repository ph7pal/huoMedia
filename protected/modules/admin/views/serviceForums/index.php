<?php $this->renderPartial('/content/_nav');?>
<div class="text-right">
    <?php echo CHtml::link('<i class="fa fa-plus"></i> 新增',array('create'),array('class'=>'btn btn-primary'));?>
</div>
<?php if(!empty($posts)){?>
<table class="table table-hover table-bordered table-striped">
    <thead>
    <tr>
        <th>序号</th>
        <th>类别</th>
        <th>社区</th>
        <th>板块</th>
        <th>板块链接</th>
        <th>精华</th>
        <th>一天</th>
        <th>一周</th>
        <th>二周</th>
        <th>一月</th>
        <th>季度</th>
        <th>半年</th>
        <th>一年</th>
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