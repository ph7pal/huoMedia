<tr>
    <td>类型</td>
    <td>描述</td>
    <td>积分</td>
</tr>
<?php foreach ($posts as $row): ?> 
    <tr>
        <td><?php echo $row['type']; ?></td>
        <td><?php echo $row['content']; ?></td>
        <td><?php echo $row['score'];?></td>
    </tr>
<?php endforeach; ?>
<tr>
    <td colspan="3">
        <?php $this->renderPartial('/common/submitBar',array('pages'=>$pages));?>
    </td>                   
</tr>
<tr>
    <td colspan="3">
        <?php echo CHtml::link('新增', array('score/add'), array('class' => 'btn btn-primary')); ?>
    </td>
</tr>