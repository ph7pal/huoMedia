<?php $this->renderPartial('/content/_nav');?>
<div class="text-right">
    <?php echo CHtml::link('<i class="fa fa-plus"></i> 新增',array('create','type'=>$_GET['type']),array('class'=>'btn btn-primary'));?>
</div>
<?php if(!empty($posts)){?>
<table class="table table-hover table-bordered table-striped">
    <thead>
    <tr>        
        <th>序号</th>
        <?php if(in_array($type,array('meilishuo','mogu'))){?>
        <th>网站</th>
        <th>分类</th>
        <th>昵称</th>
        <th>链接</th>
        <th>粉丝</th>
        <?php }elseif($type=='renren'){?>
        <th>昵称</th>
        <th>性别</th>
        <th>地区</th>
        <th>链接</th>
        <th>好友</th>
        <th>会员</th>        
        <?php }elseif($type=='douban'){?>
        <th>昵称</th>
        <th>粉丝</th>
        <th>链接</th>
        <th>地区</th>
        <?php }?>
        <th>价格（元）</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $row): ?> 
        <?php $this->renderPartial('_view', array('data' => $row,'type'=>$type)); ?>
    <?php endforeach; ?>
    </tbody>
</table>
<?php $this->renderPartial('/common/pager',array('pages'=>$pages));?>
<?php }else{?>
<p class="help-block">暂无内容</p>
<?php } ?>