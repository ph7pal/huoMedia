<div class="alert alert-success">
    <h1>操作成功！</h1>
    <p>
        <?php echo CHtml::link('继续添加',array('create'),array('class'=>'btn btn-primary'));?>
        <?php echo CHtml::link('上传图片',array('/position/images','id'=>$id),array('class'=>'btn btn-default','target'=>'_blank'));?>
        <?php echo CHtml::link('查看详细',array('view','id'=>$id));?>
    </p>
</div>