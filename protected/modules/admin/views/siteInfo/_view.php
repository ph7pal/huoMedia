<tr>
	<td><?php echo CHtml::encode($data->title); ?></td>
	
	<td>
            <?php echo CHtml::link('编辑',array('update','id'=>$data->id));?>
	</td>
</tr>