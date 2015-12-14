<table class="table table-hover">
    <tr>
        <td style="width:20%">用户名</td>
        <td style="width:10%">对象</td>
        <td>操作</td>
        <td style="width:15%">时间</td>
        <td style="width:10%">IP</td>
    </tr>
<?php foreach($posts as $row):?> 
<?php $this->renderPartial('_view',array('data'=>$row));?>
 <?php endforeach;?>
</table>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>