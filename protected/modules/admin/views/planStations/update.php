<?php
/* @var $this PlanStationsController */
/* @var $model PlanStations */

$this->breadcrumbs=array(
	'Plan Stations'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PlanStations', 'url'=>array('index')),
	array('label'=>'Create PlanStations', 'url'=>array('create')),
	array('label'=>'View PlanStations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PlanStations', 'url'=>array('admin')),
);
?>

<h1>Update PlanStations <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>