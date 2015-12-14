<?php
/* @var $this GongyiController */
/* @var $model Gongyi */

$this->breadcrumbs=array(
	'Gongyis'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Gongyi', 'url'=>array('index')),
	array('label'=>'Create Gongyi', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#gongyi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Gongyis</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gongyi-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'uid',
		'title',
		'classify',
		'description',
		'content',
		/*
		'source',
		'sourceurl',
		'attachid',
		'status',
		'top',
		'hits',
		'comments',
		'favors',
		'cTime',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
