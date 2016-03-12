<?php
/**
 * @filename ServiceQzoneController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:52:47 */
$this->breadcrumbs=array(
	'Service Qzones'=>array('index'),
	'Manage',
);
$this->menu=array(
    array('label'=>'List ServiceQzone', 'url'=>array('index')),
    array('label'=>'Create ServiceQzone', 'url'=>array('create')),
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#service-qzone-grid').yiiGridView('update', {
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
	'id'=>'service-qzone-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'uid',
		'nickname',
		'url',
		'favors',
		'shuoshuo',
		'cTime',
		'status',
            array(
                    'class'=>'CButtonColumn',
            ),
	),
)); ?>
