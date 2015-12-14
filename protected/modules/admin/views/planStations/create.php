<?php
/* @var $this PlanStationsController */
/* @var $model PlanStations */

$this->breadcrumbs=array(
	'Plan Stations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PlanStations', 'url'=>array('index')),
	array('label'=>'Manage PlanStations', 'url'=>array('admin')),
);
?>

<h1>Create PlanStations</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>