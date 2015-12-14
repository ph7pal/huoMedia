<?php $_url = zmf::config('domain') . Yii::app()->createUrl('redirect/to', array('code' => $data->code));?>
<tr>
	<td><?php echo CHtml::link(CHtml::encode($data->url),$_url);?></td>	
	<td>
            <?php echo CHtml::link('详细',array('view','id'=>$data->id));?>
            <?php $this->renderPartial('/common/manageBar',array('table'=>'urls','keyid'=>$data->id,'status'=>$data->status));?>

	</td>
</tr>