<?php
/* @var $this SiteWordsController */
/* @var $data SiteWords */
?>
<tr>
	<td><?php echo CHtml::encode($data->title); ?></td>
        <td><?php echo SiteWords::exClassify($data->classify); ?></td>	
	<td>
            <?php echo CHtml::link('编辑',array('update','id'=>$data->id));?>
            <?php echo CHtml::link('删除',array('delete','id'=>$data->id));?>
	</td>
</tr>