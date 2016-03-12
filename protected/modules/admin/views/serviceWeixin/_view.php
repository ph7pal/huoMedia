<tr>
    <th><?php echo $data->id;?></th>
    <td><?php echo $data->classifyInfo->title;?></td>
    <td><?php echo $data->nickname;?></td>
    <td><?php echo $data->account;?></td>    
    
    <td><?php echo $data->favors;?></td>
    <td><?php echo $data->danTuwen;?></td>
    <td><?php echo $data->duoTuwen;?></td>
    <td><?php echo $data->renzhen;?></td>
    
    
    <td>
        <?php echo CHtml::link('编辑',array('update','id'=>$data->id));?>
        <?php echo CHtml::link('删除',array('delete','id'=>$data->id));?>
    </td>
</tr>