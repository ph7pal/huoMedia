<tr>
    <th><?php echo $data->id;?></th>
    <td><?php echo $data->typeInfo->title;?></td>
    <td><?php echo $data->url;?></td>
    <td><?php echo $data->nickname;?></td>
    <td><?php echo $data->hits;?></td>    
    <td><?php echo $data->classifyInfo->title;?></td>
    <td><?php echo ServiceBlogs::level($data->level);?></td>    
    <td><?php echo $data->location;?></td>
    <td><?php echo $data->price;?></td>
    <td>
        <?php echo CHtml::link('编辑',array('update','id'=>$data->id));?>
        <?php echo CHtml::link('删除',array('delete','id'=>$data->id));?>
    </td>
</tr>