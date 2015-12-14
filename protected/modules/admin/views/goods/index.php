<?php
/* @var $this GoodsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Goods',
);

$this->menu=array(
	array('label'=>'Create Goods', 'url'=>array('create')),
	array('label'=>'Manage Goods', 'url'=>array('admin')),
);
?>
<table class="table table-hover">
    <tr>
        <th style="width: 70%;">标题</th>
        <th>操作</th>
    </tr>
<?php foreach($posts as $row):?> 
    <tr>
        <td><?php echo CHtml::link($row['title'],array('/goods/detail','id'=>$row['id']));?></td>
        <td>
            <?php echo CHtml::link('查看',array('/goods/detail','id'=>$row['id']));?>
            <?php echo CHtml::link('编辑',array('update','id'=>$row['id']));?>
            <?php $this->renderPartial('/common/manageBar',array('table'=>'posts','keyid'=>$row['id'],'status'=>$row['status']));?>
        </td>
    </tr>
 <?php endforeach;?>
</table>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>