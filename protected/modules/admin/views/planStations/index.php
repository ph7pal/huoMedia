<?php
/* @var $this PlanStationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Plan Stations',
);

$this->menu=array(
	array('label'=>'Create PlanStations', 'url'=>array('create')),
	array('label'=>'Manage PlanStations', 'url'=>array('admin')),
);
?>

<h1>Plan Stations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
