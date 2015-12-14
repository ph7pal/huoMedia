<h3>缓存管理</h3>
<table class="table table-hover table-condensed">
    <tr>
        <td>
        	<?php echo CHtml::link('清理assets',array('tools/func','type'=>'assets'));?>
        	<span class="help-block">清理前端缓存的CSS、JS等</span>
        </td>
    </tr>
    <tr>
        <td>
        	<?php echo CHtml::link('清理runtime',array('tools/func','type'=>'runtime'));?>
        	<span class="help-block">清理缓存在本地的数据</span>
        </td>
    </tr>
    <tr>
        <td>
        	<?php echo CHtml::link('系统配置',array('tools/func','type'=>'config'));?>
        	<span class="help-block">重置系统设置</span>
        	</td>
    </tr>
</table>
<h3>小工具</h3>
<table class="table table-hover table-condensed">
    <tr>
        <td>
        	<?php echo CHtml::link('统计标签',array('tools/tjTags'));?>
        	<span class="help-block">统计每个标签下的文章数</span>
        </td>
    </tr>
    <tr>
        <td>
        	<?php echo CHtml::link('统计标签长度',array('tools/tagslen'));?>
        	<span class="help-block">统计每个标签的长度</span>
        </td>
    </tr>
    <tr>
        <td>
        	<?php echo CHtml::link('统计评论数',array('tools/tjcomments'));?>
        	<span class="help-block">统计每个文章下的评论数</span>
        </td>
    </tr>
    <tr>
        <td>
        	<?php echo CHtml::link('标签链接',array('tools/linktags'));?>
        	<span class="help-block">为每篇文章添加标签链接</span>
        </td>
    </tr>
    <tr>
        <td>
        	<?php echo CHtml::link('更新坐标',array('tools/poi'));?>
        	<span class="help-block">更新每个坐标的封面图、统计得分等</span>
        </td>
    </tr>
    <tr>
        <td>
        	<?php echo CHtml::link('生成链接关键词',array('tools/keywords'));?>
        	<span class="help-block">将坐标生成关键词，用于文章的匹配</span>
        </td>
    </tr>
    <tr>
        <td>
        	<?php echo CHtml::link('统计地区下的内容数',array('area/tj'));?>
        	<span class="help-block">统计每个地区下的景点、酒店等等数量</span>
        </td>
    </tr>
</table>
