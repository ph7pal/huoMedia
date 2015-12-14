<?php
/* @var $this SiteInfoController */
/* @var $model SiteInfo */

$this->breadcrumbs=array(
	'Site Infos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SiteInfo', 'url'=>array('index')),
	array('label'=>'Create SiteInfo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#site-info-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'site-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'uid',
		'colid',
		'faceimg',
		'code',
		'title',
		/*
		'content',
		'hits',
		'cTime',
		'updateTime',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
