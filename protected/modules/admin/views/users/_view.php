<tr>
	<td><?php echo CHtml::link(CHtml::encode($data->truename),array('view','id'=>$data->id));?></td>
	<td><?php echo CHtml::encode($data->email); ?></td>
	<td><?php echo $data->groupInfo->title; ?></td>
	<td>
            <?php echo CHtml::link('详细',array('view','id'=>$data->id));?>
            <?php echo CHtml::link('编辑',array('update','id'=>$data->id));?>
            <?php echo CHtml::link('禁止',array('ban','id'=>$data->id));?>
	</td>
</tr>