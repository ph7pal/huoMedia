<h1><?php echo CHtml::link($model->title,array('/posts/index','id'=>$model->id));?></h1>
<p>
    <?php echo CHtml::link(CHtml::encode($model->authorInfo->truename),array('users/view','id'=>$model->uid)); ?>
    <?php echo tools::formatTime($model->cTime);?>
</p>
<?php echo zmf::text(array(), $model->content,false);?>