<?php
/* @var $this NaodongController */
/* @var $model Naodong */

$this->breadcrumbs=array(
	'Naodongs'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Naodong', 'url'=>array('index')),
	array('label'=>'Create Naodong', 'url'=>array('create')),
	array('label'=>'View Naodong', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Naodong', 'url'=>array('admin')),
);
?>

<h1>Update Naodong <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>