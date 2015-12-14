<?php
/* @var $this SiteInfoController */
/* @var $model SiteInfo */

$this->breadcrumbs=array(
	'Site Infos'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SiteInfo', 'url'=>array('index')),
	array('label'=>'Create SiteInfo', 'url'=>array('create')),
	array('label'=>'Update SiteInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SiteInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SiteInfo', 'url'=>array('admin')),
);
?>
<h1><?php echo CHtml::link($model->title,array('/siteinfo/view','code'=>$model->code));?></h1>
<p>
    <?php echo CHtml::link(CHtml::encode($model->authorInfo->truename),array('users/view','id'=>$model->uid)); ?>
    <?php echo tools::formatTime($model->cTime);?>
</p>
<?php echo zmf::text(array(), $model->content,false);?>