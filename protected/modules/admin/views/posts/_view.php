<tr>
    <td>
        <?php echo CHtml::link(CHtml::encode($data->id), array('posts/view','id'=>  $data->id),array('target'=>'_blank')); ?>
    </td>
    <td>
        <?php echo CHtml::encode($data->title); ?>
    </td>
    <td class="text-center">
        <?php echo CHtml::encode($data->hits); ?> | <?php echo CHtml::encode($data->favors); ?>
    </td>
    <td>
        <?php echo zmf::formatTime($data->cTime); ?>
    </td>
    <td>
        <?php echo CHtml::link('预览',array('/posts/view','id'=>  $data->id),array('target'=>'_blank'));?>
        <?php echo CHtml::link('编辑',array('posts/update','id'=> $data->id,'from'=>$from),array('target'=>'_blank'));?>        
        <?php echo CHtml::link('删除',array('posts/delete','id'=>$data->id));?>        
    </td>
</tr>