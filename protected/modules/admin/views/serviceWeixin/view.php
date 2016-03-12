<?php
/**
 * @filename ServiceWeixinController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:53:11 */
 
$this->breadcrumbs=array(
	'Service Weixins'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('label'=>'List ServiceWeixin', 'url'=>array('index')),
    array('label'=>'Create ServiceWeixin', 'url'=>array('create')),
    array('label'=>'Update ServiceWeixin', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Delete ServiceWeixin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage ServiceWeixin', 'url'=>array('admin')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
		'id',
		'uid',
		'classify',
		'nickname',
		'account',
		'favors',
		'danTuwen',
		'duoTuwen',
		'renzhen',
		'cTime',
		'status',
    ),
)); ?>