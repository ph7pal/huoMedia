<!--fieldset-->
<ul id="conTable">
    <li class="<?php echo ($_GET['type']=='all')?'current':'';?>"><?php echo CHtml::link('待处理('.$total.')',array('reports/all','type'=>'all'));?></li>
    <li class="<?php echo ($_GET['type']=='all')?'current':'';?>"><?php echo CHtml::link('举报心得('.$sscnum.')',array('reports/all','type'=>'ssc'));?></li>
    <li class="<?php echo ($_GET['type']=='all')?'current':'';?>"><?php echo CHtml::link('举报评论('.$cscnum.')',array('reports/all','type'=>'comments'));?></li>
    <li class="<?php echo ($_GET['type']=='all')?'current':'';?>"><?php echo CHtml::link('举报图片('.$imgnum.')',array('reports/all','type'=>'img'));?></li> 
    <li class="<?php echo ($_GET['type']=='all')?'current':'';?>"><?php echo CHtml::link('已处理('.$readnum.')',array('reports/all','type'=>'read'));?></li>
</ul>
<!--/fieldset-->