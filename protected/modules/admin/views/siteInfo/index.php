<?php
/* @var $this SiteInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Site Infos',
);

$this->menu=array(
	array('label'=>'Create SiteInfo', 'url'=>array('create')),
	array('label'=>'Manage SiteInfo', 'url'=>array('admin')),
);
?>

<table class="table table-hover">
<tr>
    <th>标题</th>
    <th style="width: 20%">操作</th>
</tr>
<?php foreach($posts as $row):?> 
<?php $this->renderPartial('_view',array('data'=>$row));?>
 <?php endforeach;?>
</table>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>