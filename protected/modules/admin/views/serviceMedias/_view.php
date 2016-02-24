<tr>
    <th><?php echo $data->id;?></th>
    <td><?php echo $data->classifyInfo->title;?></td>
    <td><?php echo $data->title;?></td>    
    <td><?php echo zmf::subStr($data->url);?></td>    
    <td><?php echo ServiceMedias::isSource($data->isSource);?></td>    
    <td><?php echo ServiceMedias::hasLink($data->hasLink);?></td>    
    <td><?php echo $data->price;?></td>
    <td>
        <?php echo CHtml::link('编辑',array('update','id'=>$data->id));?>
        <?php echo CHtml::link('删除',array('delete','id'=>$data->id));?>
    </td>
</tr>