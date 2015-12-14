<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->authorInfo->truename),array('users/view','id'=>$data->uid)); ?></td>
    <td><?php echo CHtml::encode($data->logid); ?></td>
    <td><?php echo GroupPowers::getDesc('admin', $data->classify); ?></td>
    <td><?php echo tools::formatTime($data->cTime); ?></td>
    <td><?php echo CHtml::encode(long2ip($data->ip)); ?></td>
</tr>