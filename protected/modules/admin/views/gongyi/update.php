<?php
/* @var $this GongyiController */
/* @var $model Gongyi */

$this->breadcrumbs=array(
	'Gongyis'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Gongyi', 'url'=>array('index')),
	array('label'=>'Create Gongyi', 'url'=>array('create')),
	array('label'=>'View Gongyi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Gongyi', 'url'=>array('admin')),
);
?>

<h1>Update Gongyi <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>