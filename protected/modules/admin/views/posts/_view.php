<tr>
    <td><?php echo CHtml::link(CHtml::encode($data->authorInfo->truename),array('users/view','id'=>$data->uid)); ?></td>
    <td><?php echo CHtml::link($data->title, array('/posts/index', 'id'=>$data->id)); ?></td>
    <td>
        <?php echo CHtml::link('查看',array('/posts/index','id'=>$data->id));?>
        <?php echo CHtml::link('编辑',array('/posts/create','id'=>$data->id));?>
        <?php $this->renderPartial('/common/manageBar',array('table'=>'posts','keyid'=>$data->id,'status'=>$data->status));?>
    </td>
</tr>