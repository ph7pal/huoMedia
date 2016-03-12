<?php
/**
 * @filename ServiceWeixinController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:53:11 */
$this->renderPartial('/content/_nav');
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#service-weixin-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?><div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'service-weixin-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'uid',
		'classify',
		'nickname',
		'account',
		'favors',
		'danTuwen',
		'duoTuwen',
		'renzhen',
		'cTime',
		'status',
            array(
                    'class'=>'CButtonColumn',
            ),
	),
)); ?>
