<?php
/* @var $this ColumnController */
/* @var $model Column */

$this->breadcrumbs=array(
	'Columns'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Column', 'url'=>array('index')),
	array('label'=>'Create Column', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#column-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
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
	'id'=>'column-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'belongid',
		'title',
		'name',
		'hot',
		'bold',
		/*
		'queue',
		'classify',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
