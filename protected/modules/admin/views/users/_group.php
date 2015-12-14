<tr>
    <td>
        <?php echo CHtml::encode($data->title); ?>
    </td>
    <td>
        <?php echo CHtml::link('详细',array('addgroup','id'=>$data->id));?>
        <?php echo CHtml::link('编辑',array('addgroup','id'=>$data->id));?>
    </td>
</tr>