<tr>
    <th><?php echo $data->id;?></th>
    <td><?php echo $data->nickname;?></td>
    <td><?php echo zmf::subStr($data->url);?></td>
    <td><?php echo $data->favors;?></td>
    <td><?php echo $data->shuoshuo;?></td>   
    
    <td>
        <?php echo CHtml::link('编辑',array('update','id'=>$data->id));?>
        <?php echo CHtml::link('删除',array('delete','id'=>$data->id));?>
    </td>
</tr>