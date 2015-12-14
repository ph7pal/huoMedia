<h3>基本信息</h3>
<table class="table table-hover">
<tr><td>待审核文章：<?php if($siteinfo['posts']){ echo CHtml::link($siteinfo['posts'],array('posts/index','type'=>'staycheck'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['posts'];}?></td></tr>
<tr><td>待审核问题：<?php if($siteinfo['question']){ echo CHtml::link($siteinfo['question'],array('question/index','type'=>'staycheck'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['question'];}?></td></tr>
<tr><td>待审核回答：<?php if($siteinfo['answer']){ echo CHtml::link($siteinfo['answer'],array('answer/index','type'=>'staycheck'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['answer'];}?></td></tr>
<tr><td>待审核点评：<?php if($siteinfo['poipost']){ echo CHtml::link($siteinfo['poipost'],array('poiPost/index','type'=>'staycheck'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['poipost'];}?></td></tr>
<tr><td>待审核评论：<?php if($siteinfo['commentsNum']){ echo CHtml::link($siteinfo['commentsNum'],array('comments/index','type'=>'staycheck'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['commentsNum'];}?></td></tr>
<tr><td>待审核图片：<?php if($siteinfo['attachsNum']){ echo CHtml::link($siteinfo['attachsNum'],array('attachments/index','type'=>'staycheck'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['attachsNum'];}?></td></tr>
<tr><td>待审核坐标纠错：<?php if($siteinfo['poiErrorNum']){ echo CHtml::link($siteinfo['poiErrorNum'],array('poiError/index','type'=>'staycheck'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['poiErrorNum'];}?></td></tr>
<tr><td>待审核意见反馈：<?php if($siteinfo['feedbackNum']){ echo CHtml::link($siteinfo['feedbackNum'],array('feedback/index'),array('class'=>'btn btn-xs btn-danger'));}else{echo $siteinfo['feedbackNum'];}?></td></tr>
</table>
<hr/>

<h3>系统信息</h3>
<table class="table table-hover">	
<tr><td>服务器软件：</td><td><?php echo $siteinfo['serverOS']; ?>-<?php echo $siteinfo['serverSoft']; ?>  PHP-<?php echo $siteinfo['PHPVersion']; ?></td></tr>
<tr><td>数据库版本：</td><td><?php echo $siteinfo['mysqlVersion'];?>（<?php echo $siteinfo['dbsize'];?>）</td></tr>
<tr><td>上传许可：</td><td><?php echo $siteinfo['fileupload'];?></td></tr>
<tr><td>主机名：</td><td><?php echo $siteinfo['serverUri'];?></td></tr>
<tr><td>最大执行时间：</td><td><?php echo $siteinfo['maxExcuteTime'];?></td></tr>
<tr><td>最大执行内存：</td><td><?php echo $siteinfo['maxExcuteMemory'];?></td></tr>
<tr><td>当前使用内存：</td><td><?php echo $siteinfo['excuteUseMemory'];?></td></tr>
</table>