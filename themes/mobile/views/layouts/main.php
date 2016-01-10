<?php $this->beginContent('/layouts/common'); ?>
<footer class="ui-footer">
    <div class="ui-row-flex">
        <div class="ui-col" data-href="<?php echo Yii::app()->createUrl('index/index');?>">文章</div>
        <div class="ui-col" data-href="<?php echo Yii::app()->createUrl('index/tags');?>">标签</div>
        <div class="ui-col" data-href="<?php echo Yii::app()->createUrl('index/map');?>">足迹</div>
        <div class="ui-col" data-href="<?php echo Yii::app()->createUrl('site/info',array('code'=>'about'));?>">关于</div>
    </div>
</footer>
<?php echo $content; ?>
<?php $this->endContent(); ?>