<tr>
	<td><?php echo CHtml::encode($data->title); ?></td>
	<td><?php echo CHtml::encode($data->belongInfo->title); ?></td>
	<td>
            <?php echo CHtml::link('包含',array('index','belongid'=>$data->id));?>
            <?php echo CHtml::link('排序',array('order','belongid'=>$data->id));?>
            <?php echo $data->hot ? CHtml::link('取消推荐到导航','javascript:;',array('onclick'=>"addTopArea('{$data->id}','cancelHot')")) : CHtml::link('推荐到导航','javascript:;',array('onclick'=>"addTopArea('{$data->id}','hot')"));?>
            <?php echo CHtml::link('上传标识',array('upload','id'=>$data->id,'type'=>'logo'));?>
            <?php echo CHtml::link('编辑',array('update','id'=>$data->id));?>
	</td>
</tr>