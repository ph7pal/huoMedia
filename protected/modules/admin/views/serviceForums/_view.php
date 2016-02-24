<tr>
    <th><?php echo $data->id;?></th>
    <td><?php echo $data->classifyInfo->title;?></td>
    <td><?php echo $data->forumInfo->title;?></td>
    <td><?php echo $data->typeInfo->title;?></td>    
    <td><?php echo zmf::subStr($data->url);?></td>
    
    <td><?php echo $data->forDigest;?></td>
    <td><?php echo $data->forDay;?></td>
    <td><?php echo $data->forWeek;?></td>
    <td><?php echo $data->forTwoWeek;?></td>
    <td><?php echo $data->forMonth;?></td>
    <td><?php echo $data->forQuarter;?></td>
    <td><?php echo $data->forHalfYear;?></td>
    <td><?php echo $data->forYear;?></td>
    
    
    <td>
        <?php echo CHtml::link('编辑',array('update','id'=>$data->id));?>
        <?php echo CHtml::link('删除',array('delete','id'=>$data->id));?>
    </td>
</tr>