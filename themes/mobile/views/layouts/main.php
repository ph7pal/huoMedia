<?php $this->beginContent('/layouts/common'); ?>
<footer class="ui-footer">
    <div class="ui-row-flex ui-border-t">
        <div class="ui-col <?php echo $this->selectNav=='posts' ? 'active' : '';?>" data-href="<?php echo Yii::app()->createUrl('index/index');?>"><i class="fa fa-bookmark"></i>文章</div>
        <div class="ui-col <?php echo $this->selectNav=='tags' ? 'active' : '';?>" data-href="<?php echo Yii::app()->createUrl('index/tags');?>"><i class="fa fa-tags"></i>标签</div>
        <div class="ui-col <?php echo $this->selectNav=='map' ? 'active' : '';?>" data-href="<?php echo Yii::app()->createUrl('index/map');?>"><i class="fa fa-map-marker"></i>足迹</div>
        <div class="ui-col <?php echo $this->selectNav=='about' ? 'active' : '';?>" data-href="<?php echo Yii::app()->createUrl('site/info',array('code'=>'about'));?>"><i class="fa fa-user"></i>关于</div>
    </div>
</footer>
<?php echo $content; ?>
<?php $this->endContent(); ?>