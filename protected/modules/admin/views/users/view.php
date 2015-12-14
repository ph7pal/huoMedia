<h3><?php echo $info->truename;?>的基本信息</h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$info,
	'attributes'=>array(
		'id',
		'truename',
                array(
                    'label'=>$info->getAttributeLabel('status'),
                    'value'=>Users::userStatus($info->status)
                ),
		'email',
		'groupInfo.title',
                array(
                    'label'=>$info->getAttributeLabel('register_ip'),
                    'value'=>long2ip($info->register_ip)
                ),
                array(
                    'label'=>$info->getAttributeLabel('last_login_ip'),
                    'value'=> long2ip($info->last_login_ip)
                ),
		array(
                    'label'=>$info->getAttributeLabel('register_time'),
                    'value'=>tools::formatTime($info->register_time)
                ),
                array(
                    'label'=>$info->getAttributeLabel('last_login_time'),
                    'value'=>tools::formatTime($info->last_login_time)
                ),
		'login_count',		
		'posts',
		'answers',
		'tips',
		'favors',
		'fans',
	),
    'itemCssClass'=>'',
    'itemTemplate'=>'<tr><td style="width:10%" class="text-right"><b>{label}</b></td><td>{value}</td></tr>',
    'htmlOptions'=>array('class'=>'table table-hover table-striped')
)); ?>
<h3>小工具</h3>
<table class="table table-hover table-striped">
    <tr>
        <td style="width:50%"><b>删除头像</b></td>
        <td><?php echo CHtml::link('删除头像','javascript:;',array('onclick'=>'delAvator('.$info->id.');'));?></td>
    </tr>
    <tr>
        <td><b>清空内容</b></td>
        <td><?php echo CHtml::link('清空内容',array('ban','id'=>$info->id));?></td>
    </tr>
    <tr>
        <td><b>更改用户组</b></td>
        <td><?php echo CHtml::dropDownList('userGroup',$info->groupid,UserGroup::getGroups(true),array('options' => array($info['groupid']=>array('selected'=>true)))); ?><?php echo CHtml::link('保存','javascript:;',array('onclick'=>'changeUserGroup('.$info->id.');','id'=>'btn-user-group','class'=>''));?></td>
    </tr>
</table>