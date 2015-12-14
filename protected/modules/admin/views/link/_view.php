<tr>
    <td><b><?php echo CHtml::link($data->title, $data->url); ?></b></td>
    <td>
        <?php echo CHtml::link('详细',array('view','id'=>$data->id));?>
        <?php echo CHtml::link('编辑',array('update','id'=>$data->id));?>
        <?php $this->renderPartial('/common/manageBar',array('table'=>'link','keyid'=>$data->id,'status'=>$data->status));?>
    </td>
</tr>